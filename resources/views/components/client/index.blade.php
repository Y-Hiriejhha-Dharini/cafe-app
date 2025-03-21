<x-dashboard>
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Clients</h1>
            <a href="{{ route('client.create') }}" class="bg-black text-white px-4 py-2 rounded-md">+ CREATE NEW</a>
        </div>

        @if(isset($clients) && $clients->isNotEmpty())
            <div class="mt-6 bg-white shadow-md rounded-lg p-4">
                <form id="filterForm">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">Result:</span>
                            <select name="per_page" id="pagination" class="px-2 py-1 border rounded-md">
                                @foreach (range(10, 100, 10) as $number)
                                    <option value="{{ $number }}" {{ request('per_page') == $number ? 'selected' : '' }}>{{ $number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative flex items-center"> <!-- Flex container to align input and icon -->
                            <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" id="searchBtn">
                                <i class="fa fa-search"></i>
                            </button>
                            <input type="text" name="search" id="search" placeholder="Search..." value="{{ request('search') }}" class="pl-10 pr-4 py-2 border rounded-md">
                        </div>
                    </div>
                </form>

                <div id="clientTable">
                    <x-client.table :clients="$clients" :nextPage="$nextPage"/>
                </div>
            </div>
        @else
            <p class="text-gray-500 text-center mt-12">Nothing to show.</p>
        @endif
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
        function fetchClients() {
            let search = $('#search').val();
            let per_page = $('#pagination').val();
            let sort_column = new URLSearchParams(window.location.search).get('sort_column') || '';
            let sort_direction = new URLSearchParams(window.location.search).get('sort_direction') || '';

            $.ajax({
                url: "{{ route('client.index') }}",
                type: "GET",
                data: {
                    search: search,
                    per_page: per_page,
                    sort_column: sort_column,
                    sort_direction: sort_direction
                },
                success: function (response) {
                    let clientListHtml = '';

                    $.each(response.clients, function (index, client) {
                        clientListHtml += `
                            <tr class="border-b">
                                <td class="px-4 py-2">${index + 1}</td>
                                <td class="px-4 py-2">
                                    <img src="images/profile.jpg" alt="Client" class="w-10 h-10 grayscale">
                                </td>
                                <td class="px-4 py-2">${client.first_name} ${client.last_name}</td>
                                <td class="px-4 py-2">${client.contact}</td>
                                <td class="px-4 py-2">${client.email}</td>
                                <td class="px-4 py-2">
                                    ${client.status === 'active' ?
                                        `<button class="bg-green-500 text-white px-2 py-1 rounded-md">Active</button>` :
                                        `<button class="bg-red-500 text-white px-2 py-1 rounded-md">Inactive</button>`
                                    }
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('client.show', '') }}/${client.id}" class="text-blue-500 hover:text-blue-700" onclick="showClientDetails(${client.id})">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('client.edit', '') }}/${client.id}" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button class="delete-btn text-red-500 hover:text-red-700" data-client-id="${client.id}">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    $('#clientTable tbody').html(clientListHtml);

                    if (response.nextPage) {
                        $('#pagination').html('<a href="' + response.nextPage + '">Next</a>');
                    } else {
                        $('#pagination').html('');
                    }
                }
            });
        }

        $('#searchBtn').click(function (e) {
            e.preventDefault();
            fetchClients();
        });

        $('#pagination').change(function () {
                fetchClients();
            });

            function sortColumn(column, direction) {
                let url = new URL(window.location.href);
                url.searchParams.set('sort_column', column);
                url.searchParams.set('sort_direction', direction);
                history.pushState({}, '', url.toString());
                fetchClients();
            }

            $(document).on('click', '.sort-button', function () {
                let column = $(this).data('column');
                let direction = $(this).data('direction');
                sortColumn(column, direction);
            });

            $(".delete-btn").click(function (e) {
                e.preventDefault();

                const clientId = $(this).data('client-id');
                const deleteUrl = '/client/' + clientId;

                Swal.fire({
                    title: 'Are you sure!',
                    text: 'Do you want to Delete the selected Client',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-dark',
                        cancelButton: 'btn-red'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'The client has been deleted.',
                                    'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                    fetchClients();
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the client.',
                                    'error'
                                );
                            }
                        });
                    } else {
                        Swal.fire(
                            'Cancelled',
                            'The client is safe :)',
                            'error'
                        );
                    }
                });
            });
        });

        function showClientDetails(clientId) {

            const modal = document.getElementById('clientModal');
            modal.classList.remove('hidden');

            $.ajax({
                url: '/client/' + clientId,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $("#modal-first-name").text(response.client.first_name);
                    $("#modal-last-name").text(response.client.last_name);
                    $("#modal-name").text(response.client.first_name+ " " +response.client.last_name);
                    $("#modal-contact").text(response.client.contact);
                    $("#modal-email").text(response.client.email);
                    $("#modal-dob").text(response.client.dob);
                    $("#modal-address").text(response.client.address);

                    $("#clientModal").removeClass("hidden");
                    },
                error: function() {
                    alert('Failed to fetch client details.');
                }
            });
        }

        $("#closeModal").click(function () {
            $("#clientModal").addClass("hidden");
        });

        $("#clientModal").click(function (event) {
            if ($(event.target).closest(".bg-white").length === 0) {
                $("#clientModal").addClass("hidden");
            }
        });

    </script>
</x-dashboard>
