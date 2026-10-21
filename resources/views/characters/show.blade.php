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
                    By <span class="font-bold">{{ $character->user?->name ?? 'Unknown' }}</span>
                    @if($character->created_at)
                        &middot; {{ $character->created_at->format('d M Y') }}
                    @endif
                </p>
            </div>
        </article>
    </main>
</x-layout>
