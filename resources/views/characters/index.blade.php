<x-layout title="Characters">


    <h2>Overview of all the Characters</h2>
    @foreach($characters as $character)
        <div class="m-28 mx-52 bg-gray-600 py-10 px-5">
            <h3>{{ $character->name }}</h3>
            <p>{{ $character->description }}</p>
            <a href="{{ route('characters.show', $character) }}">
                Show character
            </a>
        </div>

    @endforeach
</x-layout>
