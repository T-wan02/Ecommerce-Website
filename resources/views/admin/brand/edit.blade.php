@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brand</a>
    </div>

    <hr>

    <form action="{{ route('brand.update', $brand->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">Enter Brand Name</label>
            <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection
