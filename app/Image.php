<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Storage;

class Image extends Model
{
    protected $fillable = [
        'imagename', 'user_id'
    ];

    protected $appends = [
        'liked_by_user'
    ];

    protected $visible = [
        'id', 'imagename', 'user', 'comments', 'likes', 'liked_by_user'
    ];

    /**
     * relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    /**
     * accessor
     */
    public function getLikedByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->likes->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
