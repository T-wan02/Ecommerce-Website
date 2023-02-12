<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        M-Commernce
    </title>
    <!-- Favicon -->
    <link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link
        href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
    @yield('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body class="">
    @include('admin.layout.nav')
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark bg-gradient-primary" id="navbar-main">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <div class="navbar-nav align-items-center ml-md-auto"></div>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="/assets/img/theme/team-4-800x800.jpg">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ auth()->guard('admin')->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="./examples/profile.html" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>
                                <a href="./examples/profile.html" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Settings</span>
                                </a>
                                <a href="./examples/profile.html" class="dropdown-item">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span>Activity</span>
                                </a>
                                <a href="./examples/profile.html" class="dropdown-item">
                                    <i class="ni ni-support-16"></i>
                                    <span>Support</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <form action="{{ url('/admin/logout') }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="submit" class="btn btn-sm btn-dark" value="Log out">
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- User -->

            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header p-3">
            <div class="card p-2">

            </div>
        </div>
        <div class="mt-5 card-body p-3 ">
            @if ($errors->any())
            @foreach ($errors->all() as $e)
                <div class="alert alert-danger">{{ $e }}</div> @endforeach
            @endif
    @yield('content')
    </div>
    </div>
    <div class="container-fluid
        mt--7">

    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
        </div>
    </footer>
    </div>
    </div>
    <!--   Core   -->
    <script src="/assets/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Optional JS   -->
    <script src="/assets/js/plugins/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
    <!--   Argon JS   -->
    <script src="/assets/js/argon-dashboard.min.js?v=1.1.2"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>
    @yield('script')
    @if (session()->has('error'))
        <script>
            Toastify({
                text: '{{ session('error') }}',
                className: 'bg-danger',
                position: 'center'
            }).showToast();
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            Toastify({
                text: '{{ session('success') }}',
                className: 'bg-danger',
                position: 'center'
            }).showToast();
        </script>
    @endif
    </body>

</html>
