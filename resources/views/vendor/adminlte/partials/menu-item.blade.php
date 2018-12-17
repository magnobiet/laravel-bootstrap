@if (is_string($item))

    <li class="header">{{ $item }}</li>

@else

    <li class="{{ $item['class'] }}">

        <a href="{{ $item['href'] }}" @if (isset($item['target'])) target="{{ $item['target'] }}" @endif>

            <i class="fa fa-fw fa-{{ $item['icon'] ?? 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}" aria-hidden="true"></i>
            <span>{{ $item['text'] }}</span>

            @if (isset($item['label']))

                <span class="pull-right-container">
                    
                    <span class="label label-{{ $item['label_color'] ?? 'primary' }} pull-right">
                        {{ $item['label'] }}
                    </span>

                </span>

            @elseif (isset($item['submenu']))

                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
                </span>

            @endif

        </a>

        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('adminlte::partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif

    </li>

@endif
