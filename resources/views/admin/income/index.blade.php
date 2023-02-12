@extends('admin.layout.master')

@section('content')
    <div>
        <a href="{{ route('income.create') }}" class="btn btn-dark">Insert Income</a>
        <a href="{{ route('income.create') }}" class="btn btn-outline-warning">Today Income : {{ $todayIncome }}ks</a>
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
            @foreach ($income as $i)
                <tr>
                    <td>{{ $i->title }}</td>
                    <td>{{ $i->amount }}</td>
                    <td>{{ $i->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
