{{-- resources/views/layouts/navbar.blade.php --}}
<nav class="navbar navbar-expand gap-3">
    <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
        <i class="bi bi-list"></i>
    </div>



    <div class="top-navbar-right ms-auto">
        <ul class="navbar-nav align-items-center gap-1">
            {{-- mobil arama butonu --}}




            {{-- karanlık mod --}}
            <li class="nav-item dark-mode d-none d-sm-flex">
                <a class="nav-link dark-mode-icon" href="javascript:;">
                    <i class="bi bi-moon-fill"></i>
                </a>
            </li>



            {{-- mesajlar --}}
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    <div class="messages">
                        <span class="notify-badge">{{ $recentMessages->count() }}</span>
                        <i class="bi bi-chat-left-text-fill"></i>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="p-2 border-bottom m-2">
                        <h5 class="h5 mb-0">Gelen Mesajlar</h5>
                    </div>

                    <div class="header-notifications-list p-2" style="max-height: 300px; overflow-y: auto;">
                        @forelse($recentMessages as $message)
                        {{-- Eğer kulüp mesajıysa ve user o kulübe üye değilse gösterme --}}
                        @if (!$message->clubID || ($message->club && $message->club->memberships->contains('userID', auth()->id())))
                        <a class="dropdown-item" href="{{ $message->clubID
            ? route('chat.club', $message->clubID)
            : route('chat.private', $message->senderID == auth()->id()
                ? $message->receiverID
                : $message->senderID) }}">
                            <div class="d-flex align-items-center">
                                <div class="notification-box bg-light-info text-info">
                                    <i class="bi bi-chat-dots"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 dropdown-msg-user">
                                        {{ $message->clubID
    ? $message->club->name
    : ($message->senderID == auth()->id() ? $message->receiver->name : $message->sender->name) }}
                                        <span class="msg-time float-end text-secondary">
                                            {{ $message->created_at->diffForHumans() }}
                                        </span>
                                    </h6>
                                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">
                                        {{ \Illuminate\Support\Str::limit($message->message, 50) }}
                                    </small>
                                </div>
                            </div>
                        </a>
                        @endif
                        @empty
                        <p class="text-center text-secondary">Yeni mesaj yok</p>
                        @endforelse

                    </div>

                    <div class="p-2">
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-center" href="{{ route('chat.inbox') }}">
                            Tüm Mesajları Gör
                        </a>
                    </div>
                </div>
            </li>


            {{-- Bildirim ikonu kısmı --}}
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    <div class="notifications">
                        <span class="notify-badge">{{ $notifications->count() }}</span>
                        <i class="bi bi-bell-fill"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="p-2 border-bottom m-2">
                        <h5 class="h5 mb-0">Notifications</h5>
                    </div>
                    <div class="header-notifications-list p-2">
                        @forelse($notifications as $notification)
                        <a class="dropdown-item" href="#">
                            <div class="d-flex align-items-center">
                                <div class="notification-box bg-light-primary text-primary">
                                    <i class="bi bi-bell-fill"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 dropdown-msg-user">
                                        {{ $notification->title }}
                                        <span class="msg-time float-end text-secondary">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </h6>
                                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">
                                        {{ \Illuminate\Support\Str::limit($notification->content, 50) }}
                                    </small>
                                </div>
                            </div>
                        </a>
                        @empty
                        <p class="text-center text-secondary">No notifications</p>
                        @endforelse
                    </div>
                    <div class="p-2">
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-center" href="{{ route('notifications.index') }}">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </li>

        </ul>
    </div>

    {{-- Kullanıcı profili dropdown --}}
    <div class="dropdown dropdown-user-setting">
        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="user-setting d-flex align-items-center gap-3">
                <img
                    src="{{ asset('storage/profile_photos/' . (auth()->user()->profile_photo ?? 'default.png')) }}"
                    class="user-img"
                    alt="{{ auth()->user()->name }}">
                <div class="d-none d-sm-block">
                    <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                    {{-- İstersen kullanıcı tipine göre unvan da getirebilirsin --}}
                    <small class="mb-0 dropdown-user-designation">
                        {{ ucfirst(auth()->user()->roles->pluck('name')->first() ?? 'guest') }}
                    </small>
                </div>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-fill"></i>
                        <span class="ms-3">Profile</span>
                    </div>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-lock-fill"></i>
                            <span class="ms-3">Logout</span>
                        </div>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
