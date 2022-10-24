<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;



/* Cart Routes */

Route::get('/auth/auto_login', function(){
    if(Auth::check()){
        return true;
    } else {
        return false;
    }
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
