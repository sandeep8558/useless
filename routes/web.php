<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WebsiteController::class, 'welcome']);

Route::get('/notify/{title}/{msg}', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->middleware("administrator");

Auth::routes(['register' => false]);

/* Framework Routes */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/crud', 'App\Http\Controllers\CrudController');


/* Auth Routes */
Route::group(['middleware'=>['auth']], function(){
});

/* Administrator Routes */
Route::group(['middleware'=>['auth', 'administrator']], function(){
});