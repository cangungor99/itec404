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
        <a href="{{ route('manager.resources.index') }}">
            <div class="parent-icon"><i class="bi bi-folder"></i></div>
            <div class="menu-title">Resources</div>
        </a>
    </li>

    <li>
        <a href="{{ route('manager.budget.index') }}">
            <div class="parent-icon"><i class="bi bi-cash"></i></div>
            <div class="menu-title">Budget</div>
        </a>
    </li>
</ul>
