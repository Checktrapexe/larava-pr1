<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Character extends Model
{
    //
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

// admins zien alles, iedereen anders alleen actieve characters
    public function scopeVisibleTo(Builder $query, ?User $user): Builder
    {
        return ($user && $user->isAdmin()) ? $query : $query->where('active', true);
    }

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
