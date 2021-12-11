<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/plans', 'App\Http\Controllers\PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'App\Http\Controllers\PlanController@show')->name('plans.show');
    Route::post('/subscription', 'App\Http\Controllers\SubscriptionController@create')->name('subscription.create');

    //Routes for create Plan
    Route::get('create/plan', 'App\Http\Controllers\SubscriptionController@createPlan')->name('create.plan');
    Route::post('store/plan', 'App\Http\Controllers\SubscriptionController@storePlan')->name('store.plan');
});
Route::get('/dashboard', function () {
    return view('stats.index');
})->middleware('subscribed');
Route::get('/pricing', function () {
    return view('stats.pricing');
})->name('pricing');
