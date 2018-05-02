@extends('adminlte::page')

@section('title', __('Edit user'))

@section('content_header')

    <h1>{{ __('Edit user') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
        <li class="active">{{ __('Edit') }}</li>
    </ol>

@stop

@section('content')

    @include('components.errors')
    @include('components.message')

    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('users.update', [ 'id' => $user->id ]) }}" method="POST" role="form" autocomplete="off" data-validate>

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="id" name="id" class="form-control" value="{{ $user->id }}">

                <div class="box box-purple">

                    <div class="box-body">

                        <fieldset>

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" id="input" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" id="password" name="password" minlength="8" class="form-control">
                            </div>

                        </fieldset>

                    </div>

                    <div class="box-footer">

                        <div class="box-tools">

                            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm pull-left">
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

@section('adminlte_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js" defer></script>

    @if (app()->getLocale() != 'en')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_{{ str_replace('-', '_', app()->getLocale()) }}.min.js" defer></script>
    @endif

@stop
