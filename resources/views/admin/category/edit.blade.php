@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('category.index') }}" class="btn btn-dark">All Category</a>
    </div>

    <hr>

    <form action="{{ route('category.update', $cat->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">Enter Category Name</label>
            <input type="text" class="form-control" name="name" value="{{ $cat->name }}">
        </div>
        <div class="form-group">
            <label for="">Enter Name(MM)</label>
            <input type="text" class="form-control" name="mm_name" value="{{ $cat->mm_name }}">
        </div>
        <div class="form-group">
            <label for="">Choose Image</label>
            <input type="file" class="form-control" name="image" value="{{ $cat->image }}">
            <img src="{{ asset('/images/' . $cat->image) }}" width="100" class="img-thumbnail" alt="category_image">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection
