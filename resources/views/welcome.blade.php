<x-layout title="Home">

    {{-- Hero --}}
    <section class="text-center px-4 pt-14 pb-10 max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-extrabold text-orange-500">
            Discover New Characters
        </h1>
        <p class="mt-4 text-lg text-gray-300">
            A place to share the characters you've dreamed up, and find new ones
            made by other people. Browse, comment, and get inspired.
        </p>

        <div class="mt-6 flex justify-center gap-3">
            <a href="{{ route('characters.index') }}"
               class="bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white px-5 py-2 rounded">
                Browse all characters
            </a>
            @auth
                <a href="{{ route('characters.create') }}"
                   class="bg-gray-600 hover:bg-gray-500 transition-colors font-bold text-gray-100 px-5 py-2 rounded">
                    Create yours
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="bg-gray-600 hover:bg-gray-500 transition-colors font-bold text-gray-100 px-5 py-2 rounded">
                    Join for free
                </a>
            @endauth
        </div>
    </section>

    {{-- Stats --}}
    <section class="max-w-3xl mx-auto px-4 mb-12">
        <div class="grid grid-cols-3 gap-4 text-center">
            <div class="bg-gray-600 rounded-lg p-4">
                <p class="text-3xl font-extrabold text-orange-500">{{ $stats['characters'] }}</p>
                <p class="text-sm text-gray-300">Characters</p>
            </div>
            <div class="bg-gray-600 rounded-lg p-4">
                <p class="text-3xl font-extrabold text-orange-500">{{ $stats['creators'] }}</p>
                <p class="text-sm text-gray-300">Creators</p>
            </div>
            <div class="bg-gray-600 rounded-lg p-4">
                <p class="text-3xl font-extrabold text-orange-500">{{ $stats['comments'] }}</p>
                <p class="text-sm text-gray-300">Comments</p>
            </div>
        </div>
    </section>

    {{-- Featured --}}
    @if($featured)
        <section class="max-w-5xl mx-auto px-4 mb-12">
            <h2 class="text-xl font-extrabold text-orange-500 mb-4">&#9733; Featured today</h2>

            <a href="{{ route('characters.show', $featured) }}"
               class="block bg-gray-600 rounded-lg shadow-lg hover:shadow-xl transition overflow-hidden
                      {{ $featured->image ? 'md:grid md:grid-cols-2' : '' }}">
                @if($featured->image)
                    <img src="{{ route('characters.image', $featured) }}"
                         alt="{{ $featured->name }}"
                         class="w-full h-64 md:h-full object-contain bg-gray-800">
                @endif

                <div class="p-8 flex flex-col gap-3">
                    <h3 class="text-2xl font-extrabold text-gray-100">{{ $featured->name }}</h3>

                    @if($featured->categories->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($featured->categories as $category)
                                <span class="bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <p class="text-gray-200 leading-relaxed">
                        {{ Str::limit($featured->description, 220) }}
                    </p>
                    <p class="mt-auto text-sm text-gray-300">
                        By {{ $featured->user?->name ?? 'Unknown' }}
                    </p>
                </div>
            </a>
        </section>
    @endif
    

    {{-- Latest --}}
    <section class="max-w-5xl mx-auto px-4 mb-12">
        <div class="flex items-end justify-between mb-4">
            <h2 class="text-xl font-extrabold text-orange-500">Fresh from the community</h2>
            <a href="{{ route('characters.index') }}"
               class="text-sm text-gray-300 hover:text-orange-400 transition-colors">
                View all &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($characters as $character)
                <a href="{{ route('characters.show', $character) }}"
                   class="block bg-gray-600 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    @if($character->image)
                        <img src="{{ route('characters.image', $character) }}"
                             alt="{{ $character->name }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-800 flex items-center justify-center text-5xl text-gray-500">
                            {{ Str::upper(Str::substr($character->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-100">{{ $character->name }}</h3>
                        <p class="text-xs text-orange-400 mb-2">
                            {{ $character->categories->pluck('name')->take(3)->join(' · ') }}
                        </p>
                        <p class="text-sm text-gray-300">
                            {{ Str::limit($character->description, 80) }}
                        </p>
                        <p class="mt-3 text-xs text-gray-400">
                            By {{ $character->user?->name ?? 'Unknown' }}
                            &middot; {{ $character->created_at?->diffForHumans() }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="col-span-3 text-center text-gray-300">No characters yet. Be the first to add one!</p>
            @endforelse
        </div>
    </section>

    {{-- CTA --}}
    @guest
        <section class="max-w-3xl mx-auto px-4 mb-16">
            <div class="bg-gray-600 rounded-lg p-8 text-center">
                <h2 class="text-2xl font-extrabold text-gray-100">Got a character of your own?</h2>
                <p class="mt-2 text-gray-300">Make an account, upload your character, and let others comment on it.</p>
                <a href="{{ route('register') }}"
                   class="inline-block mt-4 bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white px-5 py-2 rounded">
                    Create an account
                </a>
            </div>
        </section>
    @endguest

</x-layout>
