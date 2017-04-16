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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Category
Route::get('category', ['uses' => 'API\CategoryController@index']);
Route::get('category/create', ['uses' => 'API\CategoryController@create']);
Route::get('category/{id}', ['uses' => 'API\CategoryController@show']);

// Recipe
Route::get('recipe/featured', ['uses' => 'API\RecipeController@featured']);
Route::get('recipe/{id}', ['uses' => 'API\RecipeController@show']);
Route::get('recipe/list/all/{page}', ['uses' => 'API\RecipeController@index']);
Route::get('recipe/list/user/{userId}/{page}/1', ['uses' => 'API\RecipeController@getUserRecipes']);
Route::get('recipe/category/{categoryId}/{page}', ['uses' => 'API\RecipeController@getCategoryRecipes']);

// User
Route::get('user/{id}', ['uses' => 'API\UserController@show']);
Route::get('user/authenticate/{facebook_access_token}', ['uses' => 'API\UserController@getFacebookUser']);
