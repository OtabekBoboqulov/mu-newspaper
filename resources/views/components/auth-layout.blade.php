@props(['title'=>'Sign Up'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Standard favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon (for iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" sizes="180x180">

    <!-- Android Icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="192x192" type="image/png">
</head>
<body class="bg-gray-100">
<div class="flex items-center justify-center min-h-screen py-12">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <x-back-to-home/>
        {{ $slot }}
    </div>
</div>
</body>
</html>
