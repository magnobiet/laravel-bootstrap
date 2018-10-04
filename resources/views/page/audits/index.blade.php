@extends('adminlte::page')

@section('title', __('Audits'))

@section('content_header')

    <h1>{{ __('Audits') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li class="active">{{ __('Audits') }}</li>
    </ol>

@stop

@section('content')

    <div class="row">

        <div class="col-md-12">

            @include('components.errors')
            @include('components.message')

            <div class="box box-purple">

                <div class="box-body no-padding">

                    <div class="table-responsive">

                        <table class="table table-hover table-striped m-b-0">

                            <thead>
                                <tr>
                                    <th class="id">{{ __('ID') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Event') }}</th>
                                    <th>{{ __('Entity') }}</th>
                                    <th>{{ __('IP address') }}</th>
                                    <th>{{ __('Date')  }}</th>
                                    <th class="actions">{{ __('Actions') }}</th>
                                </tr>
                            </thead>

                            @if (isset($audits) && count($audits))
                                <tbody>

                                    @foreach ($audits as $key => $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>

                                                {{ $value->user->name }}

                                                <a href="{{ route('users.show', [ 'id' => $value->user->id ]) }}" class="btn btn-link btn-xs">
                                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                            <td>
                                                <span class="label label-@if ($value->event == 'created')success @elseif($value->event == 'updated')warning @elseif($value->event == 'deleted')danger @else default @endif">
                                                    {{ strtoupper($value->event) }}
                                                </span>
                                            </td>
                                            <td title="{{ $value->auditable_type }}">
                                                {{ str_replace('App\\Entities\\', '', $value->auditable_type) }}
                                            </td>
                                            <td>{{ $value->ip_address }}</td>
                                            <td>
                                                {{ date_format($value->created_at, "d/m/Y H:i:s") }}
                                            </td>
                                            <td>

                                                <a href="{{ route('audits.show', [ 'id' => $value->id ]) }}" class="btn btn-default btn-xs" title="{{ __('Show') }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    {{ __('Show') }}
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            @endif

                            @if (isset($audits) && !count($audits))
                                <tfoot>
                                    <tr>
                                        <td colspan="4">{{ __('No records found') }}</td>
                                    </tr>
                                </tfoot>
                            @endif

                        </table>

                    </div>

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <div class="pull-right">
                            {!! $audits->render() !!}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
