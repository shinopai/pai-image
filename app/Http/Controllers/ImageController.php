<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreImage;
use App\Image;
use Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'download']);
    }
    
    /**
     * store new image(web)
     */
    public function store(StoreImage $request)
    {
        if ($request->file('imagename')) {
            $image = $request->file('imagename');
            $path = Storage::disk('s3')->put('/', $image, 'public');
 
            $image = new Image();
            $image->imagename = Storage::disk('s3')->url($path);
            ;
            $image->user_id = $request->user_id;
            $image->save();

            return redirect()->back()->with('flash', 'New image has posted successfully');
        }
    }

    /**
     * get all images(api)
     */
    public function index()
    {
        $all_images = Image::with(['user', 'likes'])->orderBy('created_at', 'desc')->paginate(3);

        return $all_images ?? abort(404);
    }

    /**
     * get image detail(api)
     */
    public function show(Image $image)
    {
        $image->load('user');
        $image->load('comments');
        $image->load('likes');

        return $image ?? abort(404);
    }

    /**
     * download image(web)
     */
    public function download(Image $image)
    {
        if (! Storage::cloud()->exists($image->imagename)) {
            abort(404);
        }

        $disposition = 'attachment; imagename="' . $image->imagename . '"';
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => $disposition
        ];

        return response(Storage::cloud()->get($image->imagename), 200, $headers);
    }
}
