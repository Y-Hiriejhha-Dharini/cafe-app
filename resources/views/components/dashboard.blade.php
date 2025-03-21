<x-layout>
    <div class="flex h-screen bg-gray-100">
        <aside class="w-50 bg-white shadow-md flex flex-col justify-between h-full">
            <div>
                <div class="relative mb-10">
                    <img src="{{ asset('images/cafe.jpg') }} " alt="Top Image" class="w-full max-h-20">

                    <div class="absolute left-1/2 transform -translate-x-1/2 top-10">
                        <div class="w-20 h-20 mx-auto mb-1">
                            <img src="{{ asset('images/profile.jpg') }}" alt="Profile Image"
                                class="w-full h-full rounded-full object-cover shadow-lg">
                        </div>
                    </div>
                </div>

                <div class="text-center mt-10">
                    <p class="text-md font-semibold text-gray-700">John Doe</p>
                </div>

                <nav class="mt-6 flex-1">
                    <ul>
                        <li>
                            <a href="{{ route('client.index') }}"
                                class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-md">Clients</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="flex-1 p-6">
            {{ $slot }}
        </div>
    </div>
</x-layout>
