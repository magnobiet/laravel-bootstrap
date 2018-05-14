@extends('adminlte::page')

@section('title', __('Create role'))

@section('content_header')

    <h1>{{ __('Create role') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
        <li class="active">{{ __('Create') }}</li>
    </ol>

@stop

@section('content')

    @include('components.errors')
    @include('components.message')

    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('roles.store') }}" method="POST" autocomplete="off" role="form" data-validate>

                <input type="hidden" name="_method" value="POST">

                <div class="box box-purple">

                    <div class="box-body">

                        <fieldset>

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" id="input" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <input type="text" id="description" name="description" class="form-control" required>
                            </div>

                        </fieldset>

                        <fieldset>

                            <div class="panel panel-default m-b-0">

                                <div class="panel-heading">

                                    {{ __('Permissions') }}

                                    <button type="button" class="btn btn-default btn-xs pull-right" data-check-all="#permissions">

                                        <span class="unchecked">
                                            <i class="fa fa-square-o" aria-hidden="true"></i>
                                            {{ __('Check all') }}
                                        </span>

                                        <span class="checked hide">
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            {{ __('Uncheck all') }}
                                        </span>

                                    </button>

                                </div>

                                <div id="permissions" class="panel-body">

                                    @forelse ($permissions as $key => $value)

                                        <label for="{{ $value->name }}" class="checkbox-inline">
                                            <input type="checkbox" id="{{ $value->name }}" name="permissions[]" value="{{ $value->id }}">
                                            {{ $value->description }}
                                            <small class="text-muted">({{ $value->name }})</small>
                                        </label>

                                    @empty
                                        <span>{{ __('No records found') }}</span>
                                    @endforelse

                                </div>

                            </div>

                        </fieldset>

                    </div>

                    <div class="box-footer">

                        <div class="box-tools">

                            <a href="{{ route('roles.index') }}" class="btn btn-default btn-sm pull-left">
                                {{ __('Cancel') }}
                            </a>

                            <button type="submit" class="btn btn-sm bg-purple pull-right">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                {{ __('Save') }}
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

@stop
