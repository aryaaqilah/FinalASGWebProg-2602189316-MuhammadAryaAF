@extends('layout')

@section('content')
    <div class="container">
        <h2>Available Avatars</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @foreach($avatars as $avatar)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $avatar->image_path) }}" class="card-img-top" alt="{{ $avatar->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $avatar->name }}</h5>
                            <p class="card-text">Price: {{ $avatar->price }} coins</p>
                            <form action="{{ route('avatars.purchase', $avatar->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Buy Avatar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
