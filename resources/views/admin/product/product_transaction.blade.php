@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ url('admin/pro') }}" class="btn btn-outline-success">Add transaction</a>
        <a href="{{ url('admin/') }}" class="btn btn-outline-success">Add transaction</a>
    </div>

    <hr>

    <table class="table table-striped">
        <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Total Quantity</th>
            <th>Description</th>
            <th>Buy Date</th>
        </thead>
        <tbody>

            @foreach ($transactions as $t)
                <tr>
                    <td><img src="{{ asset('/images/' . $t->product->image) }}" width="100" class="image-thumbnail"
                            alt="">
                    </td>
                    <td>{{ $t->product->name }}</td>
                    <td>{{ $t->total_quantity }}</td>
                    <td>{{ $t->description }}</td>
                    <td>{{ $t->created_at }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
