<?php

use Illuminate\Http\Request;

// Route::middleware('auth:web')->get('/user', function (Request $request) {
//     return $request->user();
// });

// get current user
Route::get('/user', 'UserController@getUser');

// get all images
Route::get('/images', 'ImageController@index')->name('image.index');

// get image detail
Route::get('/images/{image}', 'ImageController@show')->name('image.show')->where('image', '[0-9]+');

// create comment
Route::post('/images/{image}/comments', 'CommentController@store')->name('image.comment');

// like image
Route::put('/images/{image}/like', 'LikeController@store')->name('image.like');

// unlike image
Route::delete('/images/{image}/like', 'LikeController@destroy');
