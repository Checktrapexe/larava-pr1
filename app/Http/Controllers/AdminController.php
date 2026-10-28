<?php

namespace App\Http\Controllers;

use App\Models\Character;

class AdminController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $characters = Character::with(['user', 'categories'])
            ->latest()
            ->get();

        return view('admin.index', compact('characters'));
    }
}
