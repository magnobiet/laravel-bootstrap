@extends('adminlte::page')

@section('title', __('Create user'))

@section('content_header')

    <h1>{{ __('Create user') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
        <li class="active">{{ __('Create') }}</li>
    </ol>

@stop

@section('content')

    @include('components.errors')
    @include('components.message')

    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form" data-validate>

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
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" id="password" name="password" minlength="8" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="photo">{{ __('Photo') }}</label>
                                <input type="file" id="photo" name="photo" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="role">{{ __('Role') }}</label>
                                <select name="role" id="role" class="form-control" required>
                                    @foreach ($roles as $key => $value)
                                        <option value="">{{ __('Select')  }}</option>
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </fieldset>

                    </div>

                    <div class="box-footer">

                        <div class="box-tools">

                            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm pull-left">
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

@section('adminlte_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js" defer></script>

    @if (app()->getLocale() != 'en')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_{{ str_replace('-', '_', app()->getLocale()) }}.min.js" defer></script>
    @endif

@stop
