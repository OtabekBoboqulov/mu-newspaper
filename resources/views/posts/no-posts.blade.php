<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Your First Story</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Standard favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon (for iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" sizes="180x180">

    <!-- Android Icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="192x192" type="image/png">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-lg shadow-lg pt-4 pb-8 px-8 text-center max-w-md">
    <!-- Back Button -->
    <x-back-to-home/>
    <h1 class="text-2xl font-bold text-gray-800">Write your first story and join our writers</h1>
    <span class="text-blue-500 cursor-pointer mt-4 inline-block" id="toggle-button">Get started</span>
    <div class="mt-6 hidden" id="steps-section">
        <h2 class="text-lg font-semibold text-gray-700">Steps to Write a Post:</h2>
        <ol class="list-decimal list-inside text-left mt-2 text-gray-600">
            <li>Click the below button.</li>
            <li>Write your post.</li>
            <li>Submit it to the admin.</li>
            <li>Once admin approves your post it will be published.</li>
        </ol>
        <button class="bg-blue-500 text-white py-2 px-4 rounded mt-4 hover:bg-blue-700"
                onclick="window.location.href='posts/create'">Write Your First Post
        </button>
    </div>
</div>

<script>
    document.getElementById('toggle-button').addEventListener('click', function () {
        document.getElementById('steps-section').classList.toggle('hidden');
    });
</script>

</body>
</html>
