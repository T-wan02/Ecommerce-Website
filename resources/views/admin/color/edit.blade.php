@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('color.index') }}" class="btn btn-dark">All Color</a>
    </div>

    <hr>

    <form action="{{ route('color.update', $color->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">Enter Color Name</label>
            <input type="text" class="form-control" name="name" value="{{ $color->name }}">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection
