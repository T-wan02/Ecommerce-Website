@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('category.index') }}" class="btn btn-dark">All Category</a>
    </div>

    <hr>

    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="">Enter Category Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="">Enter Name(MM)</label>
            <input type="text" class="form-control" name="mm_name">
        </div>
        <div class="form-group">
            <label for="">Choose Images</label>
            <input type="file" class="form-control" name="image">
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
    </form>
@endsection
