<nav class="bg-gray-800 py-5 px-20 flex items-center justify-end gap-2">
    <x-navlink href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-navlink>
    <x-navlink href="{{ route('characters.index') }}" :active="request()->routeIs('characters.*')">Characters
    </x-navlink>
    <x-navlink href="{{ route('about') }}" :active="request()->routeIs('about')">About</x-navlink>
    <x-navlink href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contact</x-navlink>

    @auth
        <span class="px-3 py-2 font-bold text-orange-500">{{ auth()->user()->name }}</span>

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
