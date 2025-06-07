<div id="chatMessages">
    @foreach ($messages as $msg)
        @include('chat.components.single-message', ['msg' => $msg])
    @endforeach
</div>
