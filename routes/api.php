<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::get('posts', function(){
  $posts = Post::all();
  return response()->json([
'status code' =>200,
'post'=>$posts,
  ]);
}); */

//scorciatoia con relazione
/* Route::get('posts', function(){
  $posts = Post::with(['tags','category','user'])->get();
  return $posts;
});  */


//scorciatoia con relazione e paginazione
Route::get('posts', 'API\PostController@index'); 
Route::get('categories', 'API\CategoryController@index'); 
Route::get('tags', 'API\TagController@index'); 

