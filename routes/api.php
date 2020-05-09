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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//this route is for testing tmdb api
 Route::get('/movie2', 'ApiController@handle');
//this route is for json query
  Route::post('/search', 'ApiController@jsonQuuery');

//this route is for postman api data push to databse
  Route::post('/movie_post','ApiController@store');

  //api for this application only movie db 

  Route::get('/movie-api','ApiController@taskAPI');