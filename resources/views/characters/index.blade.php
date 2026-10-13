<x-layout title="Characters">

    <main>
        <h2 class="text-center m-10 font-extrabold text-orange-600">Overview of all the Characters</h2>

        <section class="mx-auto my-8 grid max-w-5xl grid-cols-3 gap-6 px-4">
            @foreach($characters as $character)
                <div class="flex flex-col bg-gray-600 py-10 px-5">
                    <h3 class="font-bold mb-6">{{ $character->name }}</h3>
                    <p>{{ $character->description }}</p>
                    <a class="align-bottom font-bold hover:text-orange-400 transition-colors p-3"
                       href="{{ route('characters.show', $character) }}">
                        Show character
                    </a>
                </div>
            @endforeach
        </section>

    </main>
</x-layout>
