{{-- resources/views/layouts/sidebars/sidebar-leader.blade.php --}}

<div class="sidebar-header">
    <div><img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon"></div>
    <div>
        <h4 class="logo-text">Onedash (Leader)</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
</div>

<ul class="metismenu" id="menu">
    {{-- LİDER ALANI --}}
    <li class="menu-label">Leader Area</li>

    <li>
        <a href="{{ route('leader.dashboard') }}">
            <div class="parent-icon"><i class="bi bi-speedometer2"></i></div>
            <div class="menu-title">Leader Dashboard</div>
        </a>
    </li>

    <li>
        <a href="{{ route('leader.memberships.index') }}">
            <div class="parent-icon"><i class="bi bi-person-check"></i></div>
            <div class="menu-title">Membership Approvals</div>
        </a>
    </li>

    <li>
        <a href="{{ route('leader.members.index', optional(\App\Models\Club::where('leaderID', auth()->id())->first())->clubID) }}">
            <div class="parent-icon"><i class="bi bi-person"></i></div>
            <div class="menu-title">Members</div>
        </a>
    </li>

    <li>
        <a href="{{ route('leader.resources.my') }}">
            <div class="parent-icon"><i class="bi bi-folder-fill"></i></div>
            <div class="menu-title">Manage Resources</div>
        </a>
    </li>

    <li>
        <a href="{{ route('leader.votes.my') }}">
            <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i></div>
            <div class="menu-title">Manage Votes</div>
        </a>
    </li>

    <li>
        <a href="{{ route('leader.events.my') }}">
            <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
            <div class="menu-title">Manage Events</div>
        </a>
    </li>


    <li>
        <a href="{{ route('leader.forums.manage') }}">
            <div class="parent-icon"><i class="bi bi-layout-text-sidebar-reverse"></i></div>
            <div class="menu-title">Manage Forums & Comments</div>
        </a>
    </li>

    {{-- ÖĞRENCİ ALANI --}}
    <li class="menu-label">Student Area</li>

    <li>
        <a href="{{ route('students.dashboard') }}">
            <div class="parent-icon"><i class="bi bi-house-door"></i></div>
            <div class="menu-title">Student Dashboard</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.clubs.index') }}">
            <div class="parent-icon"><i class="bi bi-people"></i></div>
            <div class="menu-title">Clubs</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.events.index') }}">
            <div class="parent-icon"><i class="bi bi-calendar"></i></div>
            <div class="menu-title">My Events</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.votes.index') }}">
            <div class="parent-icon"><i class="bi bi-bar-chart"></i></div>
            <div class="menu-title">Voting</div>
        </a>
    </li>

    <li>
        <a href="{{ route('students.forums.index') }}">
            <div class="parent-icon"><i class="bi bi-chat"></i></div>
            <div class="menu-title">Forums</div>
        </a>
    </li>
</ul>
