<x-layout>
    <h2 class="text-3xl font-bold my-6">Unpublished Posts</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @foreach($posts as $post)
            <x-post :post="$post"/>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
    @if(session('success'))
        <x-success/>
    @endif
</x-layout>
