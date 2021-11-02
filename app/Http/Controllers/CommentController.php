<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use App\Comment;
use App\Image;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * store comment
     */
    public function store(StoreComment $request, Image $image)
    {
        $image->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return redirect()->back()->with('flash', 'New comment has posted successfully');
    }
}
