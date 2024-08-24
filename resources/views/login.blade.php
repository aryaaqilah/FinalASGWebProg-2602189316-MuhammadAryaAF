@extends('master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Login User</h1>
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        <!-- token form -->
                        @csrf
                        <div class="mb-3">
                            <label for="username">Email</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   name="username" id="username" value="{{ old('username') }}">

                            <!-- error message untuk name -->
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password">

                            <!-- error message untuk password -->
                            @error('password')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Login</button>
                        {{-- <a href="" class="btn btn-md btn-secondary">back</a> --}}
                    </form>

                    <!-- Link to the registration page -->
                    <div class="mt-3">
                        <p>Don't have an account? <a href="{{ url('/register') }}" class="text-primary">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
