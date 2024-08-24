@extends('master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New User</h1>
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST">
                        <!-- token form -->
                        @csrf
                        <div class="mb-3">
                            <label for="username">Username</label>
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
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" id="name" value="{{ old('name') }}">

                            <!-- error message untuk email -->
                            @error('name')
                            <div class="invalid-feedback" role="alert">
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

                        {{-- <div class="mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control"
                                   name="password_confirmation">

                        </div> --}}

                        <div class="mb-3">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                   name="instagram" id="instagram" value="{{ old('instagram') }}">

                            <!-- error message untuk email -->
                            @error('instagram')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="" selected>Gender</option>
                                <option value="Male">Pria</option>
                                <option value="Female">Wanita</option>
                            </select>

                            @error('gender')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <label for="hobby[]">Hobby</label>
                            <div class="input-group mb-3 @error('hobby') is-invalid @enderror">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="membaca" id="hobiMembaca" name="hobby[]>
                                        <label class="form-check-label" for="hobiMembaca">
                                            Membaca
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="berkebun" id="hobiBerkebun" name="hobby[]>
                                        <label class="form-check-label" for="hobiBerkebun">
                                            Berkebun
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="memasak" id="hobiMemasak" name="hobby[]>
                                        <label class="form-check-label" for="hobiMemasak">
                                            Memasak
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="melukis" id="hobiMelukis" name="hobby[]>
                                        <label class="form-check-label" for="hobiMelukis">
                                            Melukis
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="bersepeda" id="hobiBersepeda" name="hobby[]">
                                        <label class="form-check-label" for="hobiBersepeda">
                                            Bersepeda
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('hobby')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Save</button>
                        <a href="" class="btn btn-md btn-secondary">back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
