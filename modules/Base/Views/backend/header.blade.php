@php use Modules\Setting\Models\Website; @endphp
<header class="bg-secondary py-3 mb-5">
    <div class="header container position-relative">
        <div class="top-bar d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <div class="logo me-2">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ cache('setting_website')[Website::LOGO]['value'] ?? getSetting(Website::LOGO) }}" alt="" width="w-auto" height="40">
                    </a>
                </div>
            </div>
            <div class="setting-group d-flex align-items-center">
                <div class="d-block d-lg-none me-1">
                    <a class="btn btn-outline-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="fa-solid fa-list"></i>
                    </a>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header bg-secondary">
                            <div class="logo me-2">
                                <img src="{{ cache('setting_website')[Website::LOGO]['value'] ?? getSetting(Website::LOGO) }}" alt="" height="25">
                            </div>
                            <button type="button" class="btn border-0 text-primary" data-bs-dismiss="offcanvas">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="offcanvas-body">
                            @include('Base::backend.menu')
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    @php($auth = auth('admin')->user())
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-md-block dropdown-toggle">{{ $auth->name ?? '' }}</span>
                        <span class="d-block d-md-none"><i class="fa-regular fa-gear"></i></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('get.user.profile') }}">{{ trans('Profile') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.home') }}" target="_blank">{{ trans('Trang chủ') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('system.clear.cache') }}">{{ trans('Clear Cache') }}</a></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('admin.logout') }}">{{ trans('Logout') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-menu-desktop">
            <div class="nav d-lg-block d-none">
                <nav class="navbar navbar-expand-lg bg-white shadow-sm border rounded-3 px-3 w-100">
                    <div class="container-fluid">
                        <div class="navbar-collapse">
                            @include('Base::backend.menu')
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
