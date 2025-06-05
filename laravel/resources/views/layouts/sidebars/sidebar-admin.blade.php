<div class="sidebar-header">
  <div><img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon"></div>
  <div><h4 class="logo-text">CMS(Admin)</h4></div>
  <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
</div>

<ul class="metismenu" id="menu">
  <li>
    <a href="{{ route('admin.dashboard') }}">
      <div class="parent-icon"><i class="bi bi-speedometer2"></i></div>
      <div class="menu-title">Dashboard</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.user_list') }}">
      <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
      <div class="menu-title">User List</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.manage_clubs') }}">
      <div class="parent-icon"><i class="bi bi-diagram-3-fill"></i></div>
      <div class="menu-title">Manage Clubs</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.create_club') }}">
      <div class="parent-icon"><i class="bi bi-plus-square-fill"></i></div>
      <div class="menu-title">Create Club</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.manage_votes') }}">
      <div class="parent-icon"><i class="bi bi-check2-square"></i></div>
      <div class="menu-title">Manage Votes</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.create_vote') }}">
      <div class="parent-icon"><i class="bi bi-pencil-square"></i></div>
      <div class="menu-title">Create Vote</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.manage_forums') }}">
      <div class="parent-icon"><i class="bi bi-chat-dots-fill"></i></div>
      <div class="menu-title">Manage Forums</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.notification_list') }}">
      <div class="parent-icon"><i class="bi bi-bell-fill"></i></div>
      <div class="menu-title">Notification List</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.resources') }}">
      <div class="parent-icon"><i class="bi bi-folder-fill"></i></div>
      <div class="menu-title">Resources</div>
    </a>
  </li>
  <li>
    <a href="{{ route('admin.budgets.index') }}">
      <div class="parent-icon"><i class="bi bi-cash-coin"></i></div>
      <div class="menu-title">Manage Budget</div>
    </a>
  </li>
</ul>
