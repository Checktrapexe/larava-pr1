<x-layout title="{{ $character->name }}"> {{-- or @extends('layouts.app') depending on your setup --}}
    <h1>{{ $character->name }}</h1>

    <p>{{ $character->description }}</p>

    <small>Created {{ $character->created_at->format('d M Y') }}</small>

    <a href="{{ route('characters.index') }}">Back</a>
</x-layout>
