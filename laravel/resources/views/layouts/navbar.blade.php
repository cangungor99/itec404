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
                        <span class="notify-badge">{{ $unreadMessageCount }}</span>
                        <i class="bi bi-chat-left-text-fill"></i>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="p-2 border-bottom m-2">
                        <h5 class="h5 mb-0">Messages</h5>
                    </div>

                    <div class="header-notifications-list p-2" style="max-height: 300px; overflow-y: auto;">
                        @forelse($recentMessages as $message)
                        @php
                        $isClubMessage = $message->clubID !== null;
                        $userIsMember = !$isClubMessage || ($message->club && $message->club->memberships->contains('userID', auth()->id()));
                        $otherUserID = $message->senderID == auth()->id() ? $message->receiverID : $message->senderID;
                        $otherUserName = $message->senderID == auth()->id()
                        ? optional($message->receiver)->name
                        : optional($message->sender)->name;
                        $displayName = $isClubMessage
                        ? optional($message->club)->name
                        : $otherUserName;
                        @endphp

                        @if ($userIsMember)
                        <a class="dropdown-item" href="javascript:;" onclick="selectUser({{ $otherUserID }}, '{{ $otherUserName }}')">
                            <div class="d-flex align-items-center">
                                <div class="notification-box bg-light-info text-info">
                                    <i class="bi bi-chat-dots"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 dropdown-msg-user">
                                        {{ $displayName }}
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
                        <p class="text-center text-secondary">No Messages</p>
                        @endforelse


                    </div>

                    <div class="p-2">
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-center" href="{{ route('chat.index') }}">
                            View All Messages
                        </a>
                    </div>
                </div>
            </li>


            {{-- Bildirim ikonu kısmı --}}
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    <div class="notifications">
                        <span class="notify-badge">{{ count($unreadNotificationIDs ?? []) }}</span>
                        <i class="bi bi-bell-fill"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="p-2 border-bottom m-2">
                        <h5 class="h5 mb-0">Notifications</h5>
                    </div>
                    <div class="header-notifications-list p-2">
                        @forelse($notifications as $notification)
                        @php
                        $isUnread = in_array($notification->notificationID, $unreadNotificationIDs ?? []);
                        @endphp
                        <a
                            class="dropdown-item {{ $isUnread ? 'bg-light' : '' }}"
                            href="{{ route('notifications.index') }}"
                            data-id="{{ $notification->notificationID }}"
                            onclick="markNotificationAsRead(event, this)">
                            <div class="d-flex align-items-center">
                                <div class="notification-box {{ $isUnread ? 'bg-warning text-dark' : 'bg-light-primary text-primary' }}">
                                    <i class="bi bi-bell-fill"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 dropdown-msg-user {{ $isUnread ? 'fw-bold' : '' }}">
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
@push('scripts')
<script>
    function markNotificationAsRead(event, el) {
        event.preventDefault(); // linke gitmeyi engelle

        const notifID = el.getAttribute('data-id');

        fetch(`/notifications/navbar/read/${notifID}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
            .then(data => {
                if (data.status === 'ok') {
                    // CSS güncellemesi
                    el.classList.remove('bg-light');
                    const box = el.querySelector('.notification-box');
                    if (box) {
                        box.classList.remove('bg-warning', 'text-dark');
                        box.classList.add('bg-light-primary', 'text-primary');
                    }

                    const title = el.querySelector('.dropdown-msg-user');
                    if (title) {
                        title.classList.remove('fw-bold');
                    }

                    // Sayıyı azalt
                    const badge = document.querySelector('.notifications .notify-badge');
                    if (badge) {
                        let current = parseInt(badge.textContent.trim());
                        if (!isNaN(current) && current > 0) {
                            badge.textContent = current - 1;
                        }
                    }

                    // Sayfaya yönlendir
                    window.location.href = el.getAttribute('href');
                }
            });
    }
</script>
@endpush
