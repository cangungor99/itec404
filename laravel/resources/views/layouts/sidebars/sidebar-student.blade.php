{{-- resources/views/layouts/sidebars/sidebar-student.blade.php --}}

<div class="sidebar-header">
    <div><img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon"></div>
    <div>
        <h4 class="logo-text">Onedash (Student)</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
</div>

<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('students.dashboard') }}">
            <div class="parent-icon"><i class="bi bi-person-fill"></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.clubs.index') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Club List</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.votes.index') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Votes</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.vote_detail') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Vote Details</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.club_events') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Club Events</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.forums.index') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Forums</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.forum_detail') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Forum Details</div>
        </a>
    </li>
    <li>
        <a href="{{ route('students.notifications') }}">
            <div class="parent-icon"><i class="bi bi-bell-fill"></i></div>
            <div class="menu-title">Notifications</div>
        </a>
    </li>
</ul>
