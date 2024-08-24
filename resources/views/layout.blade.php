<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="\bootstrap-5.3.3-dist\css\bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="\bootstrap-5.3.3-dist\js\bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="\css\style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @yield('activeHome')" href="{{ url('/home') }}">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link @yield('activeRequest')" href="{{ route('friend-request.index') }}">Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('activeFriend')" href="{{ route('friend.index') }}">Friends</a>
            </li>
            </ul>
            @if (Auth::check())
                    <div class="d-flex align-items-center">
                        <span class="">Welcome, {{ Auth::user()->name }}!</span>
                        <form method="GET" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="btn">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
                    </div>
                @endif
          </div>
        </div>
      </nav>
      <main class="container">
        {{-- <div class="row">
            <div class="col-8">

                @yield('content')
            </div>
            <div class="col-4 d-flex flex-column">
                <h1 class='title'>Category</h1>
                <a href="#">Nasi</a>
                <a href="#">Mie</a>
                <a href="#">Roti</a>
            </div>
        </div> --}}
        @yield('content')
      </main>
      {{-- @yield('customJS') --}}
</body>
</html>
