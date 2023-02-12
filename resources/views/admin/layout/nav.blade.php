<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main"
    style="z-index: 100">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="./index.html">
            <img src="/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                    aria-labelledby="navbar-default_dropdown_1">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="./assets/img/theme/team-1-800x800.jpg
">
                        </span>
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
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="./index.html">
                            <img src="./assets/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item  active ">
                    <a class="nav-link {{ request()->is('admin') ? 'bg-dark text-white active' : '' }}"
                        href="{{ url('/admin') }}">
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/category') ? 'active bg-dark text-white' : '' }}"
                        href="{{ route('category.index') }}">
                        <i class="ni ni-bullet-list-67 text-red"></i> Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/color') ? 'active bg-dark text-white' : '' }}"
                        href="{{ route('color.index') }}">
                        <i class="ni ni-palette text-orange"></i> Color
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/brand') ? 'active bg-dark text-white' : '' }} "
                        href="{{ route('brand.index') }}">
                        <i class="ni ni-tag text-yellow"></i> Brand
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/product') ? 'active bg-dark text-white' : '' }}"
                        href="{{ route('product.index') }}">
                        <i class="ni ni-shop text-blue"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/product_transaction') ? 'active bg-dark text-white' : '' }}"
                        href="{{ url('admin/product_transaction') }}">
                        <i class="ni ni-notification-70 text-info"></i> Product Transaction
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/order-list') ? 'active bg-dark text-white' : '' }}"
                        href="{{ url('admin/order-list') }}">
                        <i class="ni ni-single-copy-04 text-pink"></i> Order List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/income') ? 'active bg-dark text-white' : '' }}"
                        href="{{ url('admin/income') }}">
                        <i class="ni ni-cloud-download-95 text-pink"></i> Income
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/outcome') ? 'active bg-dark text-white' : '' }}"
                        href="{{ url('admin/outcome') }}">
                        <i class="ni ni-cloud-upload-96 text-pink"></i> Outcome
                    </a>
                </li>

            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            {{-- <h6 class="navbar-heading text-muted">Documentation</h6> --}}
            <!-- Navigation -->
            {{-- <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active active-pro">
                    <a class="nav-link" href="./examples/upgrade.html">
                        <i class="ni ni-send text-dark"></i> Upgrade to PRO
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>
