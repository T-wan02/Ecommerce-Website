@extends('layout.master')
@section('header-text', 'Register')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-header bg-warning text-center text-white">Register</div>
                    <div class="card-body">
                        <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="">Choose Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Phone Number</label>
                                <input type="number" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Address</label>
                                <textarea name="address" class="form-control" name="address" cols="30" rows="10"></textarea>
                            </div>
                            <input type="submit" class="btn btn-warning" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
