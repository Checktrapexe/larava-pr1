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

        <form method="GET" action="{{ route('characters.index') }}"
              class="mx-auto mt-8 flex max-w-5xl flex-col gap-3 px-4 sm:flex-row">
            <input type="search" name="search" value="{{ $search }}"
                   placeholder="Search by name or description..."
                   class="flex-1 bg-gray-800 text-white p-2 rounded border border-gray-500">

            <select name="category"
                    class="bg-gray-800 text-white p-2 rounded border border-gray-500">
                <option value="">All categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($category == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit"
                    class="bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white px-6 py-2 rounded">
                Search
            </button>

            @if($search !== '' || $category)
                <a href="{{ route('characters.index') }}"
                   class="px-4 py-2 text-center font-bold text-gray-300 hover:text-orange-400 transition-colors">
                    Reset
                </a>
            @endif
        </form>

        <section class="mx-auto my-8 grid max-w-5xl grid-cols-1 gap-6 px-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse($characters as $character)
                <div class="flex flex-col bg-gray-600 py-10 px-5">
                    <h3 class="font-bold mb-3">{{ $character->name }}</h3>

                    @if($character->categories->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($character->categories as $tag)
                                <a href="{{ route('characters.index', ['category' => $tag->id]) }}"
                                   class="bg-orange-600 hover:bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <p>{{ Str::limit($character->description, 100) }}</p>

                    <a class="align-bottom font-bold hover:text-orange-400 transition-colors p-3"
                       href="{{ route('characters.show', $character) }}">
                        Show character
                    </a>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-300">No characters found.</p>
            @endforelse
        </section>

    </main>
</x-layout>
