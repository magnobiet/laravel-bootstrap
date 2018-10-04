@extends('adminlte::page')

@section('title', __('Show state'))

@section('content_header')

    <h1>{{ __('Show state') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('states.index') }}">{{ __('States') }}</a></li>
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
                        <p class="form-control-static">{{ $state->name }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Abbreviation') }}</label>
                        <p class="form-control-static">{{ $state->abbr }}</p>
                    </div>

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <a href="{{ route('states.index') }}" class="btn btn-default btn-sm pull-left">
                            {{ __('Cancel') }}
                        </a>

                    </div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title">
                        {{ __('Cities') }}
                    </h3>

                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>

                    </div>

                </div>

                <div class="box-body no-padding">

                    <div class="table-responsive">

                        <table class="table table-hover table-striped m-b-0">

                            <thead>
                                <tr>
                                    <th class="id">{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                </tr>
                            </thead>

                            @if (isset($state->city) && count($state->city))
                                <tbody>

                                    @foreach ($state->city as $key => $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            @endif

                            @if (isset($state->city) && !count($state->city))
                                <tfoot>
                                    <tr>
                                        <td colspan="2">{{ __('No records found')  }}</td>
                                    </tr>
                                </tfoot>
                            @endif

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
