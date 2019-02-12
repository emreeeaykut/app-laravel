<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
	
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

 //    Route::group(['prefix' => 'admin'],function(){
	//     Route::resource('works', 'Admin\WorkController', ['only' => ['index', 'store', 'update', 'destroy']]);
	//     Route::get('/works/total', 'Admin\WorkController@total');
	//     Route::resource('workImages', 'Admin\WorkImageController', ['only' => ['show', 'store', 'destroy']]);
	// });

	Route::post('/logout', 'AuthController@logout');
});

Route::group(['prefix' => 'admin'],function(){
	    Route::resource('works', 'Admin\WorkController', ['only' => ['index', 'store', 'update', 'destroy']]);
	    Route::get('/works/total', 'Admin\WorkController@total');
	    Route::resource('workImages', 'Admin\WorkImageController', ['only' => ['show', 'store', 'destroy']]);
	});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::resource('works', 'WorkController', ['only' => ['index', 'show']]);

// asset url (start)
Route::get('/storage/{filename}', function ($filename)
{
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
// asset url (end)
