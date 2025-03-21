<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 py-6 ">
        <x-form.form action="{{ route('login') }}" method="POST">
            <div class="mt-4 grid grid-cols-1 gap-y-6">
                <div>
                    <x-form.label name="email">Email Address/ User Name</x-form.label>
                    <x-form.input id="email" name="email" placeholder="janesmith@gmail.com" />
                </div>
                <div>
                    <x-form.label name="password">Password</x-form.label>
                    <x-form.input id="password" name="password" type="password" />
                </div>
            </div>
            <div class="flex justify-center gap-x-4 mt-10">
                <x-form.button>Login</x-form.button>
            </div>
        </x-form.form>
    </div>
</x-layout>

