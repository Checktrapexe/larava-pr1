<x-layout title="New character">
    <main class="mx-auto max-w-xl px-4 my-10">
        <h2 class="text-center mb-8 font-extrabold text-orange-600">New character</h2>

        <form method="POST" action="{{ route('characters.store') }}" enctype="multipart/form-data"
              class="flex flex-col gap-5">
            @csrf

            <div class="flex flex-col gap-1">
                <label for="name" class="font-bold text-white">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="bg-gray-800 text-white p-2 rounded border border-gray-500">
                @error('name')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="image" class="font-bold text-white">Image (optional)</label>
                <input type="file" id="image" name="image" accept="image/*" class="text-white">
                <p class="text-gray-400 text-xs">JPG, PNG or WebP, max 2 MB.</p>
                @error('image')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="description" class="font-bold text-white">Description</label>
                <textarea id="description" name="description" rows="6"
                          class="bg-gray-800 text-white p-2 rounded border border-gray-500">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="categories" class="font-bold text-white">Categories</label>
                <input type="text" id="categories" name="categories" value="{{ old('categories') }}"
                       placeholder="e.g. Hero, Sorcerer, Anime"
                       class="bg-gray-800 text-white p-2 rounded border border-gray-500">
                <p class="text-gray-400 text-xs">Separate multiple categories with a comma.</p>
                @error('categories')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white p-3 rounded">
                Save character
            </button>
        </form>
    </main>
</x-layout>
