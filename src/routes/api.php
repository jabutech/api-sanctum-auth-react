<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function(){
    // Register
    Route::post('register', 'RegisterController');
    // Login
    Route::post('login', 'LoginController');
});


Route::middleware('auth:sanctum')->group(function(){
    // Get user data
    Route::get('me', 'Auth\MeController');
    // Logout
    Route::post('logout', 'Auth\LogoutController');
});