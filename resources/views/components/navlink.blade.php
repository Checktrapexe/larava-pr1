@props(['active' => false])


<a {{$attributes}} class="{{ $active ? 'text-orange-600' : '' }} font-bold hover:text-orange-400 transition-colors p-3">{{$slot}}</a>
