@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('product.create') }}" class="btn btn-success">Create Product</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                {{-- <th>Sale Price</th> --}}
                <th>Total Quantity</th>
                {{-- <th>Description</th> --}}
                <th>Add or Reduce</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $c)
                <tr>
                    <td><img src="{{ asset('/images/' . $c->image) }}" style="width: 200px;" class="image-thumbnail"
                            alt=""></td>
                    <td>{{ $c->name }}</td>
                    {{-- <td>{{ $c->sale_price }}</td> --}}
                    <td>{{ $c->total_quantity }}</td>
                    {{-- <td>{{ $c->description }}</td> --}}
                    <td>
                        <a href="{{ url('admin/create-product-remove/' . $c->slug) }}" class="btn btn-warning">-</a>
                        <a href="{{ url('admin/create-product-add/' . $c->slug) }}" class="btn btn-warning">+</a>
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $c->slug) }}" class="btn btn-dark">Edit</a>
                        <form action="{{ route('product.destroy', $c->slug) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete?')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
