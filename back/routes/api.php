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
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Authorization, x-socket-id, Access-Control-Allow-Origin, X-Requested-With");

Route::middleware(['cors'])->group(function(){
    // Broadcast::routes();

    Route::post('/auth/login', 'App\Http\Controllers\AuthController@login');
    Route::post('/auth/register', 'App\Http\Controllers\AuthController@register');
    
    Route::group([
        'middleware' => 'jwt.verify',
    ], function ($router) {
        
        Route::get('/retrieve_departments', 'App\Http\Controllers\DepartmentMasterController@index');
        Route::get('/retrieve_tags', 'App\Http\Controllers\TagMasterController@index');
        Route::get('/retrieve_roles', 'App\Http\Controllers\RoleMasterController@index');
        Route::group([
            'prefix' => 'auth'
        ], function($router) {
            Route::post('/auth/register', 'App\Http\Controllers\AuthController@register');
            Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
            Route::post('/refresh', 'App\Http\Controllers\AuthController@refresh');
            Route::get('/retrieve_user', 'App\Http\Controllers\AuthController@retrieveUser');
            Route::post('/retrieve_auth', 'App\Http\Controllers\AuthController@retrieveAuth');
            Route::get('/retrieve_user_list', 'App\Http\Controllers\AuthController@retrieveUserList');
            Route::post('/retrieve_user_byid', 'App\Http\Controllers\AuthController@retrieveUserById');
            Route::post('/update_user', 'App\Http\Controllers\AuthController@updateUser');
            Route::post('/delete_user', 'App\Http\Controllers\AuthController@deleteUser');
        });

        Route::group([
            'prefix' => 'qa'
        ], function($router) {
            Route::post('/retrieve_qa_group', 'App\Http\Controllers\QAController@retrieveQAGroup');
            Route::post('/post_question', 'App\Http\Controllers\QAController@postQuestion');
            Route::post('/post_answer', 'App\Http\Controllers\QAController@postAnswer');
            Route::post('/follow', 'App\Http\Controllers\QAController@follow');
        });
    });
});
