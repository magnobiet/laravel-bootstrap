@extends('adminlte::page')

@section('title', __('Show role'))

@section('content_header')

    <h1>{{ __('Show role') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
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
                        <p class="form-control-static">{{ $role->name }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <p class="form-control-static">{{ $role->description }}</p>
                    </div>

                    @if ($role->permissions)
                        <div class="form-group">
                            <label>{{ __('Permissions') }}</label>
                            <ul class="form-control-static">
                                @forelse($role->permissions as $permission)
                                    <li>
                                        {{ $permission->description }}
                                        (<small class="text-muted">{{ $permission->name }}</small>)
                                    </li>
                                @empty
                                    <li>
                                        {{ __('No records found') }}
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <a href="{{ route('roles.index') }}" class="btn btn-default btn-sm pull-left">
                            {{ __('Cancel') }}
                        </a>

                        <a href="{{ route('roles.edit', [ 'id' => $role->id ]) }}" class="btn btn-sm bg-purple pull-right">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            {{ __('Edit') }}
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
