@if (Session::has('message'))

    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! Session::get('message') !!}
    </div>

@endif
