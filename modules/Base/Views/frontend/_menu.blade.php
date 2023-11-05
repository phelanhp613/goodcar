@php
    use Modules\Setting\Models\Website;
	$settings = cache('setting_website');
    $menu_list = json_decode($settings[Website::MENU_HEADER]['content'] ?? '[]', 1);
	$segment = '/' . segmentUrl(0);
@endphp
<ul class="navbar-nav menu m-auto align-items-lg-end menu-header-nav flex-wrap justify-content-center" id="menu-header">
    <li class="nav-item d-block d-lg-none mb-3">
        @include('Base::frontend._search_form')
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.home') }}" aria-label="Home">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#75512f" class="home-icon bi bi-house-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
            </svg>
        </a>
    </li>
    @if(!empty($menu_list))
        @foreach($menu_list as $item)
            <li class="nav-item">
                @if(!empty($item['children']))
                    <div class="dropdown w-100">
                        <a class="nav-link text-primary float-start parent-menu @if($segment == $item['url']) active @endif" href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                            <span class="d-none d-lg-inline-block dropdown-toggle"></span>
                        </a>
                        <a class="d-inline-block d-lg-none float-end px-2 py-1 fw-bold needsclick" aria-expanded="false" role="button" data-bs-toggle="dropdown">
                            ⌵
                        </a>
                        <ul class="dropdown-menu bg-secondary w-100 p-0">
                            @foreach($item['children'] as $key => $child)
                                @if(!empty($child['children']))
                                    <li class="dropdown-submenu p-2 @if($key < count($item['children'])-1) border-bottom @endif">
                                        <a class="dropdown-item parent-menu submenu-item dropdown-toggle text-primary fw-semibold p-0 @if($segment == $child['url']) active @endif" href="{{ $child['url'] }}">
                                            {{ $child['label'] }}
                                        </a>
                                        <ul class="dropdown-menu bg-secondary">
                                            @foreach($child['children'] as $childer)
                                                <li>
                                                    <a class="dropdown-item fw-semibold text-primary @if($segment == $childer['url']) active @endif" href="{{ $childer['url'] }}">{{ $childer['label'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="p-2">
                                        <a class="dropdown-item fw-semibold text-primary p-0 @if($segment == $child['url']) active @endif" href="{{ $child['url'] }}">{{ $child['label'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @else
                    <a class="nav-link text-primary @if(str_replace('/', '', $segment) == $item['url']) active @endif" {{--aria-current="page" --}} href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    @endif
</ul>