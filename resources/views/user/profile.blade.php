<x-layout :title="$user->name">
    <main class="mx-auto max-w-5xl px-4 my-10">

        <section class="bg-gray-600 rounded-lg shadow-lg p-8 flex flex-col gap-6 sm:flex-row sm:items-start">
            <div
                class="flex h-24 w-24 shrink-0 items-center justify-center rounded-full bg-orange-600 text-4xl font-extrabold text-white">
                {{ Str::upper(Str::substr($user->name, 0, 1)) }}
            </div>

            <div class="flex-1">
                <h1 class="text-3xl font-extrabold text-orange-500">{{ $user->name }}</h1>

                <p class="mt-1 text-sm text-gray-300">
                    Member since {{ $user->created_at?->format('M Y') ?? 'unknown' }}
                    &middot; {{ $characters->count() }} {{ Str::plural('character', $characters->count()) }}
                </p>

                <p class="mt-4 text-gray-100 leading-relaxed whitespace-pre-line">{{ $user->bio ?: 'This user has not written a bio yet.' }}</p>

                @if((int) auth()->id() === $user->id)
                    <a href="{{ route('profile.edit') }}"
                       class="inline-block mt-4 bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white text-sm px-4 py-2 rounded">
                        Edit profile
                    </a>
                @endif
            </div>
        </section>

        <h2 class="mt-10 mb-4 text-xl font-extrabold text-orange-600">Characters by {{ $user->name }}</h2>

        <section class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($characters as $character)
                <div class="flex flex-col bg-gray-600 py-10 px-5 {{ $character->active ? '' : 'opacity-60' }}">
                    <h3 class="font-bold mb-3">{{ $character->name }}</h3>

                    @unless($character->active)
                        <span
                            class="self-start mb-3 bg-gray-800 text-gray-300 text-xs font-bold px-3 py-1 rounded-full">
                            Inactive
                        </span>
                    @endunless

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
                <p class="col-span-full text-gray-300">No characters yet.</p>
            @endforelse
        </section>
    </main>
</x-layout>
