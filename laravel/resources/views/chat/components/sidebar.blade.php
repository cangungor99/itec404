{{-- chat/components/sidebar.blade.php --}}
<div class="chat-sidebar">
    <div class="chat-sidebar-header">
        <div class="d-flex align-items-center">
            <div class="chat-user-online">
                <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" width="45" height="45" class="rounded-circle" alt="" />
            </div>
            <div class="flex-grow-1 ms-2">
                <p class="mb-0">{{ Auth::user()->name }} {{ Auth::user()->surname }}</p>
            </div>
        </div>
    </div>

    <div class="p-3">

        <p class="text-uppercase text-secondary mt-2 mb-1">Kulüp Sohbetleri</p>
        <div class="list-group">
            @foreach ($clubChats as $club)
                <a href="{{ route('chat.club', $club->clubID) }}" class="list-group-item list-group-item-action">
                    {{ $club->name }}
                </a>
            @endforeach
        </div>


        <p class="text-uppercase text-secondary mt-4 mb-1">Özel Mesajlar</p>
        <div class="list-group">
            @foreach ($privateChats as $user)
                <a href="{{ route('chat.private', $user->userID) }}" class="list-group-item list-group-item-action">
                    {{ $user->name }} {{ $user->surname }}
                </a>
            @endforeach
        </div>
    </div>
</div>
