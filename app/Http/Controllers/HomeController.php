<?php

namespace App\Http\Controllers;

use App\Models\Character;

class HomeController extends Controller
{
    // Home / landing page (shows the 3 newest characters)
    public function __invoke()
    {

        $characters = Character::where('active', true)->latest()->take(3)->get();
        return view('welcome', ['characters' => $characters]);
    }
}
