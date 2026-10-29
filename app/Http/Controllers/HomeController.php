<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'characters' => Character::with(['user', 'categories'])
                ->where('active', true)
                ->latest()
                ->take(6)
                ->get(),

            'featured' => Character::with(['user', 'categories'])
                ->where('active', true)
                ->inRandomOrder()
                ->first(),
            

            'stats' => [
                'characters' => Character::where('active', true)->count(),
                'creators' => User::has('characters')->count(),
                'comments' => Comment::count(),
            ],
        ]);
    }
}
