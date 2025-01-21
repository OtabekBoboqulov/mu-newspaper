@props(['name'])

@error($name)
    <p class="text-red-600 mt-1 mb-3 text-sm">{{ $message }}</p>
@enderror
