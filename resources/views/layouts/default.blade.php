<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HABIT Dashboard</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">

    @stack('css')

    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light"><strong>HA</strong>BIT</span>
            </a>

            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img class="img-circle elevation-2" src="/dist/img/user.png">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->nama }}</a>
                    </div>
                </div>

                @php
                    $currentUrl = '/' . Request::path();
                @endphp
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link  @if (strpos($currentUrl, '/dashboard') === 0) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/petugas" class="nav-link  @if (strpos($currentUrl, '/petugas') === 0) active @endif">
                                <i class="nav-icon fas fa-user-tag"></i>
                                Petugas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/cabang" class="nav-link  @if (strpos($currentUrl, '/cabang') === 0) active @endif">
                                <i class="nav-icon fas fa-user-tag"></i>
                                Cabang
                            </a>
                        </li>
                        @if (auth()->user()->level == 1)
                            <li class="nav-item">
                                <a href="/pengguna" class="nav-link  @if (strpos($currentUrl, '/pengguna') === 0) active @endif">
                                    <i class="nav-icon fas fa-users"></i>
                                    Pengguna
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="/statusbaca" class="nav-link  @if (strpos($currentUrl, '/statusbaca') === 0) active @endif">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                Status Baca
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/targetbaca" class="nav-link  @if (strpos($currentUrl, '/targetbaca') === 0) active @endif">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                Target Baca
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/targetpenagihan"
                                class="nav-link  @if (strpos($currentUrl, '/targetpenagihan') === 0) active @endif">
                                <i class="nav-icon fas fa-money-bill"></i>
                                Target Penagihan
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link btn-warning text-dark" aria-current="page" href="javascript:;"
                                id="btn-logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2022</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    </form>
    @livewireScripts

    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/sparklines/sparkline.js"></script>
    <script src="/dist/js/adminlte.js"></script>
    <script>
        $("#btn-logout").on("click", function(e) {
            document.getElementById('logout-form').submit();
        });
    </script>
    @stack('scripts')
</body>

</html>
