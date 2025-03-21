<x-dashboard>
    <main class="flex-1 p-6">
        <div class="mb-8">
            <a href="{{ route('client.index') }}" class="bg-black text-white px-10 py-2 rounded-md">BACK</a>
        </div>
        <div class="flex justify-center items-center mb-6">
            <h1 class="text-2xl font-bold">UPDATE THE CLIENT</h1>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8 mx-auto max-w-4xl">
            <form action="{{ route('client.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('first_name', $client->first_name) }}" required>
                        @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('last_name', $client->last_name) }}" required>
                        @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="contact" class="block text-sm font-semibold text-gray-700">Contact</label>
                        <input type="text" id="contact" name="contact" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('contact', $client->contact) }}" required>
                        @error('contact') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('email', $client->email) }}" required>
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="gender" class="block text-sm font-semibold text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" required>
                            <option value="male" {{ old('gender', $client->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $client->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $client->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @php
                        $dob = $client->dob ?? '';
                        $dobParts = explode('-', $dob);
                        $dobYear =  $dobParts[0] ?? null;
                        $dobMonth = $dobParts[1] ?? null;
                        $dobDay = $dobParts[2] ?? null;

                        $address = $client->address ?? '';
                        $addressParts = explode(',', $address);
                        $streetNo = $addressParts[0] ?? null;
                        $streetAddress = $addressParts[1] ?? null;
                        $City = $addressParts[2] ?? null;

                    @endphp

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="dob_year" class="block text-sm font-semibold text-gray-700">Year</label>
                            <select id="dob_year" name="dob_year" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" required>
                                @for ($i = 1980; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ old('dob_year', $dobYear) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="dob_month" class="block text-sm font-semibold text-gray-700">Month</label>
                            <select id="dob_month" name="dob_month" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" required>
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $index => $month)
                                    <option value="{{ $index + 1 }}" {{ old('dob_month', $dobMonth) == $index + 1 ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                            @error('dob_month') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="dob_day" class="block text-sm font-semibold text-gray-700">Day</label>
                            <select id="dob_day" name="dob_day" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" required>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ old('dob_day', $dobDay) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('dob_day') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="street_no" class="block text-sm font-semibold text-gray-700">Street No</label>
                        <input type="text" id="street_no" name="street_no" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('street_no', $streetNo) }}" required>
                        @error('street_no') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="street_address" class="block text-sm font-semibold text-gray-700">Street Address</label>
                        <input type="text" id="street_address" name="street_address" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('street_address', $streetAddress) }}" required>
                        @error('street_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="city" class="block text-sm font-semibold text-gray-700">City</label>
                        <input type="text" id="city" name="city" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md" value="{{ old('city', $City) }}" required>
                        @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 pb-2">Status</label>
                            <input type="hidden" name="status" value="inactive">
                            <label for="status" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="status" name="status" value="active" class="sr-only peer" {{ old('status', $client->status) == 'active' ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:left-1 after:top-1 after:bg-white after:border-gray-300 after:rounded-full after:h-4 after:w-4 transition-all"></div>
                            </label>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end ">
                    <button type="submit" class="text-white px-8 py-2 bg-black rounded-md ">Update</button>
                </div>
            </form>
        </div>
    </main>
</x-dashboard>
