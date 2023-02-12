@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('product.index') }}" class="btn btn-dark">All product</a>
    </div>
    <hr>
    <form action="{{ url('admin/create-product-remove/' . $product->slug) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Quantity</label>
            <input type="number" name="total_quantity" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <input type="submit" value="Remove" class="btn btn-primary">
    </form>
@endsection
