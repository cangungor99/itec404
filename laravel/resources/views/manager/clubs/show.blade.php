@extends('layouts.app')
@section('title', 'My Club')
@section('content')
<main class="page-content">
    <div class="container py-4">
        <h3>{{ $club->name }}</h3>
        <p><strong>Description:</strong> {{ $club->description }}</p>
        <p><strong>Founded At:</strong> {{ $club->created_at->format('Y-m-d') }}</p>
    </div>
</main>
@endsection
