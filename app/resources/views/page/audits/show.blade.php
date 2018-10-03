@extends('adminlte::page')

@section('title', __('Show audit'))

@section('content_header')

    <h1>{{ __('Show audit') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('audits.index') }}">{{ __('Audits') }}</a></li>
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
                        <label>{{ __('ID') }}</label>
                        <p class="form-control-static">{{ $audit->id }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Created at') }}</label>
                        <p class="form-control-static">{{ date_format($audit->created_at, "d/m/Y H:i:s") }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('User') }}</label>
                        <p class="form-control-static">

                            {{ $audit->user->name }}

                            <a href="{{ route('users.show', [ 'id' => $audit->user->id ]) }}" class="btn btn-link btn-xs">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>

                        </p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Event') }}</label>
                        <p class="form-control-static">
                            <span class="label label-@if ($audit->event == 'created')success @elseif($audit->event == 'updated')warning @elseif($audit->event == 'deleted')danger @else default @endif">
                                {{ strtoupper($audit->event) }}
                            </span>
                        </p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Auditable') }}</label>
                        <p class="form-control-static">{{ $audit->auditable_type }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('URL') }}</label>
                        <p class="form-control-static">{{ $audit->url }}</p>
                    </div>

                    <div class="form-group">

                        <label>{{ __('IP Address') }}</label>

                        <p class="form-control-static">
                            <a href="https://tools.keycdn.com/geo?host={{ $audit->ip_address }}" class="btn btn-default" target="_blank">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                {{ $audit->ip_address }}
                            </a>
                        </p>

                    </div>

                    <div class="form-group">
                        <label>{{ __('User-agent') }}</label>
                        <p class="form-control-static">{{ $audit->user_agent }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Tags') }}</label>
                        <p class="form-control-static">{{ $audit->tags }}</p>
                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ __('Old value') }}</h3>
                                </div>

                                <div class="box-body" data-json-viewer>
                                    {{ $audit->old_values }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ __('New value') }}</h3>
                                </div>

                                <div class="box-body" data-json-viewer>
                                    {{ $audit->new_values }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <a href="{{ route('audits.index') }}" class="btn btn-default btn-sm pull-left">
                            {{ __('Cancel') }}
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
