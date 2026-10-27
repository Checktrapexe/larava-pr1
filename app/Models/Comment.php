<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'character_id', 'text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function canBeDeletedBy(?User $user): bool
    {
        return $user && ($user->id === $this->user_id || $user->isAdmin());
    }
}
