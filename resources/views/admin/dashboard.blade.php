@extends('admin.layout.master')

@section('content')
    <h1>Content Manangement</h1>
    {{-- {{ auth()->guard('admin')->user() }} --}}
    <style>
        .dashboard-i {
            font-size: 50px;
        }
    </style>
    <div class="row">
        <div class="col-3">
            <div class="card bg-primary p-3">
                <div class="d-flex">
                    <div class="p-3 d-flex justify-content-center align-item-center">
                        <i class="fa fa-money dashboard-i"></i>
                    </div>
                    <div class="p-3 d-flex justify-content-center flex-column align-item-center">
                        <h5 class="text-white">Today's Income</h5>
                        <h2 class="text-white">{{ $todayIncomeCount }}ks</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card bg-primary p-3">
                <div class="d-flex">
                    <div class="p-3 d-flex justify-content-center align-item-center">
                        <i class="fa fa-money dashboard-i"></i>
                    </div>
                    <div class="p-3 d-flex justify-content-center flex-column align-item-center">
                        <h5 class="text-white">Today's Outcome</h5>
                        <h2 class="text-white">{{ $todayOutcomeCount }}ks</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card bg-primary p-3">
                <div class="d-flex">
                    <div class="p-3 d-flex justify-content-center align-item-center">
                        <i class="fa fa-money dashboard-i"></i>
                    </div>
                    <div class="p-3 d-flex justify-content-center flex-column align-item-center">
                        <h5 class="text-white">User</h5>
                        <h2 class="text-white">{{ $userCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card bg-primary p-3">
                <div class="d-flex">
                    <div class="p-3 d-flex justify-content-center align-item-center">
                        <i class="fa fa-money dashboard-i"></i>
                    </div>
                    <div class="p-3 d-flex justify-content-center flex-column align-item-center">
                        <h5 class="text-white">Product</h5>
                        <h2 class="text-white">{{ $productCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h2>Sale Chart</h2>
                    <canvas id="saleChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h2>Income Outcome Chart</h2>
                    <canvas id="inoutChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>Latest User</h4>

                    <ul class="list-group">
                        @foreach ($latestUser as $u)
                            <li class="list-group-item d-flex justify-content-between align-item-center">
                                <img src="{{ $u->image_url }}" width="50" class="rounded-circle"
                                    alt="{{ $u->name }}">
                                <span class="">{{ $u->name }}</span>
                                <span class="">{{ $u->email }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4>Product quantity under 3</h4>

                    <table class="table table-border">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($lowProduct) === 0)
                                <tr>
                                    <td colspan="3" class="text-center">
                                        There is no product under quantity 3.
                                    </td>
                                </tr>
                            @endif
                            @foreach ($lowProduct as $p)
                                <tr>
                                    <td>
                                        <img src="{{ $p->img_url }}" width="50" class="rounded-circle">
                                    </td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->total_quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //sale chart
        const labels = @json($months);

        const data = {
            labels: labels,
            datasets: [{
                label: 'Sale Chart',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: @json($saleData),
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('saleChart'),
            config
        );

        // income outcome chart
        const inoutLabels = @json($dayMonth);

        const inoutData = {
            labels: inoutLabels,
            datasets: [{
                    label: 'Income',
                    borderColor: 'lime',
                    data: @json($incomeData),
                },
                {
                    label: 'Outcome',
                    borderColor: 'red',
                    data: @json($outcomeData),
                }
            ]
        };

        const inoutConfig = {
            type: 'line',
            data: inoutData,
            options: {}
        };
        new Chart(
            document.getElementById('inoutChart'),
            inoutConfig
        );
    </script>
@endsection
