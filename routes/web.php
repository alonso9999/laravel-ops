<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('', function () {
    return view('welcome');
})->middleware('auth');

Route::group(['prefix' => 'post'], function () {
    Route::get('gettype','PostController@gettype')->name('post.gettype');
    Route::get('getowner','PostController@getowner')->name('post.getowner');
    Route::get('addtype','PostController@addtype')->name('post.addtype');
    Route::get('addowner','PostController@addowner')->name('post.addowner');
    Route::get('edittype/{id}','PostController@edittype')->name('post.edittype');
    Route::get('editowner/{id}','PostController@editowner')->name('post.editowner'); 
    Route::post('typeupdate/{id}','PostController@typeupdate')->name('post.typeupdate');
    Route::post('ownerupdate/{id}','PostController@ownerupdate')->name('post.ownerupdate'); 
    Route::post('storetype','PostController@storetype')->name('post.storetype');
    Route::post('storeowner','PostController@storeowner')->name('post.storeowner');
    Route::post('search','PostController@search')->name('post.search');
    Route::get('destroy/{id}','PostController@destroy')->name('post.destroy');
});
Route::resource('post','PostController');


Route::group(['prefix' => 'file'], function () {
    Route::get('/','FileController@index')->name('file.index');
    Route::get('upload','FileController@upload')->name('file.upload');
    Route::post('/','FileController@store')->name('file.store');
    Route::post('search','FileController@search')->name('file.search');
    Route::get('destroy/{id}','FileController@destroy')->name('file.destroy');    
});

/*
Route::group(['prefix' => 'release'], function () {
    Route::get('/','ReleaseController@index')->name('release.index');
    Route::get('backup','ReleaseController@backup')->name('release.backup');
    Route::post('backup','ReleaseController@store')->name('release.store');    
    Route::get('checkver','ReleaseController@checkver')->name('release.checkver');     
});
*/

Route::group(['prefix' => 'ops'], function () {
    Route::get('/','OpsController@index')->name('ops.index');
    Route::get('addgroup','OpsController@addgroup')->name('ops.addgroup');
    Route::post('addgroup','OpsController@storegroup')->name('ops.storegroup');
    Route::get('delete/{id}','OpsController@deletegroup')->name('ops.deletegroup'); 
    Route::get('addhosts/{id}/{group}','OpsController@addhosts')->name('ops.addhosts');     
    Route::post('addhosts/{id}','OpsController@storehosts')->name('ops.storehosts'); 
    Route::get('show/deletehosts/{group_id}/{host_id}','OpsController@deletehosts')->name('ops.deletehosts'); 
    Route::get('backup/{id}','OpsController@backup')->name('ops.backup'); 
    Route::post('backup/{id}','OpsController@runbackup')->name('ops.runbackup'); 
    Route::get('release/{id}','OpsController@release')->name('ops.release'); 
    Route::post('release/{id}','OpsController@runrelease')->name('ops.runrelease');
    Route::get('run/{command}/{id}','OpsController@runcommand')->name('ops.runcommand');       
    Route::get('show/{id}','OpsController@showgroup')->name('ops.showgroup'); 
});

Route::group(['prefix' => 'analysis'], function () {
    Route::get('/','AnalysisController@index')->name('analysis.index');
    Route::get('upload','AnalysisController@upload')->name('analysis.upload');
    Route::post('/','AnalysisController@store')->name('analysis.store'); 
});

Auth::routes();

Route::get('/home', 'HomeController@index');
