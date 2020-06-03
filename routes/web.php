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

use App\Http\Controllers\RealestateController;
use Illuminate\Support\Facades\App;

Route::get('/set_language/{lang}', 'Controller@setLanguage')->name('set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handlerProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'realestates'], function() {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/subscribed', 'RealestateController@subscribed')
        ->name('realestates.subscribed');
        Route::get('/{estate}/inscribe', 'RealestateController@inscribe')
            ->name('realestates.inscribe');
        Route::post('/add_review', 'RealestateController@addReview')
            ->name('realestates.add_review');


        Route::group(['middleware' => [sprintf('role:%s', \App\Role::AGENT)]], function() {
            Route::get('/create', 'RealestateController@create')
                ->name('realestates.create');
            Route::post('/store', 'RealestateController@store')
                ->name('realestates.store');
            Route::put('/{estate}/update', 'RealestateController@update')
                ->name('realestates.update');
        
            Route::get('/{slug}/edit', 'RealestateController@edit')
                ->name('realestates.edit');
            Route::put('/{estate}/update', 'RealestateController@update')
                ->name('realestates.update');
            Route::delete('/{estate}/destroy', 'RealestateController@destroy')
                ->name('realestates.destroy');
        });
    });
    
    Route::get('/{estate}', 'RealestateController@show')->name('realestates.detail');
});

Route::group(["prefix" => "profile", "middleware" => ["auth"]], function() {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::put('/', 'ProfileController@update')->name('profile.update');
    Route::post('/', 'ProfileController@update_picture')->name('profile.update_picture');
});

Route::group(["prefix" => "agent", "middleware" => ["auth"]], function() {
    Route::get('/realestates', 'AgentController@estates')->name('agent.estates');
    Route::get('/clients', 'AgentController@clients')->name('agent.clients');
    Route::post('/send_message_to_client', 'AgentController@sendMessageToClient')->name('agent.send_message_to_client');
});

Route::group(["prefix" => "client", "middleware" => ["auth"]], function() {
    Route::get('/realestates', 'ClientController@estates')->name('clients.estates');
});

Route::group(["prefix" => "admin", "middleware" => ['auth', sprintf("role: %s", \App\Role::ADMIN)]], function() {
    Route::get('/realestates', 'AdminController@realestates')->name('admin.realestates');
    Route::get('/realestates_json', 'AdminController@realestatesJson')->name('admin.realestates_json');
    Route::post('/realestates/updateStatus', 'AdminController@updateRealestatesStatus');

    Route::get('/agents', 'AdminController@agents')->name('admin.agents');
    Route::get('/agents_json', 'AdminController@agentsJson')->name('admin.agents_json');
    Route::get('/clients', 'AdminController@clients')->name('admin.clients');
    Route::get('/clients_json', 'AdminController@clientsJson')->name('admin.clients_json');
});
