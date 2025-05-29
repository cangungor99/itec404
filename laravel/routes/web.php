<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController as NotificiationViewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Student\ClubController as StudentClubController;
use App\Http\Controllers\Student\ClubResourceController as StudentClubResourceController;
use App\Http\Controllers\Student\StudentVoteController;
use App\Http\Controllers\Student\StudentForumController;
use App\Http\Controllers\Student\StudentEventController;
use App\Http\Controllers\Leader\ClubResourceController as LeaderClubResourceController;
use App\Http\Controllers\Leader\MembershipController;
use App\Http\Controllers\Leader\LeaderVoteController;
use App\Http\Controllers\Leader\ForumApprovalController;
use App\Http\Controllers\Leader\CommentApprovalController;
use App\Http\Controllers\Leader\LeaderForumController;
use App\Http\Controllers\Leader\LeaderEventController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\ClubBudgetController;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/test', function () {
    return view('test');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chat/club/{club}', [ChatController::class, 'indexClub'])->name('chat.club');
    Route::post('/chat/club/{club}', [ChatController::class, 'storeClub'])->name('chat.club.send');

    Route::get('/chat/private/{user}', [ChatController::class, 'indexPrivate'])->name('chat.private');
    Route::post('/chat/private/{user}', [ChatController::class, 'storePrivate'])->name('chat.private.send');

    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::get('/chat/inbox', [ChatController::class, 'inbox'])->name('chat.inbox');
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
        Route::get('/events', [StudentEventController::class, 'index'])->name('events.index');
        Route::post('/events/{event}/join', [StudentEventController::class, 'join'])->name('events.join');
        Route::post('/events/{event}/leave', [StudentEventController::class, 'leave'])->name('events.leave');
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

        Route::get('{club}/events', [LeaderEventController::class, 'index'])->name('events.index');
        Route::get('{club}/events/create', [LeaderEventController::class, 'create'])->name('events.create');
        Route::post('{club}/events', [LeaderEventController::class, 'store'])->name('events.store');
        Route::get('{club}/events/{event}/edit', [LeaderEventController::class, 'edit'])->name('events.edit');
        Route::put('{club}/events/{event}', [LeaderEventController::class, 'update'])->name('events.update');
        Route::delete('{club}/events/{event}', [LeaderEventController::class, 'destroy'])->name('events.destroy');

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



        Route::get('/manage_votes', [App\Http\Controllers\Admin\VoteController::class, 'index'])->name('manage_votes');



        // Voting işlemleri

        Route::get('/create_vote', [App\Http\Controllers\Admin\VoteController::class, 'create'])->name('create_vote');
        Route::post('/create_vote', [App\Http\Controllers\Admin\VoteController::class, 'store'])->name('store_vote');
        Route::get('/create_vote', [App\Http\Controllers\Admin\VoteController::class, 'create'])->name('create_vote');
        Route::delete('/admin/votings/{id}', [App\Http\Controllers\Admin\VoteController::class, 'destroy'])->name('votings.destroy');




        Route::get('/manage_forums', [ForumController::class, 'index'])->name('manage_forums');
        Route::post('/forums/approve/{id}', [ForumController::class, 'approve'])->name('forums.approve');
        Route::post('/forums/reject/{id}', [ForumController::class, 'reject'])->name('forums.reject');

        Route::get('/budgets', [ClubBudgetController::class, 'index'])->name('budgets.index');
        Route::put('/budgets/{club}', [ClubBudgetController::class, 'update'])->name('budgets.update');

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
