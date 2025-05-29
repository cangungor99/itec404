{{-- resources/views/chat/inbox.blade.php --}}
@extends('layouts.app')

@section('title', 'Tüm Mesajlar | EMU Digital Club')

@section('content')
<main class="page-content">
    <div class="chat-wrapper d-flex">
        {{-- Sidebar --}}
        @include('chat.components.sidebar')

        {{-- Sağ taraf: Mesaj listesi --}}
        <div class="chat-content">
            <div class="chat-header d-flex align-items-center mb-3">
                <h4 class="mb-0 font-weight-bold">Tüm Mesajlar</h4>
            </div>

            @if ($privateMessages->isEmpty())
                <p class="text-muted">Henüz mesajınız yok.</p>
            @else
                <div class="list-group">
                    @foreach ($privateMessages as $msg)
                        @php
                            $otherUser = $msg->senderID == auth()->id() ? $msg->receiver : $msg->sender;
                        @endphp

                        @if ($otherUser)
                        <a href="{{ route('chat.private', $otherUser->userID) }}" class="list-group-item list-group-item-action mb-2 rounded shadow-sm">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $otherUser->name }} {{ $otherUser->surname ?? '' }}</strong>
                                    <span class="text-muted small">({{ $msg->senderID == auth()->id() ? 'Sen →' : '← O' }})</span>
                                </div>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                </small>
                            </div>
                            <div class="mt-1 text-truncate text-secondary">
                                {{ \Illuminate\Support\Str::limit($msg->message, 80) }}
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
