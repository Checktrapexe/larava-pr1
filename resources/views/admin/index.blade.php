<x-layout title="Admin">
    <main class="mx-auto max-w-4xl px-4 my-10">
        <h1 class="text-3xl font-extrabold text-orange-500 mb-6">Admin</h1>

        <div class="bg-gray-600 rounded-lg shadow-lg overflow-x-auto">
            <table class="w-full text-left text-gray-100">
                <thead class="bg-gray-700 text-sm text-gray-300">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Owner</th>
                    <th class="p-3">Categories</th>
                    <th class="p-3">Status</th>
                    <th class="p-3"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($characters as $character)
                    <tr class="border-t border-gray-500">
                        <td class="p-3">
                            <a href="{{ route('characters.show', $character) }}"
                               class="font-bold text-orange-400">
                                {{ $character->name }}
                            </a>
                        </td>
                        <td class="p-3"><a href="{{ route('users.show', $character->user) }}" class="underline">
                                {{ $character->user->name }}</a></td>

                        </a>
                        <td class="p-3">{{ $character->categories->pluck('name')->join(', ') }}</td>
                        <td class="p-3">
                                <span class="text-xs font-bold px-3 py-1 rounded-full text-white
                                             {{ $character->active ? 'bg-green-700' : 'bg-gray-500' }}">
                                    {{ $character->active ? 'Active' : 'Inactive' }}
                                </span>
                        </td>
                        <td class="p-3">
                            <form action="{{ route('characters.toggle', $character) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        role="switch"
                                        aria-checked="{{ $character->active ? 'true' : 'false' }}"
                                        title="{{ $character->active ? 'Deactivate' : 'Activate' }}"
                                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors
                                        focus:outline-none focus:ring-2 focus:ring-orange-400
                                        {{ $character->active ? 'bg-green-600' : 'bg-gray-500' }}">
                                         <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform
                                        {{ $character->active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-gray-300">No characters yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</x-layout>
