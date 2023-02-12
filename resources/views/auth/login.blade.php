@extends('layout.master')
@section('header-text', 'Login')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-header bg-warning text-center text-white">Login</div>
                    <div class="card-body">
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <a style="text-decoration: underline;" href="{{ url('/register') }}">Dun have account yet?</a>
                            <br> <br>
                            <input type="submit" class="btn btn-warning" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
