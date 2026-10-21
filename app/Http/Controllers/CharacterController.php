<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::with('categories')->get();

        return view('characters.index', compact('characters'));
    }

    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    public function create()
    {
        return view('characters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'categories' => 'required|string|max:255',
        ]);

        // "Hero, sorcerer ,hero" -> ['Hero', 'sorcerer']
        $names = collect(explode(',', $validated['categories']))
            ->map(fn($name) => trim($name))
            ->filter()
            ->unique(fn($name) => Str::lower($name))
            ->values();

        if ($names->isEmpty()) {
            return back()->withErrors(['categories' => 'Give at least one category.'])->withInput();
        }

        if ($names->contains(fn($name) => mb_strlen($name) > 30)) {
            return back()->withErrors(['categories' => 'A category can be 30 characters at most.'])->withInput();
        }

        if ($request->hasFile('image')) {
            $validated['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $character = $request->user()->characters()->create(
            collect($validated)->except('categories')->all()
        );

        $categoryIds = $names->map(function ($name) {
            $category = Category::whereRaw('LOWER(name) = ?', [Str::lower($name)])->first()
                ?? Category::create(['name' => $name]);

            return $category->id;
        });

        $character->categories()->sync($categoryIds->all());

        return redirect()->route('characters.show', $character);
    }

    public function image(Character $character)
    {
        abort_if(!$character->image, 404);

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($character->image);

        return response($character->image)->header('Content-Type', $mime);
    }
}
