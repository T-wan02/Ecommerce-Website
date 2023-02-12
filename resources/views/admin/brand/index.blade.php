@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('brand.create') }}" class="btn btn-success">Create Brand</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brand as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td>
                        <a href="{{ route('brand.edit', $c->slug) }}" class="btn btn-dark">Edit</a>
                        <form action="{{ route('brand.destroy', $c->slug) }}" method="POST" class="d-inline"
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
    {{ $brand->links() }}
@endsection
