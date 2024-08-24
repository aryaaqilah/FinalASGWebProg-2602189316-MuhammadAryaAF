<!-- resources/views/profile.blade.php -->

@extends('layout')

@section('content')
    <div class="container">
        <h2>User Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $user->name }}</h4>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Gender:</strong> {{ $user->gender }}</p>
                <p class="card-text"><strong>Hobbies:</strong> {{ $user->hobbies }}</p>
                <p class="card-text"><strong>Instagram Username:</strong> {{ $user->insta_username }}</p>
                <p class="card-text"><strong>Register Price:</strong> {{ $user->register_price }}</p>
                <p class="card-text"><strong>Balance:</strong> {{ $user->balance }}</p>
                <p class="card-text"><strong>Has Paid:</strong> {{ $user->has_paid ? 'Yes' : 'No' }}</p>

                @if($user->profile_path)
                    <p class="card-text"><strong>Profile Picture:</strong></p>
                    <img src="{{ asset('storage/' . $user->profile_path) }}" alt="Profile Picture" class="img-fluid">
                @endif

                <form action="{{ route('profile.addBalance') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3">Add 100 to Balance</button>
                </form>
            </div>
        </div>
    </div>
@endsection
