@props(['active' => false])

<a {{ $attributes->class([
    'px-3 py-2 font-bold transition-colors hover:text-orange-400',
    'text-orange-500' => $active,
    'text-gray-100'   => ! $active,
]) }}>
    {{ $slot }}
</a>
