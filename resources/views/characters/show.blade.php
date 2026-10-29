<x-layout :title="$character->name">
    <main class="mx-auto max-w-4xl px-4 my-10">

        <a href="{{ route('characters.index') }}"
           class="inline-block mb-6 text-gray-300 hover:text-orange-400 transition-colors">
            &larr; Back to all characters
        </a>

        <article class="bg-gray-600 rounded-lg shadow-lg overflow-hidden mb-4
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

        <article class="bg-gray-600 rounded-lg shadow-lg overflow-hidden">
            <div class="p-8 flex flex-col gap-4">
                <h2 class="text-xl font-extrabold text-orange-500">
                    Comments ({{ $character->comments->count() }})
                </h2>

                @auth
                    <form action="{{ route('comments.store', $character) }}" method="POST" class="flex flex-col gap-2">
                        @csrf
                        <textarea name="comment" rows="3" placeholder="Write a comment..."
                                  class="w-full rounded bg-gray-700 text-gray-100 p-3 border border-gray-500 focus:border-orange-500 focus:outline-none">{{ old('comment') }}</textarea>
                        @error('comment')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                                class="self-start bg-orange-600 hover:bg-orange-500 transition-colors font-bold text-white text-sm px-4 py-2 rounded">
                            Post comment
                        </button>
                    </form>
                @else
                    <p class="text-gray-300">
                        <a href="{{ route('login') }}" class="text-orange-400 font-bold">Log in</a> to leave a comment.
                    </p>
                @endauth

                @forelse($character->comments->sortByDesc('created_at') as $comment)
                    <div class="bg-gray-700 rounded p-4">
                        <p class="text-sm text-gray-300 mb-1">
                            <a href="{{ route('users.show', $comment->user) }}" class="font-bold text-orange-400">
                                {{ $comment->user->name }}
                            </a>
                            &middot; {{ $comment->created_at->format('d M Y H:i') }}
                        </p>
                        <p class="text-gray-100 whitespace-pre-line">{{ $comment->text }}</p>

                        @if($comment->canBeDeletedBy(auth()->user()))
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                  onsubmit="return confirm('Delete this comment?')" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-sm font-bold text-red-400 hover:text-red-300 underline transition-colors">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-300">No comments yet. Be the first!</p>
                @endforelse
            </div>
        </article>
    </main>
</x-layout>
