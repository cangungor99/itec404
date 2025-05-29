{{-- resources/views/chat/layout.blade.php --}}
@extends('layouts.app')

@section('title', 'EMU Digital Club | Chat')
@section('content')
<main class="page-content">
    <div class="chat-wrapper">
        @include('chat.components.sidebar')

        <div class="chat-header d-flex align-items-center">
            @yield('header')
        </div>

        <div class="chat-content">
            @include('chat.components.messages')
        </div>

        <div class="chat-footer d-flex align-items-center">
            @include('chat.components.footer')
        </div>

        <div class="overlay chat-toggle-btn-mobile"></div>
    </div>
</main>
@endsection



@push('scripts')
<script>
    function sendMessage(route, inputSelector) {
        const message = document.querySelector(inputSelector).value;
        if (!message.trim()) return;

        fetch(route, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message }),
        })
        .then(res => res.json())
        .then(() => {
            document.querySelector(inputSelector).value = '';
            fetchMessages();
        });
    }

    function fetchMessages() {
        fetch('{{ route('chat.messages') }}?type={{ isset($club) ? 'club' : 'private' }}&id={{ isset($club) ? $club->clubID : $user->userID }}')
            .then(res => res.text())
            .then(html => {
                document.querySelector('.chat-content').innerHTML = html;
            });
    }

    setInterval(fetchMessages, 5000);
</script>
@endpush
