{{-- resources/views/chat/club.blade.php --}}
@extends('chat.layout')

@section('header')
    <h4 class="mb-1 font-weight-bold">{{ $club->name }}</h4>
@endsection

@php
    $formAction = route('chat.club.send', $club->clubID);
@endphp
