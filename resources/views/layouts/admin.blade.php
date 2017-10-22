<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    </head>
    <body class="app header-fixed sidebar-fixed">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">☰</button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
            </li>
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="https://robohash.org/{{ Auth::user()->email }}" class="img-avatar" alt="{{ Auth::user()->email }}">
                    <span class="d-md-down-none"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>
                    <div class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
        </ul>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        Menu
                    </li>
                    <li class="nav-item">
                        @include('partials.orgswitcher')
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link"><i class="fa fa-tachometer"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orgs') }}" class="nav-link"><i class="fa fa-building"></i> Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link"><i class="fa fa-user"></i> Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-briefcase"></i> Reporting</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle"><i class="fa fa-newspaper-o"></i> Quizes</a>
                        <ul class="nav-dropdown-items">
                            {{--<li class="nav-item">--}}
                                {{--<a href="#" class="nav-link"><i class="fa fa-edit"></i>Manage</a>--}}
                            {{--</li>--}}
                            <li class="nav-item">
                                <a href="{{ route('admin.categories') }}" class="nav-link"><i class="fa fa-circle-o-notch"></i> Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="fa fa-question-circle"></i> Questions</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.admins') }}" class="nav-link"><i class="fa fa-group"></i> Admins</a>
                    </li>
                </ul>
            </nav>
        </div>
        <main class="main">
            <ol class="breadcrumb">
                @foreach($breadcrumb as $item)
                    <li class="breadcrumb-item @if(empty($item['route'])) {{ 'active' }} @endif">
                        @if(!empty($item['route'])) <a href="{{ route($item['route']) }}"> @endif
                            @if($item['icon']) <i class="fa fa-{{$item['icon']}}"></i> @endif{{ $item['name'] }}
                        @if(!empty($item['route'])) </a> @endif
                    </li>
                @endforeach
            </ol>
            <div class="container-fluid" id="vue-app">
                {!! getAlert() !!}
                @yield('content')
            </div>
        </main>
    </div>
    <footer class="app-footer">
        &copy; 8th Wonder Software 2017
    </footer>
    <script src="{{ asset('js/admin.js') }}"></script>
    </body>
</html>