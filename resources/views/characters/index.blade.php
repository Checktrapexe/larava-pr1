<x-layout title="Characters">

    <main>
        <h2 class="text-center m-10 font-extrabold text-orange-600">Overview of all the Characters</h2>

        <div class="text-center">
            @auth
                <a href="{{ route('characters.create') }}"
                   class="inline-block bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white px-6 py-3 rounded">
                    + New character
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="inline-block text-gray-300 hover:text-orange-400 transition-colors font-bold">
                    Log in to create a character
                </a>
            @endauth
        </div>

        <section class="mx-auto my-8 grid max-w-5xl grid-cols-3 gap-6 px-4">
            @foreach($characters as $character)
                <div class="flex flex-col bg-gray-600 py-10 px-5">
                    <h3 class="font-bold mb-6">{{ $character->name }}</h3>
                    <p>{{ Str::limit($character->description, 100) }}</p>
                    <a class="align-bottom font-bold hover:text-orange-400 transition-colors p-3"
                       href="{{ route('characters.show', $character) }}">
                        Show character
                    </a>
                </div>
            @endforeach
        </section>

    </main>
</x-layout>
