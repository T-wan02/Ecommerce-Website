@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('outcome.index') }}" class="btn btn-dark">All Outcome List</a>
    </div>

    <hr>

    <form action="{{ route('outcome.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="">Enter Outcome Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="">Amount</label>
            <input type="text" class="form-control" name="amount">
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
    </form>
@endsection
