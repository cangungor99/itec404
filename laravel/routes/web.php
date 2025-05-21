<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function () {
    return view('test');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Student Routes

Route::middleware(['auth', 'role:student,leader'])
    ->prefix('students')
    ->name('students.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('students.dashboard');
        })->name('dashboard');

        Route::get('/club_list', function () {
            return view('students.club_list');
        })->name('club_list');

        Route::get('/club_details', function () {
            return view('students.club_details');
        })->name('club_details');

        Route::get('/club_resources', function () {
            return view('students.club_resources');
        })->name('club_resources');

        Route::get('/votes', function () {
            return view('students.votes');
        })->name('votes');

        Route::get('/vote_detail', function () {
            return view('students.vote_detail');
        })->name('vote_detail');

        Route::get('/club_events', function () {
            return view('students.club_events');
        })->name('club_events');

        Route::get('/forums', function () {
            return view('students.forums');
        })->name('forums');

        Route::get('/forum_detail', function () {
            return view('students.forum_detail');
        })->name('forum_detail');

        Route::get('/notifications', function () {
            return view('students.notifications');
        })->name('notifications');
    });


// Leader routes

Route::middleware(['auth', 'role:leader'])
    ->prefix('leader')
    ->name('leader.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('students.leader.dashboard');
        })->name('dashboard');

        Route::get('/change_club_detail', function () {
            return view('students.leader.change_club_detail');
        })->name('change_club_detail');

        Route::get('/create_event', function () {
            return view('students.leader.create_event');
        })->name('create_event');

        Route::get('/create_notification', function () {
            return view('students.leader.create_notification');
        })->name('create_notification');

        Route::get('/create_vote', function () {
            return view('students.leader.create_vote');
        })->name('create_vote');

        Route::get('/manage_budget', function () {
            return view('students.leader.manage_budget');
        })->name('manage_budget');

        Route::get('/manage_events', function () {
            return view('students.leader.manage_events');
        })->name('manage_events');

        Route::get('/manage_forums', function () {
            return view('students.leader.manage_forums');
        })->name('manage_forums');

        Route::get('/manage_members', function () {
            return view('students.leader.manage_members');
        })->name('manage_members');

        Route::get('/manage_resources', function () {
            return view('students.leader.manage_resources');
        })->name('manage_resources');

        Route::get('/manage_votes', function () {
            return view('students.leader.manage_votes');
        })->name('manage_votes');
    });


// Admin routes

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/user_list', function () {
            return view('admin.user_list');
        })->name('user_list');

        Route::get('/manage_clubs', function () {
            return view('admin.manage_clubs');
        })->name('manage_clubs');

        Route::get('/create_club', function () {
            return view('admin.create_club');
        })->name('create_club');

        Route::get('/manage_votes', function () {
            return view('admin.manage_votes');
        })->name('manage_votes');

        Route::get('/create_vote', function () {
            return view('admin.create_vote');
        })->name('create_vote');

        Route::get('/manage_forums', function () {
            return view('admin.manage_forums');
        })->name('manage_forums');

        Route::get('/notification_list', function () {
            return view('admin.notification_list');
        })->name('notification_list');

        Route::get('/resources', function () {
            return view('admin.resources');
        })->name('resources');

        Route::get('/manage_budget', function () {
            return view('admin.manage_budget');
        })->name('manage_budget');
    });


Route::get('/sensitive', function () {
    return 'Hassas işlem';
})->middleware(['auth', 'password.confirm']);

Route::middleware(['auth'])
    ->get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');



require __DIR__.'/auth.php';
