<?php

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

Route::get('ingredients', 'IngredientController@index');
Route::post('ingredients', 'IngredientController@store');

Route::get('recipes', 'RecipeController@index');
Route::post('recipes', 'RecipeController@store');

Route::get('boxes', 'BoxController@index');
Route::post('boxes', 'BoxController@store');

Route::get('required-ingredients', 'IngredientController@getRequiredIngredients');
