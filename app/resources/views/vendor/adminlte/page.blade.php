@extends('adminlte::master')

@section('adminlte_css')

    @stack('css')
    @yield('css')

@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')

    <div class="wrapper">

        <header class="main-header">

            @if(config('adminlte.layout') == 'top-nav')

                <nav class="navbar navbar-static-top">

                    <div class="container">

                        <div class="navbar-header">

                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>

                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </button>

                        </div>

                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>

                        @else

                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">

                                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>

                            </a>

                            <nav class="navbar navbar-static-top" role="navigation">

                                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                </a>

                                @endif

                                <div class="navbar-custom-menu">

                                    <ul class="nav navbar-nav">

                                        <li class="dropdown user user-menu">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                                                @if (isset(Auth::user()->photo_url) && Auth::user()->photo_url)
                                                    <img src="{{ Auth::user()->photo_url  }}" class="user-image" alt="{{ Auth::user()->name }}">
                                                @else()
                                                    <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" class="user-image" alt="{{ Auth::user()->name }}">
                                                @endif

                                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>

                                            </a>

                                            <ul class="dropdown-menu">

                                                <li class="user-header">

                                                    @if (isset(Auth::user()->photo_url) && Auth::user()->photo_url)
                                                        <img src="{{ Auth::user()->photo_url  }}" class="img-circle" alt="{{ Auth::user()->name }}">
                                                    @else()
                                                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" class="img-circle" alt="{{ Auth::user()->name }}">
                                                    @endif

                                                    <p>
                                                        {{ Auth::user()->name }}
                                                        <small>Member since {{ date_format(Auth::user()->created_at, "d/m/Y") }}</small>
                                                    </p>

                                                </li>

                                                <li class="user-footer">

                                                    <div class="pull-right">

                                                        <a href="#logout" class="btn btn-danger btn-flat" data-logout="#logout-form">
                                                            <i class="fa fa-fw fa-power-off" aria-hidden="true"></i>
                                                            {{ trans('adminlte::adminlte.log_out') }}
                                                        </a>

                                                    </div>

                                                    <form id="logout-form" class="logout-form display-none" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST">

                                                        @if(config('adminlte.logout_method'))
                                                            {{ method_field(config('adminlte.logout_method')) }}
                                                        @endif

                                                        {{ csrf_field() }}

                                                    </form>

                                                </li>

                                            </ul>

                                        </li>

                                    </ul>

                                </div>

                            @if(config('adminlte.layout') == 'top-nav')

                    </div>

                    @endif

                </nav>

        </header>

        @if(config('adminlte.layout') != 'top-nav')

            <aside class="main-sidebar">

                <section class="sidebar">

                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>

                </section>

            </aside>

        @endif

        <div class="content-wrapper">

            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                    @endif

                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <section class="content">
                        @yield('content')
                    </section>

                    @if(config('adminlte.layout') == 'top-nav')
                </div>
            @endif

        </div>

        <footer class="main-footer">

            <div class="pull-right hidden-xs">
                <b>Version</b>
                {{ \Illuminate\Foundation\Application::VERSION }}
            </div>

            <strong>
                Copyright © 2018
                @if(date('Y') != '2018')<span>- {{ date('Y') }}</span>@endif
            </strong>

        </footer>

    </div>

@stop

@section('adminlte_js')

    @stack('js')
    @yield('js')

@stop
