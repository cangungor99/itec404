{{-- chat/components/footer.blade.php --}}
<div class="flex-grow-1 pe-2">
    <form onsubmit="event.preventDefault(); sendMessage('{{ $formAction }}', '#chatInput');">
        @csrf
        <div class="input-group">
            <span class="input-group-text"><i class='bx bx-smile'></i></span>
            <input type="text" name="message" class="form-control" placeholder="Mesaj yaz..." id="chatInput" required>
        </div>
    </form>
</div>
