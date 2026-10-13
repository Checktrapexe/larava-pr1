<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index()
    {
//        $character = new Character();
//        $character->name = 'Yattira';
//        $character->description = 'temp desc';
        $characters = Character::all();


        return view('characters.index', compact('characters'));
    }


    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

}
