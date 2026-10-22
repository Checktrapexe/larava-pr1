<x-layout title="Edit {{ $character->name }}">
    <main class="mx-auto max-w-xl px-4 my-10">
        <h2 class="text-center mb-8 font-extrabold text-orange-600">Edit character</h2>

        <form method="POST" action="{{ route('characters.update', $character) }}"
              enctype="multipart/form-data" class="flex flex-col gap-5">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-1">
                <label for="name" class="font-bold text-white">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $character->name) }}"
                       class="bg-gray-800 text-white p-2 rounded border border-gray-500">
                @error('name')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="description" class="font-bold text-white">Description</label>
                <textarea id="description" name="description" rows="6"
                          class="bg-gray-800 text-white p-2 rounded border border-gray-500">{{ old('description', $character->description) }}</textarea>
                @error('description')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="categories" class="font-bold text-white">Categories</label>
                <input type="text" id="categories" name="categories"
                       value="{{ old('categories', $character->categories->pluck('name')->implode(', ')) }}"
                       placeholder="e.g. Hero, Sorcerer, Anime"
                       class="bg-gray-800 text-white p-2 rounded border border-gray-500">
                <p class="text-gray-400 text-xs">Separate multiple categories with a comma.</p>
                @error('categories')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="image" class="font-bold text-white">Image</label>

                @if($character->image)
                    <img src="{{ route('characters.image', $character) }}"
                         alt="{{ $character->name }}"
                         class="max-h-40 w-auto self-start rounded bg-gray-800">
                    <p class="text-gray-400 text-xs">Choose a new file only if you want to replace this image.</p>
                @endif

                <input type="file" id="image" name="image" accept="image/*" class="text-white">
                @error('image')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit"
                        class="flex-1 bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white p-3 rounded">
                    Save changes
                </button>
                <a href="{{ route('characters.show', $character) }}"
                   class="px-6 py-3 text-center font-bold text-gray-300 hover:text-orange-400 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </main>
</x-layout>
