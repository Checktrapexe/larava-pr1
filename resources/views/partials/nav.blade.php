<nav class="bg-gray-800 p-5 px-20 flex justify-end">
    <x-navlink href="{{route('home')}}" :active="request()->routeIs('home')">Home</x-navlink>
    <x-navlink href="{{route('characters.index')}}" :active="request()->routeIs('characters.index')">Characters
    </x-navlink>
    <x-navlink href="{{route('about')}}" :active="request()->routeIs('about')">About</x-navlink>
    <x-navlink href="{{route('contact')}}" :active="request()->routeIs('contact')">Contact</x-navlink>

    <x-navlink href="{{route('login')}}" :active="request()->routeIs('login')">login
    </x-navlink>
</nav>
