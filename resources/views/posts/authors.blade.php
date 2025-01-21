<x-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold text-center mb-10">Authors</h1>
        <!-- Author Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($authors as $author)
                <x-author :author="$author"/>
            @endforeach
        </div>
    </div>
</x-layout>
