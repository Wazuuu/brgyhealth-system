<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Barangay Health System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Navbar -->
<nav class="bg-green-600 text-white p-4 flex justify-between items-center">
    <div class="text-xl font-bold">Barangay Health System</div>
    <div class="space-x-4">
        @guest
            <a href="{{ route('login') }}" class="hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
        @else
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        @endguest
    </div>
</nav>

<!-- Main Content -->
<div class="container mx-auto mt-6 px-4">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
 