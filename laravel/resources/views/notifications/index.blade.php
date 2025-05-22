@extends('layouts.app')

@section('content')
<main class="page-content">
<div class="container py-4">
  <h1>All Notifications</h1>
  @if($notifications->count())
    <ul class="list-group">
      @foreach($notifications as $notification)
        <li class="list-group-item">
          <strong>{{ $notification->title }}</strong>
          <small class="text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
          <p>{{ $notification->content }}</p>
        </li>
      @endforeach
    </ul>
    {{ $notifications->links() }}
  @else
    <p>No notifications found.</p>
  @endif
</div>
</main>
@endsection
