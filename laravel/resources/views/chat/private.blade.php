{{-- resources/views/chat/private.blade.php --}}
@extends('chat.layout')

@section('header')
    <h4 class="mb-1 font-weight-bold">{{ $user->name }} {{ $user->surname }}</h4>
@endsection

@php
    $formAction = route('chat.private.send', $user->userID);
@endphp
