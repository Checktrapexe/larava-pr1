<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Character extends Model
{
    //
    protected $fillable = ['name', 'description', 'image'];

    protected $hidden = ['image'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwnedBy(?User $user): bool
    {
        return $user !== null && (int)$this->user_id === $user->id;
    }

}
