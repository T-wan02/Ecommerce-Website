@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('color.index') }}" class="btn btn-dark">All Color</a>
    </div>

    <hr>

    <form action="{{ route('color.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="">Enter Color Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
    </form>
@endsection
