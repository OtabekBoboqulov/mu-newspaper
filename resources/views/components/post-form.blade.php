@props(['heading' => null])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Standard favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon (for iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" sizes="180x180">

    <!-- Android Icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="192x192" type="image/png">
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full">
    <x-back-to-home/>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $heading }}</h1>
    {{ $slot }}
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
