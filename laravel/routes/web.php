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

Route::get('/students/dashboard', function () {
    return view('students.dashboard');
});

Route::get('/students/profile', function () {
    return view('students.profile');
});

Route::get('/students/club_list', function () {
    return view('students.club_list');
});

Route::get('/students/club_details', function () {
    return view('students.club_details');
});

Route::get('/students/club_resources', function () {
    return view('students.club_resources');
});

Route::get('/students/votes', function () {
    return view('students.votes');
});

Route::get('/students/vote_detail', function () {
    return view('students.vote_detail');
});

Route::get('/students/club_events', function () {
    return view('students.club_events');
});

Route::get('/students/forums', function () {
    return view('students.forums');
});

Route::get('/students/forum_detail', function () {
    return view('students.forum_detail');
});

Route::get('/students/notifications', function () {
    return view('students.notifications');
});
