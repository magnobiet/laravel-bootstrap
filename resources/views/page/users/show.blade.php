@extends('adminlte::page')

@section('title', __('Show user'))

@section('content_header')

    <h1>{{ __('Show user') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
        <li class="active">{{ __('Show') }}</li>
    </ol>

@stop

@section('content')

    @include('components.errors')
    @include('components.message')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-purple">

                <div class="box-body">

                    <div class="form-group">
                        <label>{{ __('User') }}</label>
                        <p class="form-control-static">{{ $user->name }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <p class="form-control-static">{{ $user->email }}</p>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <p class="form-control-static">********************************</p>
                    </div>

                    @if (isset($user->photo_url) && $user->photo_url)

                        <div class="form-group">
                            <label>{{ __('Photo') }}</label>
                        </div>

                        <img src="{{ $user->photo_url }}" class="img-thumbnail" width="250" alt="{{ $user->name }}">

                    @endif

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm pull-left">
                            {{ __('Cancel') }}
                        </a>

                        <a href="{{ route('users.edit', [ 'id' => $user->id ]) }}" class="btn btn-sm bg-purple pull-right">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            {{ __('Edit') }}
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
