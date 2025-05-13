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

// Student Routes

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


// Leader routes

Route::get('/students/leader/dashboard', function () {
    return view('students.leader.dashboard');
});

Route::get('/students/leader/change_club_detail', function () {
    return view('students.leader.change_club_detail');
});

Route::get('/students/leader/manage_events', function () {
    return view('students.leader.manage_events');
});

Route::get('/students/leader/create_event', function () {
    return view('students.leader.create_event');
});

Route::get('/students/leader/manage_votes', function () {
    return view('students.leader.manage_votes');
});

Route::get('/students/leader/create_vote', function () {
    return view('students.leader.create_vote');
});

Route::get('/students/leader/manage_budget', function () {
    return view('students.leader.manage_budget');
});

Route::get('/students/leader/manage_forums', function () {
    return view('students.leader.manage_forums');
});

Route::get('/students/leader/manage_members', function () {
    return view('students.leader.manage_members');
});

Route::get('/students/leader/create_notification', function () {
    return view('students.leader.create_notification');
});

Route::get('/students/leader/manage_resources', function () {
    return view('students.leader.manage_resources');
});


// Admin routes


Route::get('/admin/user_list', function () {
    return view('admin.user_list');
});

Route::get('/admin/manage_clubs', function () {
    return view('admin.manage_clubs');
});

Route::get('/admin/create_club', function () {
    return view('admin.create_club');
});

Route::get('/admin/manage_votes', function () {
    return view('admin.manage_votes');
});
Route::get('/admin/create_vote', function () {
    return view('admin.create_vote');
});

Route::get('/admin/manage_forums', function () {
    return view('admin.manage_forums');
});

Route::get('/admin/notification_list', function () {
    return view('admin.notification_list');
});
Route::get('/admin/resources', function () {
    return view('admin.resources');
});

Route::get('/admin/manage_budget', function () {
    return view('admin.manage_budget');
});
