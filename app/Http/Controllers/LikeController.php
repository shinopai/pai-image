<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\Image;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * like image
     */
    public function store(Request $request, Image $image)
    {
        $image->likes()->detach(\Auth::user()->id);
        $image->likes()->attach($request->user_id);
        
        return $image;
    }

    /**
     * unlike image
     */
    public function destroy(Image $image)
    {
        $image->likes()->detach(Auth::user()->id);
    }
}
