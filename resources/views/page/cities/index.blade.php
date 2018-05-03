@extends('adminlte::page')

@section('title', __('Cities'))

@section('content_header')

    <h1>{{ __('Cities') }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li class="active">{{ __('Cities') }}</li>
    </ol>

@stop

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                        {{ __('Filters') }}
                    </h3>

                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>

                    </div>

                </div>

                <div class="box-body">

                    <form method="GET" action="{{ route('cities.index') }}" role="form">

                        <fieldset>

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="search">{{ __('Search') }}</label>
                                    <input type="search" id="search" name="search" class="form-control" value="{{ !empty($filter) && !empty($filter['search']) ? $filter['search'] : '' }}">
                                </div>

                                <div class="form-group col-md-3">

                                    <label for="orderBy">{{ __('Order by') }}</label>

                                    <select id="orderBy" name="orderBy" class="form-control">
                                        <option value=""></option>
                                        <option value="id" @if (!empty($filter) && !empty($filter['orderBy']) && $filter['orderBy'] === 'id') selected @endif>{{ __('ID') }}</option>
                                        <option value="name" @if (!empty($filter) && !empty($filter['orderBy']) && $filter['orderBy'] === 'name') selected @endif>{{ __('Name') }}</option>
                                        <option value="email" @if (!empty($filter) && !empty($filter['orderBy']) && $filter['orderBy'] === 'email') selected @endif>{{ __('Email') }}</option>
                                    </select>

                                </div>

                                <div class="form-group col-md-3">

                                    <label for="sortedBy">{{ __('Sorted by') }}</label>

                                    <select id="sortedBy" name="sortedBy" class="form-control">
                                        <option value=""></option>
                                        <option value="ASC" @if (!empty($filter) && !empty($filter['sortedBy']) && $filter['sortedBy'] === 'ASC') selected @endif>{{ __('Ascending') }}</option>
                                        <option value="DESC" @if (!empty($filter) && !empty($filter['sortedBy']) && $filter['sortedBy'] === 'DESC') selected @endif>{{ __('Descending') }}</option>
                                    </select>

                                </div>

                                <div class="form-group col-md-2">

                                    <div class="btn-group btn-group-justified m-t-25" role="group">

                                        @if (!empty($filter))
                                            <div class="btn-group" role="group">

                                                <a href="{{ route('cities.index') }}" class="btn btn-default">
                                                    {{ __('Clear filter') }}
                                                </a>

                                            </div>
                                        @endif

                                        <div class="btn-group" role="group">

                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Filter') }}
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </fieldset>

                    </form>

                </div>

            </div>

            @include('components.errors')
            @include('components.message')

            <div class="box box-purple">

                <div class="box-body no-padding">

                    <div class="table-responsive">

                        <table class="table table-hover table-striped m-b-0">

                            <thead>
                                <tr>
                                    <th class="id">{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('State')  }}</th>
                                </tr>
                            </thead>

                            @if (isset($cities) && count($cities))
                                <tbody>

                                    @foreach ($cities as $key => $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->state->name }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            @endif

                            @if (isset($cities) && !count($cities))
                                <tfoot>
                                    <tr>
                                        <td colspan="3">{{ __('No records found')  }}</td>
                                    </tr>
                                </tfoot>
                            @endif

                        </table>

                    </div>

                </div>

                <div class="box-footer">

                    <div class="box-tools">

                        <div class="pull-right">
                            {!! $cities->render() !!}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
