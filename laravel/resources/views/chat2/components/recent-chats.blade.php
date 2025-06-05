@foreach($recentChats as $chat)
    @php
        $authID = auth()->id();
        $other = $chat->senderID === $authID ? $chat->receiver : $chat->sender;
    @endphp
    <a href="javascript:;" class="list-group-item"
       onclick="selectUser({{ $other->userID }}, '{{ $other->name }} {{ $other->surname }}')">
        <div class="d-flex">
            <div class="chat-user-online">
                <img src="{{ asset('assets/images/avatars/avatar-2.png') }}" width="42" height="42" class="rounded-circle" alt="" />
            </div>
            <div class="flex-grow-1 ms-2">
                <h6 class="mb-0 chat-title">{{ $other->name }} {{ $other->surname }}</h6>
                <p class="mb-0 chat-msg">{{ $chat->message }}</p>
            </div>
            <div class="chat-time">{{ $chat->created_at->format('H:i') }}</div>
        </div>
    </a>
@endforeach
