<?php

use Illuminate\Http\Request;
use App\Member;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('logout', 'AuthController@logout');

    Route::get('members', 'MembersController@getMembers');
    Route::post('members', 'MembersController@updateMembers');

    Route::get('workouts', 'WorkoutsController@getWorkouts');
    Route::post('workout', 'WorkoutsController@saveWorkout');
});
