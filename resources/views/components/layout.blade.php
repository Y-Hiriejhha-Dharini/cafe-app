<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Practical Exam</title>
    @vite(['resources/css/app.css' , 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <header class="bg-black shadow-md py-3 pl-30">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/client" class="text-white hover:text-gray-900 px-12">
                <i class="fas fa-bars"></i>
                <FontAwesomeIcon icon="fa-solid fa-bars" />
            </a>
            <nav class="flex items-center gap-x-6 mr-8">
                @auth
                    <form method="POST" action="/logout" class="text-white hover:text-gray-900">
                        @csrf
                        @method('DELETE')
                        <button><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('loginView') }}" class="text-white hover:text-gray-900">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="text-white hover:text-gray-900">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                @endguest
                @auth
                    <div class="relative w-7 h-7">
                        <img src="images/profile.jpg"
                            alt="Profile"
                            class="w-full h-full rounded-full border-2 border-gray-300 shadow">
                    </div>
                @endauth
            </nav>
        </div>
    </header>


    <main class="flex-1">
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
