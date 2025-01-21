<x-auth-layout title="Edit User Information">
    <!-- Edit User Information Form -->
    <h2 class="text-2xl font-semibold text-center mb-6">Edit your profile</h2>
    <form action="/edit_user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- First Name -->
        <div class="mb-4">
            <x-form-label for="first_name">First Name</x-form-label>
            <x-form-input name="first_name" id="first_name" value="{{ $user->first_name }}"/>
        </div>
        <x-form-error name="first_name"/>
        <!-- Last Name -->
        <div class="mb-4">
            <x-form-label for="last_name">Last Name</x-form-label>
            <x-form-input name="last_name" id="last_name" value="{{ $user->last_name }}"/>
        </div>
        <x-form-error name="last_name"/>
        <!-- Username -->
        <div class="mb-4">
            <x-form-label for="username">Username</x-form-label>
            <x-form-input name="username" id="username" value="{{ $user->username }}"/>
        </div>
        <x-form-error name="username"/>
        <!-- Profile Image -->
        <div class="mb-4">
            <x-form-label for="profile_image">Profile Image</x-form-label>
            <div class="flex flex-col items-center">
                <img src="{{ asset($user->profile_image_url) }}" alt="Profile Image" id="profile_image_preview"
                     class="w-32 h-32 rounded-full mb-4">
                <div class="flex space-x-4">
                    <!-- Edit Button -->
                    <button type="button" id="edit_button"
                            class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd"
                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </button>
                    <!-- Delete Button -->
                    <button type="button" id="delete_button"
                            class="flex items-center bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Hidden File Input -->
            <input type="file" name="profile_image_url" id="profile_image_input" class="hidden">
        </div>

        <x-form-error name="profile_image_url"/>
        <!-- Email -->
        <div class="mb-4">
            <x-form-label for="email">Email</x-form-label>
            <x-form-input type="email" name="email" id="email" value="{{ $user->email }}"/>
        </div>
        <x-form-error name="email"/>
        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded-md hover:bg-blue-600">Update
        </button>
    </form>
</x-auth-layout>
<script>
    document.getElementById('delete_button').addEventListener('click', function() {
        // Trigger click on the file input
        const image_input = document.getElementById('profile_image_input');
        const image_preview = document.getElementById('profile_image_preview');
        image_preview.src = '{{ asset('uploads/profile_images/no_image.jpg') }}';
        image_input.type = 'text';
        image_input.value = 'no.jpg';
    });
</script>
