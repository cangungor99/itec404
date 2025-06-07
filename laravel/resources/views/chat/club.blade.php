@extends('layouts.app')
@section('title', 'Kulüp Sohbeti')

@section('content')
<main class="page-content">
    <div class="container py-4">
        <h4 class="mb-3">Kulüp: {{ $club->name }}</h4>

        <div class="card">
            <div class="card-body" style="max-height: 500px; overflow-y: auto;" id="clubChatBox">
                @foreach ($messages as $msg)
                    @if ($msg->senderID === auth()->id())
                        <div class="text-end mb-2">
                            <div class="badge bg-primary">{{ $msg->message }}</div><br>
                            <small class="text-muted">Sen - {{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @else
                        <div class="text-start mb-2">
                            <div class="badge bg-secondary">{{ $msg->message }}</div><br>
                            <small class="text-muted">{{ $msg->sender->name ?? 'Kullanıcı' }} - {{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <form id="clubMessageForm" class="d-flex mt-3">
            @csrf
            <input type="text" class="form-control me-2" id="clubMessageInput" placeholder="Mesaj yaz...">
            <button type="submit" class="btn btn-success">Gönder</button>
        </form>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const form = document.getElementById('clubMessageForm');
    const input = document.getElementById('clubMessageInput');
    const box = document.getElementById('clubChatBox');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;

        fetch("{{ route('chat.club.send', $club->clubID) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        }).then(res => {
            if (res.ok) {
                box.insertAdjacentHTML('beforeend', `
                    <div class="text-end mb-2">
                        <div class="badge bg-primary">${message}</div><br>
                        <small class="text-muted">Sen - şimdi</small>
                    </div>
                `);
                input.value = '';
                box.scrollTop = box.scrollHeight;
            }
        });
    });
</script>
@endpush
