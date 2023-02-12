@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('category.create') }}" class="btn btn-success">Create Category</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Name(mm)</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $c)
                <tr>
                    <td><img src="{{ asset('/images/' . $c->image) }}" alt="" width="100" class="img-thumbnail"></td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->mm_name }}</td>
                    <td>
                        <a href="{{ route('category.edit', $c->slug) }}" class="btn btn-dark">Edit</a>
                        <form action="{{ route('category.destroy', $c->slug) }}" method="POST" class="d-inline"
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
    {{ $category->links() }}
@endsection
