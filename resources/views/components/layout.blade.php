@php use Illuminate\Support\Facades\Auth; @endphp
@props(['search_query' => null])
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MU Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Standard favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon (for iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" sizes="180x180">

    <!-- Android Icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="192x192" type="image/png">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
<!-- Navbar -->
<nav class="bg-white shadow-md p-4">
    <div class="flex justify-between items-center">
        <a href="/" class="flex items-center">
            <img src="{{ asset('favicon.png') }}" alt="Site Logo" class="w-10 h-10 mr-2">
            <span class="text-xl font-semibold">MU blog</span>
        </a>
        <div class="hidden md:flex items-center space-x-8 text-gray-700">
            <ul class="flex space-x-8">
                <x-nav-link href="/posts">Main</x-nav-link>
                <x-nav-link href="/authors">Authors</x-nav-link>
                <x-nav-link href="/posts/create">Write a post</x-nav-link>
            </ul>
        </div>
        <div class="hidden md:flex space-x-4 relative">
            @guest
                <a href="/login" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Log In</a>
                <a href="/signup" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Sign Up</a>
            @else
                <div id="user-menu" class="relative">
                    <button id="user-menu-btn" class="flex items-center space-x-4 focus:outline-none">
                        <img src="{{ asset(Auth::user()->profile_image_url) }}" alt="User Profile Image"
                             class="w-8 h-8 rounded-full">
                        <span class="hover:text-blue-600">{{ Auth::user()->username }}</span>
                    </button>
                    <div id="user-submenu"
                         class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md z-20">
                        <a href="/my-posts" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Posts</a>
                        <a href="/edit_user/{{ Auth::user()->id }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Change Profile</a>
                        @can('admin', Auth::user())
                            <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Admin
                                Page
                                @if($unpublishedPostsCount > 0)
                                    | <span class="text-red-500">{{ $unpublishedPostsCount }}</span>
                                @endif
                            </a>
                        @endcan
                        <hr>
                        <button type="submit" form="logout_form"
                                class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out
                        </button>
                    </div>
                </div>
            @endguest
        </div>
        <div class="md:hidden">
            <button id="menu-btn" class="text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>
    </div>
    <div id="menu" class="hidden flex-col md:hidden items-start text-gray-700 space-y-4 mt-4">
        <ul class="flex flex-col space-y-4">
            <x-nav-link href="/posts">Main</x-nav-link>
            <x-nav-link href="/authors">Authors</x-nav-link>
            <x-nav-link href="/posts/create">Write a post</x-nav-link>
        </ul>
        <div class="flex flex-col space-y-4">
            @guest
                <a href="/login" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Log In</a>
                <a href="/signup" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Sign Up</a>
            @else
                <div class="flex items-center space-x-4" id="mobile-user-menu">
                    <img src="{{ asset(Auth::user()->profile_image_url) }}" alt="User Profile Image"
                         class="w-8 h-8 rounded-full">
                    <span class="hover:text-blue-600">{{ Auth::user()->username }}</span>
                </div>
                <div id="mobile-user-submenu"
                     class="hidden flex-col space-y-2 mt-2 bg-white border border-gray-200 rounded shadow-md">
                    <a href="/my-posts" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Posts</a>
                    <a href="/edit_user/{{ Auth::user()->id }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Change
                        Profile</a>
                    @can('admin', Auth::user())
                        <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Admin
                            Page
                            @if($unpublishedPostsCount > 0)
                                | <span class="text-red-500">{{ $unpublishedPostsCount }}</span>
                            @endif
                        </a>
                    @endcan
                    <hr>
                    <button type="submit" form="logout_form" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Log
                        Out
                    </button>
                </div>
            @endguest
        </div>
    </div>
    <form action="/logout" method="POST" class="inline" id="logout_form" hidden>
        @csrf
    </form>
</nav>

<!-- Search bar -->
<div class="bg-gray-200 p-4">
    <div class="container mx-auto">
        <form action="/posts/search" method="POST" class="relative z-10">
            @csrf
            <input type="text" name="query" placeholder="Search..."
                   class="w-full p-2 pr-10 rounded border border-gray-300"
                   value="{{ $search_query ? $search_query : null }}">
            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                     viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<!-- Main Content Wrapper -->
<div class="flex-grow">
    <!-- Main Content -->
    <main class="container mx-auto py-10">
        {{ $slot }}
    </main>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto text-center">
        <div class="space-x-4">
            <x-footer-link href="https://t.me/millatumidiuni">Telegram</x-footer-link>
            <x-footer-link href="https://www.instagram.com/millatumidi_university">Instagram</x-footer-link>
            <x-footer-link href="https://www.youtube.com/@MillatUmidi">YouTube</x-footer-link>
            <x-footer-link href="https://millatumidi.uz/">MU site</x-footer-link>
        </div>
        <p class="mt-4">&copy; 2025 Millat Umidi University. All rights reserved.</p>
    </div>
</footer>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userSubMenu = document.getElementById('user-submenu');
    const mobileUserMenu = document.getElementById('mobile-user-menu');
    const mobileUserSubMenu = document.getElementById('mobile-user-submenu');

    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    userMenuBtn.addEventListener('click', () => {
        userSubMenu.classList.toggle('hidden');
    });

    mobileUserMenu.addEventListener('click', () => {
        mobileUserSubMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>
