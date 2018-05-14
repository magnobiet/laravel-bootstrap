@extends('adminlte::page')

@section('title', __('Show permission'))

@section('content_header')

    <h1>{{ __('Show permission') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('permissions.index') }}">{{ __('Permissions') }}</a></li>
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
                        <label>{{ __('Name') }}</label>
                        <p class="form-control-static">{{ $permission->name }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <p class="form-control-static">{{ $permission->description }}</p>
                    </div>

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm pull-left">
                            {{ __('Cancel') }}
                        </a>

                        <a href="{{ route('permissions.edit', [ 'id' => $permission->id ]) }}" class="btn btn-sm bg-purple pull-right">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            {{ __('Edit') }}
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
