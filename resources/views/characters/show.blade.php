<x-layout :title="$character->name">
    <main class="mx-auto max-w-4xl px-4 my-10">

        <a href="{{ route('characters.index') }}"
           class="inline-block mb-6 text-gray-300 hover:text-orange-400 transition-colors">
            &larr; Back to all characters
        </a>

        <article class="bg-gray-600 rounded-lg shadow-lg overflow-hidden
                        {{ $character->image ? 'md:grid md:grid-cols-2' : '' }}">

            @if($character->image)
                <img src="{{ route('characters.image', $character) }}"
                     alt="{{ $character->name }}"
                     class="w-full h-full max-h-[28rem] md:max-h-none object-contain bg-gray-800">
            @endif

            <div class="p-8 flex flex-col gap-4">
                <h1 class="text-3xl font-extrabold text-orange-500">
                    {{ $character->name }}
                </h1>

                @if($character->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach($character->categories as $category)
                            <span class="bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <p class="text-gray-100 leading-relaxed whitespace-pre-line">{{ $character->description }}</p>

                <p class="mt-auto pt-4 text-sm text-gray-300 border-t border-gray-500">
                    By <a href="{{ route('users.show', $character->user) }}"
                          class=" font-bold"> {{ $character->user?->name ?? 'Unknown' }}</a>
                    @if($character->created_at)
                        &middot; {{ $character->created_at->format('d M Y') }}
                    @endif
                </p>
            </div>

            @if(auth()->user()?->isAdmin())
                <div class="flex items-center gap-3">
        <span class="text-xs font-bold px-3 py-1 rounded-full text-white
                     {{ $character->active ? 'bg-green-700' : 'bg-gray-500' }}">
            {{ $character->active ? 'Active' : 'Inactive' }}
        </span>

                    <form action="{{ route('characters.toggle', $character) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="text-sm font-bold text-gray-100 hover:text-orange-400 underline transition-colors">
                            {{ $character->active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>
            @endif

            @if($character->isOwnedBy(auth()->user()))
                <div class="flex shrink-0 items-center gap-2">
                    <a href="{{ route('characters.edit', $character) }}"
                       class="bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white text-sm px-4 py-2 rounded">
                        Edit
                    </a>

                    <form action="{{ route('characters.destroy', $character) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete {{ addslashes($character->name) }}? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-700 hover:bg-red-600 transition-colors font-bold text-white text-sm px-4 py-2 rounded">
                            Delete
                        </button>
                    </form>
                </div>
                @endif
                </div>


        </article>
    </main>
</x-layout>
