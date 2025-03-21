<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 py-6">
        <x-form.form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Register</h2>
                    <div class="mt-4 grid grid-cols-1 gap-y-6">

                        <div>
                            <x-form.label name="name">Username</x-form.label>
                            <x-form.input name="name" type="text" placeholder="janesmith" />
                        </div>

                        <div>
                            <x-form.label name="email">Email</x-form.label>
                            <x-form.input name="email" type="email" placeholder="janesmith@gmail.com" />
                        </div>

                        <div>
                            <x-form.label name="password">Password</x-form.label>
                            <x-form.input id="password" name="password" type="password" />
                        </div>
                        <div>
                            <x-form.label name="password_confirmation">Confirm Password</x-form.label>
                            <x-form.input id="password_confirmation" name="password_confirmation" type="password" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-x-4">
                    <x-form.button>
                        Register
                    </x-form.button>
                </div>
            </div>
        </x-form.form>
    </div>
</x-layout>
