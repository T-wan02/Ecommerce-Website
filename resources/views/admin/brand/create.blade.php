@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brand</a>
    </div>

    <hr>

    <form action="{{ route('brand.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="">Enter Brand Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
    </form>
@endsection
