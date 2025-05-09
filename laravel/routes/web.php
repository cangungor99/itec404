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

Route::get('/club/club_list', function () {
    return view('club.club_list');
});

Route::get('/club/club_details', function () {
    return view('club.club_details');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/club/club_resources', function () {
    return view('club.club_resources');
});

Route::get('/votes', function () {
    return view('votes');
});
