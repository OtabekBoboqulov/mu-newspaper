@php use Illuminate\Support\Str; @endphp
@props(['post' => null])
<a href="/posts/{{ $post->id }}"
   class="bg-white shadow-md rounded-lg p-6 hover:shadow-xl transition flex justify-between items-center">
    <div class="post-body max-w-full break-words whitespace-normal w-3/4">
        <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
        <p class="text-gray-600">{!! Str::limit($post->body, 100)  !!}</p>
        <div class="mt-4 text-sm text-gray-500">
            <p>By: {{ $post->author->username }}</p>
            <p>Published on: {{ $post->created_at->format('j F Y') }}</p>
            <p class="flex items-center">
                <span class="flex items-center gap-1">
                    {{ count($post->comments) }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                        <path
                            d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path
                            d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </span>
                <span class="flex items-center gap-1 ml-4">
                    {{ count($post->likes) }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                    </svg>
                </span>
            </p>
        </div>
    </div>
    <img src="{{ asset($post->author->profile_image_url) }}" alt="{{ $post->author->first_name }}"
         class="w-24 h-24 rounded-full ml-4">
</a>
