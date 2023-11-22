@php use Modules\Setting\Models\Website; @endphp
<header>
    <nav class="navbar navbar-expand-lg bg-black">
        <div class="container">
            <div class="logo">
                <a href="{{ route('frontend.home') }}" class="navbar-brand logo position-relative w-auto text-center me-0" aria-label="logo">
                    <img src="{{ cache('setting_website')[Website::LOGO]['value'] ?? getSetting(Website::LOGO) }}" alt="" class="w-auto" width="171" height="40">
                </a>
                <!-- <span class="text-white">GOOD CAR</span> -->
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('frontend.home') }}">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('frontend.product.search') }}">SẢN PHẢM</a>
                    </li>
                </ul>
                <form action="{{ route('frontend.product.search') }}" class="d-flex" role="search" method="get">
                    <input name="keyword" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-white" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </nav>
</header>