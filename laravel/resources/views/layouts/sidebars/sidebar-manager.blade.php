<div class="sidebar-header">
    <div><img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon"></div>
    <div>
        <h4 class="logo-text">Onedash (Manager)</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
</div>

<ul class="metismenu" id="menu">
    <li class="menu-label">Manager Panel</li>

    <li>
        <a href="{{ route('manager.dashboard') }}">
            <div class="parent-icon"><i class="bi bi-house"></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li>
        <a href="{{ route('manager.club.show') }}">
            <div class="parent-icon"><i class="bi bi-building"></i></div>
            <div class="menu-title">Club Info</div>
        </a>
    </li>

    <li>
        <a href="{{ route('manager.budget.index') }}">
            <div class="parent-icon"><i class="bi bi-cash"></i></div>
            <div class="menu-title">Budget</div>
        </a>
    </li>

    @php
    $club = \App\Models\Club::where('managerID', auth()->id())->first();
    @endphp

    @if($club)
    <li>
        <a href="{{ route('manager.resources.index', $club->clubID) }}">
            <div class="parent-icon"><i class="bi bi-folder"></i></div>
            <div class="menu-title">Resources</div>
        </a>
    </li>
    <li>
        <a href="{{ route('notifications.create', ['role' => 'manager']) }}">
            <div class="parent-icon"><i class="bi bi-bell"></i></div>
            <div class="menu-title">Notifications</div>
        </a>
    </li>
    <li>
        <a href="{{ route('manager.members', $club->clubID) }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">Club Members</div>
        </a>
    </li>
    <li>
        <a href="{{ route('manager.events.index', $club->clubID) }}">
            <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
            <div class="menu-title">Manage Events</div>
        </a>
    </li>
    <li>
        <a href="{{ route('manager.votes.index', $club->clubID) }}">
            <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i></div>
            <div class="menu-title">Manage Votes</div>
        </a>
    </li>
    <li>
        <a href="{{ route('manager.memberships.index') }}">
            <div class="parent-icon"><i class="bi bi-person-check"></i></div>
            <div class="menu-title">Membership Approvals</div>
        </a>
    </li>
    <li>
        <a href="{{ route('manager.forums.manage') }}">
            <div class="parent-icon"><i class="bi bi-chat-left-text"></i></div>
            <div class="menu-title">Forum Management</div>
        </a>
    </li>


    @endif

    <li>
        <a href="{{ route('chat.index') }}">
            <div class="parent-icon"><i class="bi bi-chat-square-fill"></i></div>
            <div class="menu-title">Chat</div>
        </a>
    </li>
</ul>
