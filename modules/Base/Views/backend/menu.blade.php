<?php
$menu = config_menu_merge();
$segment = segmentUrl(1);
?>
<ul class="navbar-nav nav-menu flex-wrap me-auto mb-2 mb-lg-0">
    @if(!empty($menu))
        @foreach($menu as $key => $item)
            @can($item['middleware'])
                @if($item['active'])
                    @if(empty($item['group']))
                        <li class="nav-item">
                            <a class="nav-link @if($segment === $item['id'] || ($segment == '/' && $item['id'] == 'dashboard')) active @endif" aria-current="page" href="{{ $item['route'] }}">
                                {!! $item['icon'] !!}
                                <span class="ps-1">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if($segment === $item['id']) active @endif"
                               href="javascript:" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {!! $item['icon'] !!}
                                <span class="ps-1">{{ $item['name'] }}</span>
                            </a>
                            <ul class="dropdown-menu rounded-0">
                                @foreach($item['group'] as $child)
                                    @php($segmentChild = segmentUrl(2))
                                    @can($child['middleware'])
                                        <li>
                                            <a class="dropdown-item
                                                @if($segmentChild === $child['id'] || ($segment == $child['id'] && in_array($segmentChild, ['/', 'update', 'create']))) active @endif"
                                                href="{{ $child['route'] }}">{{ $child['name'] }}</a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif
            @endcan
        @endforeach
    @endif
</ul>
