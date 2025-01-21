<x-auth-layout title="Sign Up">
    <!-- Sign Up Form -->
    <h2 class="text-2xl font-semibold text-center mb-6">Sign Up</h2>
    <form action="/signup" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- First Name -->
        <div class="mb-4">
            <x-form-label for="first_name">First Name</x-form-label>
            <x-form-input name="first_name" id="first_name"/>
        </div>
        <x-form-error name="first_name"/>
        <!-- Last Name -->
        <div class="mb-4">
            <x-form-label for="lasst_name">Last Name</x-form-label>
            <x-form-input name="last_name" id="last_name"/>
        </div>
        <x-form-error name="last_name"/>
        <!-- Username -->
        <div class="mb-4">
            <x-form-label for="username">Username</x-form-label>
            <x-form-input name="username" id="username"/>
        </div>
        <x-form-error name="username"/>
        <!-- Profile Image -->
        <div class="mb-4">
            <x-form-label for="profile_image_url">Profile Image</x-form-label>
            <input type="file" name="profile_image_url" id="profile_image" class="w-full p-2 border rounded-md">
        </div>
        <x-form-error name="profile_image_url"/>
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
        <!-- Password Confirmation -->
        <div class="mb-4">
            <x-form-label for="password_confirmation">Confirm Password</x-form-label>
            <x-form-input type="password" name="password_confirmation" id="password_confirmation"/>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded-md hover:bg-blue-600">Sign Up
        </button>
        <div class="mt-2 text-sm">Already have an account? <a href="/login" class="text-blue-600">Log In</a></div>
    </form>
</x-auth-layout>
