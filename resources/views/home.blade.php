@extends('layout')

@section('title', 'Home')
@section('activeHome', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <h5>Notifications</h5>
        <div class="alert alert-info">
            <ul class="list-unstyled mb-0">
                @forelse (Auth::user()->notifications as $notification)
                    <li>
                        {{ $notification->data['message'] }}
                        <a href="{{ route('notifications.destroy', $notification->id) }}" class="btn btn-danger btn-sm ms-2"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $notification->id }}').submit();">
                            <i class="icon-close"></i>
                        </a>

                        <form id="delete-form-{{ $notification->id }}"
                            action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>
                @empty
                    <li>No new notifications</li>
                @endforelse
            </ul>
        </div>

        <div class="row mt-4">
            <!-- Search Form -->
            <!-- Search Form -->
<!-- Search Form -->
<form method="GET" action="{{ route('user.index2') }}" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="gender" class="form-control">
                <option value="">All Genders</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="hobby[]">Hobby</label>
                <div class="input-group mb-3 @error('hobby') is-invalid @enderror">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="membaca" id="hobiMembaca" name="hobby[]"
                                {{ in_array('membaca', request('hobby', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="hobiMembaca">Membaca</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="berkebun" id="hobiBerkebun" name="hobby[]"
                                {{ in_array('berkebun', request('hobby', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="hobiBerkebun">Berkebun</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="memasak" id="hobiMemasak" name="hobby[]"
                                {{ in_array('memasak', request('hobby', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="hobiMemasak">Memasak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="melukis" id="hobiMelukis" name="hobby[]"
                                {{ in_array('melukis', request('hobby', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="hobiMelukis">Melukis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="bersepeda" id="hobiBersepeda" name="hobby[]"
                                {{ in_array('bersepeda', request('hobby', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="hobiBersepeda">Bersepeda</label>
                        </div>
                    </div>
                </div>
                @error('hobby')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</form>



            @foreach ($dataUser as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->fields_of_work }}</p>
                            <form method="POST" action="{{ route('friend-request.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary w-100">Send Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
