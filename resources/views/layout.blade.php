<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CONCONGSAN</title>
    @include('page.page-css')
</head>

<body>
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
     data-bs-theme="dark">
    <div class="container">
        @if(Auth::check())
            <a class="navbar-brand fw-light" href="/"><span
                        class="fas fa-brain me-1"> </span>@if(Auth::user()->role_id == 1)
                    Dashboard
                @else
                    Social
                @endif</a>
        @else
            <a class="navbar-brand fw-light" href="/"><span class="fas fa-brain me-1"> </span>Social</a>
        @endif

        <div>
            @if(Auth::check())
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page">{{Auth::user()->name}}</a>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page">Welcome</a>
                    </li>
                </ul>
            @endif
        </div>
        <div id="navbarNav">
            @if(Auth::check() && Auth::user()->role_id == 2)
                @include('merchants.navbar')
            @elseif(Auth::check() && Auth::user()->role_id == 3)
                @include('employees.navbar')
            @elseif(Auth::check() && Auth::user()->role_id == 4)
                @include('customers.navbar')
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('redirect.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('redirect.register') }}">Register</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
@yield('content')
@include('page.page-js')
</body>

</html>