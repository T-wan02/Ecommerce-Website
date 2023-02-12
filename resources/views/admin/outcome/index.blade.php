@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('outcome.create') }}" class="btn btn-dark">Insert Outcome</a>
        <a href="{{ route('outcome.create') }}" class="btn btn-outline-warning">Today outcome : {{ $todayOutcome }}</a>
    </div>

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($outcome as $o)
                <tr>
                    <td>{{ $o->title }}</td>
                    <td>{{ $o->amount }}</td>
                    <td>{{ $o->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
