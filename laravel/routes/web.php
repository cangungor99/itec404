<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/students/signup', function () {
    return view('students.signup');
});
