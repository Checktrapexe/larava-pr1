<nav class="bg-gray-800 py-5 px-20 flex items-center justify-end gap-2">
    <x-navlink href="{{ route('home') }}" :active="request()->routeIs('home')">Discover</x-navlink>
    <x-navlink href="{{ route('characters.index') }}" :active="request()->routeIs('characters.*')">Characters
    </x-navlink>

    @auth
        <a href="{{ route('users.show', auth()->user()) }}"
           class="px-3 py-2 font-bold text-orange-500 hover:text-orange-400 transition-colors">
            {{ auth()->user()->name }}
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-black hover:text-orange-400 px-3 py-2 font-bold transition-colors">
                Logout
            </button>
        </form>
    @else
        <x-navlink href="{{ route('login') }}" :active="request()->routeIs('login')">Login</x-navlink>
        <x-navlink href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-navlink>
    @endauth
</nav>
