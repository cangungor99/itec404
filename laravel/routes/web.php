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
use App\Http\Controllers\Leader\LeaderForumController;
use App\Http\Controllers\Leader\LeaderEventController;
use App\Http\Controllers\Leader\ClubMemberController;
use App\Http\Controllers\Leader\LeaderNotificationController;
use App\Http\Controllers\Manager\ManagerClubController;
use App\Http\Controllers\Manager\BudgetController;
use App\Http\Controllers\Manager\ManagerReportController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\ClubBudgetController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Leader\LeaderDashboardController;
use App\Http\Controllers\Admin\ViewReportController;
use App\Http\Controllers\Admin\GraphicalReportController;
use App\Http\Controllers\Admin\ResourceController;



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
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'storePrivateMessage'])->name('chat.send');
    Route::post('/chat/mark-as-read/{userID}', [ChatController::class, 'markPrivateAsRead']);
    Route::post('/chat/club/mark-as-read/{clubID}', [ChatController::class, 'markClubAsRead']);

    Route::get('/chat/user-search', [ChatController::class, 'searchUser'])->name('chat.userSearch');
    Route::get('/chat/recent-chats', [ChatController::class, 'recentMessages'])->name('chat.recent');

    Route::get('/chat/club/{club}', [ChatController::class, 'indexClub'])->name('chat.club');
    Route::post('/chat/club/{club}', [ChatController::class, 'storeClub'])->name('chat.club.send');
});






// Student Routes

