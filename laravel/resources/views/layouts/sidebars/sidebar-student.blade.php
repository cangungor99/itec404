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
        <a href="{{ route('students.events.index') }}">
            <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
            <div class="menu-title">Club Events</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.votes.index') }}">
            <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i></div>
            <div class="menu-title">Voting</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.forums.index') }}">
            <div class="parent-icon"><i class="bi bi-chat-text-fill"></i></div>
            <div class="menu-title">Forums</div>
        </a>
    </li>


</ul>

