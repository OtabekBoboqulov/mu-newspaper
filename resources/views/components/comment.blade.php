@php use Illuminate\Support\Facades\Auth; @endphp
@props(['comment'=>null])

<div class="mt-6 border-t pt-4">
    <div class="flex items-start justify-between">
        <div class="flex">
            <img src="{{ asset($comment->user->profile_image_url) }}" alt="{{ $comment->user->username }}"
                 class="w-12 h-12 rounded-full object-cover mr-4">
            <div>
                <p class="font-semibold">{{ $comment->user->username }}</p>
                <p class="text-sm text-gray-600">{{ $comment->created_at }}</p>
                <p class="mt-2">{{ $comment->comment }}</p>
            </div>
        </div>
        @can('delete', $comment)
            <form action="/comments/{{ $comment->id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                </button>
                <input type="hidden" name="post_id" value="{{ $comment->post->id }}">
            </form>
        @endcan
    </div>
</div>
