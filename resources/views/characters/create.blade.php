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

            <div class="flex flex-col gap-2">
                <span class="font-bold text-white">Categories</span>

                @php
                    $selected = old('category_ids', isset($character) ? $character->categories->pluck('id')->all() : []);
                @endphp

                <div class="flex flex-wrap gap-3">
                    @foreach($categories as $cat)
                        <label class="flex items-center gap-2 text-white">
                            <input type="checkbox" name="category_ids[]" value="{{ $cat->id }}"
                                @checked(in_array($cat->id, $selected))>
                            {{ $cat->name }}
                        </label>
                    @endforeach
                </div>

                
            </div>

            <button type="submit"
                    class="bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white p-3 rounded">
                Save character
            </button>
        </form>
    </main>
</x-layout>
