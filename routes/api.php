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
Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::group(['prefix'=>'articles'], function(){
        Route::get('/popular', [
            'uses'=>'ArticlesController@getPopular'
        ]);

        Route::get('/get/{id}', [
            'uses'=>'ArticlesController@readSingle'
        ]);
        Route::get('/all', [
            'uses'=>'ArticlesController@readAll'
        ]);
        Route::get('/popular', [
            'uses'=>'ArticlesController@getPopular'
        ]);
        Route::get('/paginate/', [
            'uses' => 'ArticlesController@paginate'
        ]);
        Route::get('/{id}/views/', [
            'uses' => 'ArticlesController@getViews'
        ]);
    });
    Route::group(['prefix'=>'categories'], function(){
        Route::get('/popular', [
            'uses'=>'CategoriesController@getPopular'
        ]);

        //display the articles in a certain category
        Route::get('/{id}/articles', [
            'uses'=>'CategoriesController@readArticlesInThis'
        ]);
        Route::get('/get/{id}', [
            'uses'=>'CategoriesController@readSingle'
        ]);
        Route::get('/all', [
            'uses'=>'CategoriesController@readAll'
        ]);
        Route::get('/popular', [
            'uses'=>'CategoriesController@getPopular'
        ]);
        
    });
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'UserController@getAuthenticatedUser');
       
        Route::group(['prefix'=>'categories'], function(){
            Route::post('/create', [
                'uses'=>'CategoriesController@create'
            ]);
            Route::post('/update/', [
                'uses'=>'CategoriesController@update'
            ]);
            Route::get('/delete/{id}', [
                'uses'=>'CategoriesController@delete'
            ]);
           
        });
        Route::group(['prefix'=>'articles'], function(){
            Route::post('/create', [
                'uses'=>'ArticlesController@create'
            ]);
            Route::post('/update', [
                'uses'=>'ArticlesController@update'
            ]);
            Route::get('/delete/{id}', [
                'uses'=>'ArticlesController@delete'
            ]);
           
        });
    });
