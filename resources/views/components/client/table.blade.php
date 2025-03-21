@props(['clients'])
<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 w-20">
                <div class="flex items-center justify-between">
                    <span>#</span>
                    <div class="flex flex-col space-y-0.5">
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="name" data-direction="asc">
                            <i class="fas fa-sort-up"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="name" data-direction="desc">
                            <i class="fas fa-sort-down"></i>
                        </button>
                    </div>
                </div>
            </th>
            <th class="px-4 py-2">Image</th>
            <th class="px-4 py-2">
                <div class="flex items-center justify-between">
                    <span>Name</span>
                    <div class="flex flex-col space-y-0.5">
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="name" data-direction="asc">
                            <i class="fas fa-sort-up"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="name" data-direction="desc">
                            <i class="fas fa-sort-down"></i>
                        </button>
                    </div>
                </div>
            </th>
            <th class="px-4 py-2">
                <div class="flex items-center justify-between">
                    <span>Contact</span>
                    <div class="flex flex-col space-y-0.5">
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="contact" data-direction="asc">
                            <i class="fas fa-sort-up"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="contact" data-direction="desc">
                            <i class="fas fa-sort-down"></i>
                        </button>
                    </div>
                </div>
            </th>
            <th class="px-4 py-2">
                <div class="flex items-center justify-between">
                    <span>Email</span>
                    <div class="flex flex-col space-y-0.5">
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="email" data-direction="asc">
                            <i class="fas fa-sort-up"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 sort-button" data-column="email" data-direction="desc">
                            <i class="fas fa-sort-down"></i>
                        </button>
                    </div>
                </div>
            </th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $index => $client)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $index + 1 }}</td>
                <td class="px-4 py-2">
                    <img src="images/profile.jpg" alt="Client" class="w-10 h-10 grayscale">
                </td>
                <td class="px-4 py-2">{{ $client->first_name . ' ' . $client->last_name }}</td>
                <td class="px-4 py-2">{{ $client->contact }}</td>
                <td class="px-4 py-2">{{ $client->email }}</td>
                <td class="px-4 py-2">
                    @if ($client->status == 'active')
                        <button class="bg-green-500 text-white px-2 py-1 rounded-md">Active</button>
                    @else
                        <button class="bg-red-500 text-white px-2 py-1 rounded-md">Inactive</button>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <a href="javascript:void(0);" class="text-blue-500 hover:text-blue-700" onclick="showClientDetails({{ $client->id }})">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('client.edit', $client->id) }}" class="text-yellow-500 hover:text-yellow-700">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <button class="delete-btn text-red-500 hover:text-red-700" data-client-id="{{ $client->id }}">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="clientModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="flex justify-center items-center h-full">
        <div class="bg-white m-2 rounded-lg shadow-lg w-2/3 max-w-lg">

            <div class="flex justify-between items-center bg-black px-4 py-3">
                <h2 id="modal-title" class="text-lg font-bold text-white">Client Details</h2>
                <button id="closeModal" class="text-2xl text-gray-300 hover:text-white">&times;</button>
            </div>

            <div class="flex justify-center pt-2">
                <img id="modal-profile-image" src="images/profile.jpg" alt="Profile Image"
                    class="w-14 h-14 rounded-full border-2 border-gray-300">
            </div>

            <div class="mt-4 space-y-3 mx-4">
                <div class="flex">
                    <strong class="w-40">First Name:</strong> <span id="modal-first-name"></span>
                </div>
                <div class="flex">
                    <strong class="w-40">Last Name:</strong> <span id="modal-last-name"></span>
                </div>
                <div class="flex">
                    <strong class="w-40">Name:</strong> <span id="modal-name"></span>
                </div>
                <div class="flex">
                    <strong class="w-40">Contact:</strong> <span id="modal-contact"></span>
                </div>
                <div class="flex">
                    <strong class="w-40">Email:</strong> <span id="modal-email"></span>
                </div>
                <div class="flex">
                    <strong class="w-40">Date of Birth:</strong> <span id="modal-dob"></span>
                </div>
                <div class="flex">
                    <strong class="w-40">Address:</strong> <span id="modal-address"></span>
                </div>
            </div>

        </div>
    </div>
</div>


