@extends('adminlte::page')

@section('title', __('Edit role'))

@section('content_header')

    <h1>{{ __('Edit role') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
        <li class="active">{{ __('Edit') }}</li>
    </ol>

@stop

@section('content')

    @include('components.errors')
    @include('components.message')

    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('roles.update', [ 'id' => $role->id ]) }}" method="POST" role="form" autocomplete="off" data-validate>

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="id" name="id" class="form-control" value="{{ $role->id }}">

                <div class="box box-purple">

                    <div class="box-body">

                        <fieldset>

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" id="input" name="name" class="form-control" value="{{ $role->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <input type="text" id="description" name="description" class="form-control" value="{{ $role->description }}" required>
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

                                <div id="permissions" class="panel-body p-b-0">

                                    @include('page.roles.components.permissions-by-route')

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
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                {{ __('Update') }}
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

@stop
