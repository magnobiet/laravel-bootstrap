@extends('adminlte::page')

@section('title', __('Create permission'))

@section('content_header')

    <h1>{{ __('Create permission') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('permissions.index') }}">{{ __('Permissions') }}</a></li>
        <li class="active">{{ __('Create') }}</li>
    </ol>

@stop

@section('content')

    @include('components.errors')
    @include('components.message')

    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('permissions.store') }}" method="POST" autocomplete="off" role="form" data-validate>

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

                    </div>

                    <div class="box-footer">

                        <div class="box-tools">

                            <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm pull-left">
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
