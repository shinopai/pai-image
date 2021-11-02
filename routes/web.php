<?php
// download image
Route::get('/images/{image}/download', 'ImageController@download');

// response html template except API request
Route::get('/{any?}', function () {
    return view('index');
})->where('any', '^(?!.*(login|register)).*$');

// auth user route
Auth::routes();

// image route
Route::resource('image', ImageController::class, ['only' => ['store']]);

if (config('app.env') === 'production' or config('app.env') === 'staging') {
    URL::forceScheme('https');
}
