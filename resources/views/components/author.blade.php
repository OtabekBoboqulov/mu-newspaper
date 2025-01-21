@php use Illuminate\Support\Facades\Auth; @endphp
@props(['author'=>null])
<!-- Author 1 -->
<div class="text-center">
    <img src="{{ asset($author->profile_image_url) }}" alt="Author 1" class="w-32 h-32 rounded-full mx-auto mb-4">
    <h2 class="text-xl font-semibold text-gray-800">{{ $author->username }}</h2>
    <a href="/authors/{{ $author->id }}" class="text-blue-600 hover:underline">Posts: {{ count($author->posts) }}</a>
    @can('superadmin', Auth::user())
        <br>
        @if($author->status != 'superadmin' && $author->status != 'admin')
            <a href="/promotion/{{ $author->id }}" class="text-blue-600 hover:underline">Promote to Admin</a>
        @elseif($author->status == 'admin' && $author->status != 'superadmin')
            <a href="/removeadmin/{{ $author->id }}" class="text-blue-600 hover:underline">Remove Admin</a>
        @endif
    @endcan
</div>
