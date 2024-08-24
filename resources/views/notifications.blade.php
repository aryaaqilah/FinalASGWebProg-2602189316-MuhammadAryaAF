<!-- resources/views/notifications.blade.php -->

@extends('layout')

@section('title', 'Mutual')
@section('activeFriend', 'active')

@section('content')
    <div class="container">
        <h2>Your Notifications</h2>

        @if(Auth::user()->notifications->isEmpty())
            <p>No notifications available.</p>
        @else
            <ul class="list-group">
                @foreach(Auth::user()->notifications as $notification)
                    <li class="list-group-item">
                        {{ $notification->data['message'] }}
                        <a href="{{ $notification->data['action_url'] }}" class="btn btn-primary btn-sm float-end">View</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