Route::middleware(['auth', 'role:student,leader'])
    ->prefix('students')
    ->name('students.')
    ->group(function () {


        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');


        Route::get('/clubs', [StudentClubController::class, 'index'])->name('clubs.index');
        Route::get('/club/{club}', [StudentClubController::class, 'show'])->name('clubs.show');
        Route::post('/club/{club}/apply', [StudentClubController::class, 'apply'])->name('clubs.apply');
        Route::post('/club/{club}/leave', [StudentClubController::class, 'leave'])->name('clubs.leave');
        Route::get('/resources', [StudentClubResourceController::class, 'index'])->name('resources.index');
        Route::get('/resources/search', [StudentClubResourceController::class, 'search'])->name('resources.search');
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
        Route::get('/dashboard', [LeaderDashboardController::class, 'index'])->name('dashboard');


        Route::get('/my-resources', function () {
            $leader = auth()->user();
            $club = \App\Models\Club::where('leaderID', $leader->userID)->firstOrFail();
            return redirect()->route('leader.resources', $club->clubID);
        })->name('resources.my');

        Route::get('/my-votes', function () {
            $leader = auth()->user();
            $club = \App\Models\Club::where('leaderID', $leader->userID)->firstOrFail();
            return redirect()->route('leader.votes.index', $club->clubID);
        })->name('votes.my');

        Route::get('/my-events', function () {
            $leader = auth()->user();
            $club = \App\Models\Club::where('leaderID', $leader->userID)->firstOrFail();
            return redirect()->route('leader.events.index', $club->clubID);
        })->name('events.my');

        Route::get('/leader/test-event-redirect', function () {
            $leader = auth()->user();
            $club = \App\Models\Club::where('leaderID', $leader->userID)->first();
            dd($club);
        });

        Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
        Route::post('/memberships/{id}/approve', [MembershipController::class, 'approve'])->name('memberships.approve');
        Route::post('/memberships/{id}/reject', [MembershipController::class, 'reject'])->name('memberships.reject');
        Route::get('{club}/resources', [LeaderClubResourceController::class, 'index'])->name('resources.index');
        Route::post('{club}/resources', [LeaderClubResourceController::class, 'store'])->name('resources.store');
        Route::delete('{club}/resources/{resource}', [LeaderClubResourceController::class, 'destroy'])->name('resources.destroy');
        Route::get('{club}/votes', [LeaderVoteController::class, 'index'])->name('votes.index');
        Route::get('{club}/votes/create', [LeaderVoteController::class, 'create'])->name('votes.create');
        Route::post('{club}/votes', [LeaderVoteController::class, 'store'])->name('votes.store');
        Route::delete('{club}/votes/{voting}', [LeaderVoteController::class, 'destroy'])->name('votes.destroy');
        Route::get('{club}/votes/{voting}/edit', [LeaderVoteController::class, 'edit'])->name('votes.edit');
        Route::put('{club}/votes/{voting}', [LeaderVoteController::class, 'update'])->name('votes.update');
        Route::get('{club}/votes/{voting}/results', [LeaderVoteController::class, 'results'])->name('votes.results');
        Route::get('/forums/manage', [LeaderForumController::class, 'manage'])->name('forums.manage');
        Route::post('/forums/{forum}/approve', [LeaderForumController::class, 'approve'])->name('forums.approve');
        Route::post('/forums/{forum}/reject', [LeaderForumController::class, 'reject'])->name('forums.reject');
        Route::post('/comments/{comment}/approve', [LeaderForumController::class, 'approveComment'])->name('comments.approve');
        Route::post('/comments/{comment}/reject', [LeaderForumController::class, 'rejectComment'])->name('comments.reject');
        Route::get('/forums/approved', [LeaderForumController::class, 'published'])->name('forums.approved');
        Route::get('/forums/{forum}', [LeaderForumController::class, 'show'])->name('forums.show');
        Route::delete('/forums/{forum}', [LeaderForumController::class, 'destroy'])->name('forums.destroy');
        Route::post('/forums/{forum}/comment', [LeaderForumController::class, 'comment'])->name('forums.comment');


        Route::get('{club}/events', [LeaderEventController::class, 'index'])->name('events.index');
        Route::get('{club}/events/create', [LeaderEventController::class, 'create'])->name('events.create');
        Route::post('{club}/events', [LeaderEventController::class, 'store'])->name('events.store');
        Route::get('{club}/events/{event}/edit', [LeaderEventController::class, 'edit'])->name('events.edit');
        Route::put('{club}/events/{event}', [LeaderEventController::class, 'update'])->name('events.update');
        Route::delete('{club}/events/{event}', [LeaderEventController::class, 'destroy'])->name('events.destroy');
        Route::get('{club}/members', [ClubMemberController::class, 'index'])->name('members.index');
        Route::delete('{club}/members/{membership}', [ClubMemberController::class, 'destroy'])->name('members.destroy');




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


Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('manager.dashboard');
        })->name('dashboard');




        Route::get('/club', [ManagerClubController::class, 'show'])->name('club.show');
        Route::get('/club/edit', [ManagerClubController::class, 'edit'])->name('club.edit');
        Route::post('/club/update', [ManagerClubController::class, 'update'])->name('club.update');


        Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
        Route::post('/budget/update', [BudgetController::class, 'update'])->name('budget.update');

        Route::get('club/{club}/members', [ClubMemberController::class, 'index'])->name('members');
        Route::delete('club/{club}/members/{membership}', [ClubMemberController::class, 'destroy'])->name('members.destroy');
        Route::post('club/{club}/set-leader/{userID}', [ClubMemberController::class, 'setLeader'])->name('club.set_leader');
        Route::get('{club:clubID}/resources', [LeaderClubResourceController::class, 'index'])->name('resources.index');
        Route::post('{club:clubID}/resources', [LeaderClubResourceController::class, 'store'])->name('resources.store');
        Route::delete('{club:clubID}/resources/{resource}', [LeaderClubResourceController::class, 'destroy'])->name('resources.destroy');
        Route::get('{club:clubID}/events', [LeaderEventController::class, 'index'])->name('events.index');
        Route::get('{club:clubID}/events/create', [LeaderEventController::class, 'create'])->name('events.create');
        Route::post('{club:clubID}/events', [LeaderEventController::class, 'store'])->name('events.store');
        Route::get('{club:clubID}/events/{event}/edit', [LeaderEventController::class, 'edit'])->name('events.edit');
        Route::put('{club:clubID}/events/{event}', [LeaderEventController::class, 'update'])->name('events.update');
        Route::delete('{club:clubID}/events/{event}', [LeaderEventController::class, 'destroy'])->name('events.destroy');
        Route::get('{club:clubID}/votes', [LeaderVoteController::class, 'index'])->name('votes.index');
        Route::get('{club:clubID}/votes/create', [LeaderVoteController::class, 'create'])->name('votes.create');
        Route::post('{club}/votes', [LeaderVoteController::class, 'store'])->name('votes.store');
        Route::get('{club}/votes/{voting}/edit', [LeaderVoteController::class, 'edit'])->name('votes.edit');
        Route::put('{club}/votes/{voting}', [LeaderVoteController::class, 'update'])->name('votes.update');
        Route::delete('{club}/votes/{voting}', [LeaderVoteController::class, 'destroy'])->name('votes.destroy');
        Route::get('{club}/votes/{voting}/results', [LeaderVoteController::class, 'results'])->name('votes.results');
        Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
        Route::post('/memberships/{id}/approve', [MembershipController::class, 'approve'])->name('memberships.approve');
        Route::post('/memberships/{id}/reject', [MembershipController::class, 'reject'])->name('memberships.reject');
        Route::get('/forums/manage', [LeaderForumController::class, 'manage'])->name('forums.manage');
        Route::post('/forums/{forum}/approve', [LeaderForumController::class, 'approve'])->name('forums.approve');
        Route::post('/forums/{forum}/reject', [LeaderForumController::class, 'reject'])->name('forums.reject');
        Route::post('/comments/{comment}/approve', [LeaderForumController::class, 'approveComment'])->name('comments.approve');
        Route::post('/comments/{comment}/reject', [LeaderForumController::class, 'rejectComment'])->name('comments.reject');
        Route::get('/forums/approved', [LeaderForumController::class, 'published'])->name('forums.approved');
        Route::get('/forums/{forum}', [LeaderForumController::class, 'show'])->name('forums.show');
        Route::delete('/forums/{forum}', [LeaderForumController::class, 'destroy'])->name('forums.destroy');
        Route::post('/forums/{forum}/comment', [LeaderForumController::class, 'comment'])->name('forums.comment');
        Route::get('/reports/general', [ManagerReportController::class, 'general'])->name('reports.general');
        Route::get('/reports/graphical', [ManagerReportController::class, 'graphical'])->name('reports.graphical');
    });


