@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form action="{{ route('auth.login') }}" class="form mt-5" method="post">
                @csrf
                <h3 class="text-center text-dark">Login</h3>
                <div class="form-group">
                    <label for="username" class="text-dark">Username :</label><br>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                @error('username')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                @error('password')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                </div>
                @if(session('failed'))
                    <p style="color:red">{{session('failed')}}</p>
                @endif
            </form>
            <div class="text-right mt-2">
                <a href="{{ route('redirect.register') }}" class="text-dark">Register here</a>
            </div>
        </div>
    </div>
</div>
@endsection