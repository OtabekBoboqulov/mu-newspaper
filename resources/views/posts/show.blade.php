@php
    use Illuminate\Support\Facades\Auth;
@endphp
<x-layout>
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row justify-between items-start space-y-6 lg:space-y-0 lg:space-x-6">
            <!-- Author Profile Image -->
            <a href="../authors/{{ $post->author->id }}" class="lg:w-1/4 flex justify-center lg:justify-start mt-10">
                <img src="{{ asset($post->author->profile_image_url) }}" alt="{{ $post->author->first_name }}"
                     class="w-48 h-48 lg:w-64 lg:h-64 rounded-full object-cover">
            </a>
            <!-- Post Content -->
            <div class="lg:w-3/4 post-body max-w-full break-words whitespace-normal">
                <h2 class="text-3xl font-bold my-6">{{ $post->title }}</h2>
                <p class="mb-4">{!! $post->body !!}</p>
                @can('admin', Auth::user())
                    <form action="/posts/{{$post->id}}/publish" method="post" class="mb-5">
                        @csrf
                        @if(!$post->published)
                            <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Publish
                            </button>
                        @else
                            <button class="mt-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                Remove
                            </button>
                        @endif
                    </form>
                    <form action="/posts/{{$post->id}}" method="post" class="mb-5">
                        @csrf
                        @method('delete')
                        <button class="mt-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                @endcan
                @can('edit', $post)
                    <div class="mb-5">
                        <a href="/posts/{{ $post->id }}/edit"
                           class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit post</a>
                    </div>
                @endcan
                <p class="text-gray-600 text-sm">By <a href="../authors/{{ $post->author->id }}"
                                                       class="text-blue-500 hover:underline">{{ $post->author->username }}</a>
                    on {{ $post->created_at->format('j F Y') }}</p>

                <!-- Like Button -->
                <div class="mt-6 flex items-center">
                    @auth
                        <button id="likeButton"
                                class="flex items-center p-4 rounded-full
                                   {{ $post->likes->contains('user_id', Auth::id()) ? 'bg-red-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                            </svg>
                        </button>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                        </svg>
                    @endauth
                    <span id="likeCount" class="ml-2">{{ count($post->likes) }}</span>
                </div>

                <!-- Comment Section -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Comments ({{ count($post->comments) }})</h3>
                    @auth
                        <form action="/posts/{{$post->id}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea class="w-full p-4 border rounded-md" placeholder="Add a comment..."
                                      name="comment"></textarea>
                            <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Submit
                            </button>
                        </form>
                    @else
                        <span><a href="/login" class="text-blue-600">Log In</a> to leave a comment</span>
                    @endauth
                    @foreach($post->comments->reverse() as $comment)
                        <x-comment :comment="$comment"></x-comment>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        const likeButton = document.getElementById('likeButton');
        const likeCount = document.getElementById('likeCount');

        likeButton.addEventListener('click', () => {
            const postId = {{ $post->id }};
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    likeButton.classList.toggle('bg-red-500', data.liked);
                    likeButton.classList.toggle('text-white', data.liked);
                    likeButton.classList.toggle('bg-gray-300', !data.liked);
                    likeButton.classList.toggle('text-gray-700', !data.liked);
                    likeCount.textContent = data.likes_count;
                })
                .catch(error => console.error('Error:', error));
        });

    </script>
</x-layout>
