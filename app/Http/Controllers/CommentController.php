<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request, Character $character)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $character->comments()->create([
            'user_id' => auth()->id(),
            'text' => $validated['comment'],
        ]);
        return redirect()->route('characters.show', $character);
    }


    public function destroy(Comment $comment)
    {
        abort_unless($comment->canBeDeletedBy(auth()->user()), 403);

        $character = $comment->character;
        $comment->delete();

        return redirect()->route('characters.show', $character);
    }
}
