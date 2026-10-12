@props(['active' => false])


<a {{$attributes}} class="{{ $active ? 'text-red-600' : '' }}">{{$slot}}</a>
