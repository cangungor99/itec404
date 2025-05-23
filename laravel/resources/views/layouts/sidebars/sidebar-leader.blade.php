{{-- resources/views/layouts/sidebars/sidebar-leader.blade.php --}}

<div class="sidebar-header">
    <div><img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon"></div>
    <div>
        <h4 class="logo-text">Onedash (Leader)</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
</div>

<ul class="metismenu" id="menu">
    <li class="menu-label">Leader Pages</li>
    <li>
        <a href="{{ route('leader.dashboard') }}">
            <div class="parent-icon"><i class="bi bi-speedometer2"></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.memberships.index') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Membership Requests</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.my_resources') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Resources</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.forums.pending') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Pending Forums</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.comments.pending') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Pending Comments</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.create_event') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Create Event</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.create_notification') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Create Notification</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.create_vote') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Create Vote</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.manage_budget') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Budget</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.manage_events') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Events</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.manage_forums') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Forums</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.manage_members') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Members</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.manage_resources') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Resources</div>
        </a>
    </li>
    <li>
        <a href="{{ route('leader.votes.my') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Manage Votes</div>
        </a>
    </li>
    <li class="menu-label">Student Pages</li>
    <li>
        <a href="{{ route('students.dashboard') }}">
            <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
            <div class="menu-title">Student Dashboard</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.clubs.index') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Club List</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.vote_detail') }}">
            <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
            <div class="menu-title">Student Vote Details</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.club_events') }}">
            <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
            <div class="menu-title">Student Club Events</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.forums.index') }}">
            <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
            <div class="menu-title">Student Forums</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.forum_detail') }}">
            <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
            <div class="menu-title">Student Forum Details</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.notifications') }}">
            <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
            <div class="menu-title">Student Notifications</div>
        </a>
    </li>

</ul>
