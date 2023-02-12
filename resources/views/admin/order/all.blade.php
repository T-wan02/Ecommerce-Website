@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ url('/admin/order-list') }}" class="btn btn-dark">All</a>
        <a href="{{ url('/admin/order-list?status=success') }}" class="btn btn-success">Success</a>
        <a href="{{ url('/admin/order-list?status=pending') }}" class="btn btn-warning">Pending</a>
        <a href="{{ url('/admin/order-list?status=cancel') }}" class="btn btn-danger">Cancel</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
                <th>User Info</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $o)
                <tr>
                    <td>
                        <img src="{{ $o->product->img_url }}" alt="{{ $o->product->name }}" width="50">
                    </td>
                    <td>{{ $o->product->name }}</td>
                    <td>{{ $o->total_quantity }}</td>
                    <td>{{ $o->product->sale_price }}</td>
                    <td>
                        @if ($o->status === 'pending')
                            <span class="badge badge-warning">{{ $o->status }}</span>
                        @endif
                        @if ($o->status === 'success')
                            <span class="badge badge-success">{{ $o->status }}</span>
                        @endif
                        @if ($o->status === 'cancel')
                            <span class="badge badge-danger">{{ $o->status }}</span>
                        @endif
                    </td>
                    <td>
                        <table class="table table-striped">
                            <tr>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Address</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ $o->user->image_url }}" alt="{{ $o->user->name }}" width="30">
                                </td>
                                <td>{{ $o->user->name }}</td>
                                <td>{{ $o->user->phone }}</td>
                                <td>{{ $o->user->address }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <a href="{{ url('/admin/change-order?id=' . $o->id . '&status=success') }}"
                            class="btn btn-success d-inline-block">Success</a>
                        <br>
                        @if ($o->status !== 'success')
                            <a href="{{ url('admin/change-order?id=' . $o->id . '&status=cancel') }}"
                                class="btn btn-danger mt-2">Cancel</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $order->links() }}
@endsection
