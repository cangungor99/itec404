<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController as NotificiationViewController;
use App\Http\Controllers\Student\ClubController as StudentClubController;
use App\Http\Controllers\Student\ClubResourceController as StudentClubResourceController;
use App\Http\Controllers\Student\StudentVoteController;
use App\Http\Controllers\Student\StudentForumController;
use App\Http\Controllers\Leader\ClubResourceController as LeaderClubResourceController;
use App\Http\Controllers\Leader\MembershipController;
use App\Http\Controllers\Leader\LeaderVoteController;
use App\Http\Controllers\Leader\ForumApprovalController;
use App\Http\Controllers\Leader\CommentApprovalController;
use App\Http\Controllers\Leader\LeaderForumController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\UserController;

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

        Route::get('/clubs', [StudentClubController::class, 'index'])->name('clubs.index');
        Route::get('/club/{club}', [StudentClubController::class, 'show'])->name('clubs.show');
        Route::post('/club/{club}/apply', [StudentClubController::class, 'apply'])->name('clubs.apply');
        Route::post('/club/{club}/leave', [StudentClubController::class, 'leave'])->name('clubs.leave');
        Route::get('/clubs/{club}/resources', [StudentClubResourceController::class, 'index'])->name('clubs.resources');
        Route::post('/clubs/{club}/resources', [StudentClubResourceController::class, 'store'])->name('clubs.resources.store');
        Route::delete('/clubs/{club}/resources/{resource}', [StudentClubResourceController::class, 'destroy'])->name('clubs.resources.destroy');
        Route::get('/votes', [StudentVoteController::class, 'index'])->name('votes.index');
        Route::get('/votes/{voting}', [StudentVoteController::class, 'show'])->name('votes.show');
        Route::post('/votes/{voting}', [StudentVoteController::class, 'vote'])->name('votes.vote');
        Route::get('/forums', [StudentForumController::class, 'index'])->name('forums.index');
        Route::get('/forums/create', [StudentForumController::class, 'create'])->name('forums.create');
        Route::post('/forums', [StudentForumController::class, 'store'])->name('forums.store');
        Route::get('/forums/{forum}', [StudentForumController::class, 'show'])->name('forums.show');
        Route::post('/forums/{forum}/comments', [StudentForumController::class, 'comment'])->name('forums.comment');





        Route::get('/vote_detail', function () {
            return view('students.vote_detail');
        })->name('vote_detail');

        Route::get('/club_events', function () {
            return view('students.club_events');
        })->name('club_events');



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

        Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
        Route::post('/memberships/{id}/approve', [MembershipController::class, 'approve'])->name('memberships.approve');
        Route::post('/memberships/{id}/reject', [MembershipController::class, 'reject'])->name('memberships.reject');
        Route::get('{club}/resources', [LeaderClubResourceController::class, 'index'])->name('resources');
        Route::post('{club}/resources', [LeaderClubResourceController::class, 'store'])->name('resources.store');
        Route::delete('{club}/resources/{resource}', [LeaderClubResourceController::class, 'destroy'])->name('resources.destroy');
        Route::get('{club}/votes', [LeaderVoteController::class, 'index'])->name('votes.index');
        Route::get('{club}/votes/create', [LeaderVoteController::class, 'create'])->name('votes.create');
        Route::post('{club}/votes', [LeaderVoteController::class, 'store'])->name('votes.store');
        Route::delete('{club}/votes/{voting}', [LeaderVoteController::class, 'destroy'])->name('votes.destroy');
        Route::get('{club}/votes/{voting}/edit', [LeaderVoteController::class, 'edit'])->name('votes.edit');
        Route::put('{club}/votes/{voting}', [LeaderVoteController::class, 'update'])->name('votes.update');
        Route::get('{club}/votes/{voting}/results', [LeaderVoteController::class, 'results'])->name('votes.results');
        Route::get('/forums/pending', [ForumApprovalController::class, 'index'])->name('forums.pending');
        Route::post('/forums/{forum}/approve', [ForumApprovalController::class, 'approve'])->name('forums.approve');
        Route::post('/forums/{forum}/reject', [ForumApprovalController::class, 'reject'])->name('forums.reject');

        Route::get('/comments/pending', [CommentApprovalController::class, 'index'])->name('comments.pending');
        Route::post('/comments/{comment}/approve', [CommentApprovalController::class, 'approve'])->name('comments.approve');
        Route::post('/comments/{comment}/reject', [CommentApprovalController::class, 'reject'])->name('comments.reject');
        Route::get('/forums/{forum}', [LeaderForumController::class, 'show'])->name('forums.show');

        Route::get('/resources', function () {
            $leader = auth()->user();
            $club = \App\Models\Club::where('leaderID', $leader->userID)->firstOrFail();

            return redirect()->route('leader.resources', $club->clubID);
        })->name('my_resources');

        Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');

        Route::get('/votes', function () {
            $leader = auth()->user();
            $club = \App\Models\Club::where('leaderID', $leader->userID)->firstOrFail();
            return redirect()->route('leader.votes.index', $club->clubID);
        })->name('votes.my');

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


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Clubs
        Route::post('/clubs/create', [ClubController::class, 'store'])->name('clubs.store');
        Route::get('/create_club', function () {
            return view('admin.create_club');
        })->name('create_club');
        Route::get('/manage_clubs', [App\Http\Controllers\Admin\ClubController::class, 'index'])->name('manage_clubs');

        Route::get('/clubs/edit/{id}', [ClubController::class, 'edit'])->name('clubs.edit');
        Route::put('/clubs/update/{id}', [ClubController::class, 'update'])->name('clubs.update');
        Route::delete('/clubs/delete/{id}', [ClubController::class, 'destroy'])->name('clubs.destroy');


        // Notifications
        Route::get('/notification_list', [NotificationController::class, 'index'])->name('notification_list');
        Route::get('/create_notification', [NotificationController::class, 'create'])->name('create_notification');
        Route::post('/notifications/create', [NotificationController::class, 'store'])->name('notifications.store');
        Route::get('/notifications/edit/{notificationID}', [NotificationController::class, 'edit'])->name('notifications.edit');
        Route::put('/notifications/update/{notificationID}', [NotificationController::class, 'update'])->name('notifications.update');
        Route::delete('/notifications/delete/{notificationID}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

        // User List
        Route::get('/user_list', [UserController::class, 'index'])->name('user_list');
        Route::delete('/user_list/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/users/update/{userID}', [UserController::class, 'update'])->name('users.update');



        Route::get('/manage_votes', function () {
            return view('admin.manage_votes');
        })->name('manage_votes');

        Route::get('/create_vote', function () {
            return view('admin.create_vote');
        })->name('create_vote');

        Route::get('/manage_forums', function () {
            return view('admin.manage_forums');
        })->name('manage_forums');

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
    ->get('/notifications', [NotificiationViewController::class, 'index'])
    ->name('notifications.index');



require __DIR__ . '/auth.php';
