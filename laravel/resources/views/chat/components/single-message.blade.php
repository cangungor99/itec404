@if ($msg->senderID === auth()->id())
<div class="chat-content-rightside">
    <div class="d-flex ms-auto">
        <div class="flex-grow-1 me-2">
            <p class="mb-0 chat-time text-end">you, {{ $msg->created_at->format('H:i') }}</p>
            <p class="chat-right-msg">{{ $msg->message }}</p>
        </div>
    </div>
</div>
@else
<div class="chat-content-leftside">
    <div class="d-flex">
        <img src="{{ asset('storage/profile_photos/' . ($msg->sender->profile_photo ?? 'default.png')) }}"
            width="48" height="48"
            class="rounded-circle"
            alt="{{ $msg->sender->name }}" />

        <div class="flex-grow-1 ms-2">
            <p class="mb-0 chat-time">{{ $msg->sender->name ?? 'Kullanıcı' }}, {{ $msg->created_at->format('H:i') }}</p>
            <p class="chat-left-msg">{{ $msg->message }}</p>
        </div>
    </div>
</div>
@endif