Route::middleware(['auth', 'role:leader,manager'])
    ->prefix('{role}/notifications')
    ->name('notifications.')
    ->group(function () {
        Route::get('/create', [LeaderNotificationController::class, 'create'])->name('create');
        Route::post('/store', [LeaderNotificationController::class, 'store'])->name('store');

    });


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Clubs
        Route::post('/clubs/create', [ClubController::class, 'store'])->name('clubs.store');
        Route::get('/create_club', function () {
            return view('admin.create_club');
        })->name('create_club');
        Route::get('/manage_clubs', [App\Http\Controllers\Admin\ClubController::class, 'index'])->name('manage_clubs');

        Route::get('/clubs/edit/{id}', [ClubController::class, 'edit'])->name('clubs.edit');
        Route::put('/clubs/update/{id}', [ClubController::class, 'update'])->name('clubs.update');
        Route::delete('/clubs/delete/{id}', [ClubController::class, 'destroy'])->name('clubs.destroy');

        Route::get('/resources/manage', function () {
            return view('admin.manage_resources');
        })->name('resources.manage');
        
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
        Route::put('/user_list/update/{id}', [UserController::class, 'update'])->name('users.update');

        //view report
        Route::get('/view_report', [ViewReportController::class, 'index'])->name('view_report');
        Route::get('/reports/graphical', [GraphicalReportController::class, 'index'])->name('reports.graphical');
        Route::get('/reports/general', [App\Http\Controllers\Admin\GeneralReportController::class, 'index'])->name('reports.general');


        Route::get('/manage_votes', [App\Http\Controllers\Admin\VoteController::class, 'index'])->name('manage_votes');



        // Voting işlemleri

        Route::get('/create_vote', [App\Http\Controllers\Admin\VoteController::class, 'create'])->name('create_vote');
        Route::post('/create_vote', [App\Http\Controllers\Admin\VoteController::class, 'store'])->name('store_vote');
        Route::delete('/admin/votings/{id}', [App\Http\Controllers\Admin\VoteController::class, 'destroy'])->name('votings.destroy');
        Route::put('/votings/{id}', [App\Http\Controllers\Admin\VoteController::class, 'update'])->name('votings.update');
        Route::get('/votings/{id}/results', [App\Http\Controllers\Admin\VoteController::class, 'results'])->name('votings.results');





        Route::get('/manage_forums', [ForumController::class, 'index'])->name('manage_forums');
        Route::post('/forums/approve/{id}', [ForumController::class, 'approve'])->name('forums.approve');
        Route::post('/forums/reject/{id}', [ForumController::class, 'reject'])->name('forums.reject');

        Route::get('/budgets', [ClubBudgetController::class, 'index'])->name('budgets.index');
        Route::put('/budgets/{club}', [ClubBudgetController::class, 'update'])->name('budgets.update');

        Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
        Route::delete('/resources/{id}', [ResourceController::class, 'destroy'])->name('resources.destroy');
    });



Route::get('/sensitive', function () {
    return 'Sensitive Case';
})->middleware(['auth', 'password.confirm']);

Route::middleware(['auth'])
    ->get('/notifications', [NotificiationViewController::class, 'index'])
    ->name('notifications.index');
Route::middleware(['auth'])->post('/notifications/read/{id}', [NotificiationViewController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::middleware(['auth'])->post('/notifications/navbar/read/{notificationID}', [NotificationController::class, 'markAsReadFromNavbar'])->name('notifications.markAsReadFromNavbar');


require __DIR__ . '/auth.php';
