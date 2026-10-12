<nav>
    <x-navlink href="{{route('home')}}" :active="request()->routeIs('home')">Home</x-navlink>
    <x-navlink href="{{route('about')}}" :active="request()->routeIs('about')">About</x-navlink>
    <x-navlink href="{{route('contact')}}" :active="request()->routeIs('contact')">Contact</x-navlink>
</nav>
