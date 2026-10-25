<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string)$request->query('search', ''));
        $category = $request->query('category');

        $characters = Character::visibleTo($request->user())
            ->with('categories')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->whereHas('categories', fn($q) => $q->where('categories.id', $category));
            })
            ->latest()
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('characters.index', compact('characters', 'categories', 'search', 'category'));
    }

    public function show(Request $request, Character $character)
    {
        abort_unless($character->active || $request->user()?->isAdmin(), 404);

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

        $names = $this->parseCategories($validated['categories']);

        $data = collect($validated)->except(['categories', 'image'])->all();

        if ($request->hasFile('image')) {
            $data['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $character = $request->user()->characters()->create($data);

        $this->syncCategories($character, $names);

        return redirect()->route('characters.show', $character);
    }

    public function edit(Request $request, Character $character)
    {
        abort_unless($character->isOwnedBy($request->user()), 403);

        return view('characters.edit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        abort_unless($character->isOwnedBy($request->user()), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'categories' => 'required|string|max:255',
        ]);

        $names = $this->parseCategories($validated['categories']);

        $data = collect($validated)->except(['categories', 'image'])->all();

        if ($request->hasFile('image')) {
            $data['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $character->update($data);

        $this->syncCategories($character, $names);

        return redirect()->route('characters.show', $character);
    }

    public function destroy(Request $request, Character $character)
    {
        abort_unless($character->isOwnedBy($request->user()), 403);

        $character->categories()->detach();
        $character->delete();

        return redirect()->route('characters.index');
    }

    public function toggle(Request $request, Character $character)
    {
        abort_unless($request->user()->isAdmin(), 403);

        $character->active = !$character->active;
        $character->save();

        return back();
    }

    public function image(Request $request, Character $character)
    {
        abort_unless($character->active || $request->user()?->isAdmin(), 404);
        abort_if(!$character->image, 404);

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($character->image);

        return response($character->image)->header('Content-Type', $mime);
    }

    // "Hero, sorcerer ,hero" -> ['Hero', 'sorcerer']
    private function parseCategories(string $input): Collection
    {
        $names = collect(explode(',', $input))
            ->map(fn($name) => trim($name))
            ->filter()
            ->unique(fn($name) => Str::lower($name))
            ->values();

        if ($names->isEmpty()) {
            throw ValidationException::withMessages(['categories' => 'Give at least one category.']);
        }

        if ($names->contains(fn($name) => mb_strlen($name) > 30)) {
            throw ValidationException::withMessages(['categories' => 'A category can be 30 characters at most.']);
        }

        return $names;
    }

    private function syncCategories(Character $character, Collection $names): void
    {
        $ids = $names->map(function ($name) {
            $category = Category::whereRaw('LOWER(name) = ?', [Str::lower($name)])->first()
                ?? Category::create(['name' => $name]);

            return $category->id;
        });

        $character->categories()->sync($ids->all());
    }
}
