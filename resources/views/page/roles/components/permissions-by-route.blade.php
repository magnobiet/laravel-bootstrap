@if ($permissions)

    @forelse($permissions as $route => $routes)

        <fieldset class="m-b-15">

            <legend>{{ ucwords($route) }}</legend>

            <div class="row">

                @foreach($routes as $permission)

                    <div class="col-xs-12 col-sm-6 col-md-2 m-b-5">

                        <label for="{{ $permission->name }}" class="checkbox-inline" title="{{ $permission->name }}">
                            <input type="checkbox" id="{{ $permission->name }}" name="permissions[]" value="{{ $permission->id }}"@if($permission->permissions){{ in_array($permission->id, $role->permissions) ? ' checked' : '' }}@endif>
                            {{ $permission->description }}
                        </label>

                    </div>

                @endforeach

            </div>

        </fieldset>

    @empty
        <div class="row">
            <div class="col-md-12">{{ __('No records found') }}</div>
        </div>
    @endforelse

@endif
