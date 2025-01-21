<x-auth-layout title="Log In">
    <!-- Log In Form -->
    <h2 class="text-2xl font-semibold text-center mb-6">Log In</h2>
    <form action="/login" method="POST">
        @csrf
        <!-- Email -->
        <div class="mb-4">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input type="email" name="email" id="email"/>
        </div>
        <x-form-error name="email"/>
        <!-- Password -->
        <div class="mb-4">
            <x-form-label for="password">Password</x-form-label>
            <x-form-input type="password" name="password" id="password"/>
        </div>
        <x-form-error name="password"/>
        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded-md hover:bg-blue-600">Log In
        </button>
        <div class="mt-2 text-sm">Do not have an account? <a href="/signup" class="text-blue-600">Sign Up</a></div>
    </form>
</x-auth-layout>
