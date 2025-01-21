<x-post-form heading="Create a Post">
    <form action="/posts" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold">Title</label>
            <input type="text" id="title" name="title"
                   class="w-full mt-2 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter the title of your post">
        </div>
        <div class="mb-6">
            <label for="body" class="block text-gray-700 font-semibold">Body</label>
            <textarea id="body" name="body" rows="10"
                      class="w-full mt-2 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Write your post here..."></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-700">Publish
            Post
        </button>
    </form>
</x-post-form>
