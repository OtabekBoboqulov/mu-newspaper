<x-layout>
    <h2 class="text-3xl font-bold my-6">My Posts</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @foreach($posts as $post)
            <x-my-post :post="$post"/>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
    <div class="flex justify-center items-center">
        <a href="/posts/create"
           class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
            Write a post
        </a>
    </div>
</x-layout>
