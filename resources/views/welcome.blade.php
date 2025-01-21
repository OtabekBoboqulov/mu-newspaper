<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MU Newspaper - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Standard favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon (for iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" sizes="180x180">

    <!-- Android Icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="192x192" type="image/png">
</head>
<body class="bg-gray-100">

<!-- Banner Section -->
<header class="bg-blue-600 text-white">
    <div class="container mx-auto flex flex-col items-center py-20">
        <h1 class="text-5xl font-bold mb-4">Welcome to MU Newspaper</h1>
        <p class="text-xl mb-8">Your daily source for the latest news and stories.</p>
        <div class="flex space-x-4">
            @guest
                <a href="/login" class="bg-white text-blue-600 px-6 py-2 rounded hover:bg-gray-100">Log In</a>
                <a href="/signup" class="bg-blue-500 px-6 py-2 rounded hover:bg-blue-700">Sign Up</a>
            @else
                <a href="/posts" class="bg-blue-500 px-6 py-2 rounded hover:bg-blue-700">View Posts</a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="bg-white text-blue-600 px-6 py-2 rounded hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>

<!-- Posts Section -->
<section class="container mx-auto py-20">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold">Latest Posts from Students</h2>
    </div>
    <div class="flex flex-wrap -mx-4">
        <!-- Example of a Post Card -->
        @foreach($posts as $post)
            <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 post-body max-w-full break-words whitespace-normal w-3/4">
                        <div class="flex items-center mb-4">
                            <img src="{{ $post->author->profile_image_url }}" alt="Author Image"
                                 class="w-10 h-10 rounded-full mr-4">
                            <div>
                                <h3 class="text-lg font-bold">{{ $post->author->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $post->created_at->format('j F Y') }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700">{!! Str::limit($post->body, 100) !!}</p>
                        <a href="/posts/{{ $post->id }}" class="text-blue-500 mt-2 block">Read more...</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- See More Button -->
    <div class="text-center mt-8">
        <a href="/posts" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700">See More</a>
    </div>
</section>


<!-- Features Section -->
<section class="container mx-auto py-20">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold">Why Choose MU Newspaper?</h2>
        <p class="text-gray-600 mt-4">Discover our unique features and offerings.</p>
    </div>
    <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-1/3 p-4">
            <div class="bg-white shadow-md p-6 rounded-lg text-center">
                <h3 class="text-2xl font-bold mb-4">Fresh Content</h3>
                <p class="text-gray-600">Stay updated with the latest news and articles from MU students.</p>
            </div>
        </div>
        <div class="w-full md:w-1/3 p-4">
            <div class="bg-white shadow-md p-6 rounded-lg text-center">
                <h3 class="text-2xl font-bold mb-4">Community Driven</h3>
                <p class="text-gray-600">Join our community of writers and share your own stories.</p>
            </div>
        </div>
        <div class="w-full md:w-1/3 p-4">
            <div class="bg-white shadow-md p-6 rounded-lg text-center">
                <h3 class="text-2xl font-bold mb-4">User Friendly</h3>
                <p class="text-gray-600">Enjoy a seamless and intuitive experience on our platform.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
@guest
    <section class="bg-gray-200 py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">Start Your Journey with Us!</h2>
            <p class="text-gray-700 mb-8">Become a part of our growing community and share your stories today.</p>
            <a href="/signup" class="bg-blue-500 text-white px-8 py-3 rounded hover:bg-blue-700">Join Now</a>
        </div>
    </section>
@endguest
<!-- Footer -->
<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2025 MU Newspaper. All rights reserved.</p>
        <div class="mt-4 space-x-4">
            <x-footer-link href="https://t.me/millatumidiuni">Telegram</x-footer-link>
            <x-footer-link href="https://www.instagram.com/millatumidi_university">Instagram</x-footer-link>
            <x-footer-link href="https://www.youtube.com/@MillatUmidi">YouTube</x-footer-link>
            <x-footer-link href="https://millatumidi.uz/">MU site</x-footer-link>
        </div>
    </div>
</footer>

</body>
</html>
