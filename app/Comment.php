<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'image_id', 'content'
    ];

    protected $visible = [
        'content', 'user'
    ];

    // relation
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
