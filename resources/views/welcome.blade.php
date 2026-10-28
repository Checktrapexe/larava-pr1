<x-layout title="Home">
    <h2 class="text-center m-10 font-extrabold text-orange-600">Discover New Characters</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto px-4">
        @forelse ($characters as $character)
            <a href="{{ route('characters.show', $character) }}"
               class="block bg-gray-600 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                <img src="{{ route('characters.image', $character) }}"
                     alt="{{ $character->name }}"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h3 class="font-bold text-lg">{{ $character->name }}</h3>
                    <p class="text-sm text-gray-600">
                        {{ Str::limit($character->description, 80) }}
                    </p>
                </div>
            </a>
        @empty
            <p class="col-span-3 text-center text-gray-500">No characters yet.</p>
        @endforelse
    </div>
</x-layout>
