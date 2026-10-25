<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request, User $user)
    {
        $characters = $user->characters()
            ->visibleTo($request->user())
            ->with('categories')
            ->latest()
            ->get();

        return view('user.show', compact('user', 'characters'));
    }
}
