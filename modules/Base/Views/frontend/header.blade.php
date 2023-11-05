@php use Modules\Setting\Models\Website; @endphp
<header class="header">
    <nav class="header-nav position-fixed top-0 navbar navbar-expand-lg bg-secondary w-100">
        <div class="container-fluid position-relative justify-content-center align-items-center w-100 h-100">
            <div class="header-icon header-list">
                <a class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas" href="#header-menu" aria-controls="header-menu" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="32" fill="#75512f" class="bi bi-list-task" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                        <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                        <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                    </svg>
                </a>
            </div>
            <div class="logo-group">
                <a href="{{ route('frontend.home') }}" class="navbar-brand logo position-relative w-auto text-center me-0" aria-label="logo">
                    <img src="{{ cache('setting_website')[Website::LOGO]['value'] ?? getSetting(Website::LOGO) }}" alt="" class="w-auto" width="171" height="40">
                </a>
            </div>
            <div class="offcanvas offcanvas-start header-menu bg-secondary w-60 w-md-30" tabindex="-1" id="header-menu">
                <div class="offcanvas-header border-bottom border-primary pe-0">
                    <a class="navbar-brand logo logo-mobile" href="{{ route('frontend.home') }}" aria-label="logo">
                        <img src="{{ cache('setting_website')[Website::LOGO]['value'] ?? getSetting(Website::LOGO) }}" alt="" width="171" height="40">
                    </a>
                    <button type="button" class="btn text-primary fs-1 lh-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="offcanvas-body align-items-center">
                    @include('Base::frontend._menu')
                    <div class="d-block d-lg-none">
                        <div class="nav-sub-menu-header">
                            <div class="py-2 nav-item">
                                <a href="{{ route('frontend.redirect_to_page', 've-basic') }}" class="fw-semibold me-2 fs-7">Về Basic</a>
                            </div>
                            <div class="py-2 nav-item">
                                <a href="{{ route('frontend.redirect_to_page', 'lien-he') }}" class="fw-semibold me-2 fs-7">Liên hệ</a>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <a href="{{ cache('setting_website')[Website::FACEBOOK]['value'] ?? getSetting(Website::FACEBOOK) }}" class="me-1" aria-label="Facebook">
                                <svg style="color: rgb(117, 81, 47);" height="20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 500"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" fill="#75512f"></path>
                                </svg>
                            </a>
                            <a href="{{ cache('setting_website')[Website::INSTAGRAM]['value'] ?? getSetting(Website::INSTAGRAM) }}" class="me-1" aria-label="instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#75512f" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </a>
                            <a href="{{ cache('setting_website')[Website::INSTAGRAM]['value'] ?? getSetting(Website::INSTAGRAM) }}" class="me-1" aria-label="twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#75512f" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                </svg>
                            </a>
                            <a href="mailto:{{ cache('setting_website')[Website::EMAIL]['value'] ?? getSetting(Website::EMAIL) }}" class="me-1" aria-label="email">
                                <svg style="color: rgb(117, 81, 47);" xmlns="http://www.w3.org/2000/svg" width="30" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="30" preserveAspectRatio="xMidYMid meet" version="1.0">
                                    <defs>
                                        <clipPath id="id1">
                                            <path d="M 3.460938 6.5625 L 26.539062 6.5625 L 26.539062 24.707031 L 3.460938 24.707031 Z M 3.460938 6.5625 " clip-rule="nonzero" fill="#75512f"></path>
                                        </clipPath>
                                    </defs>
                                    <g clip-path="url(#id1)">
                                        <path fill="#75512f" d="M 24.230469 11.101562 L 15 16.769531 L 5.769531 11.101562 L 5.769531 8.832031 L 15 14.503906 L 24.230469 8.832031 Z M 24.230469 6.5625 L 5.769531 6.5625 C 4.492188 6.5625 3.472656 7.578125 3.472656 8.832031 L 3.460938 22.441406 C 3.460938 23.695312 4.492188 24.707031 5.769531 24.707031 L 24.230469 24.707031 C 25.507812 24.707031 26.539062 23.695312 26.539062 22.441406 L 26.539062 8.832031 C 26.539062 7.578125 25.507812 6.5625 24.230469 6.5625 " fill-opacity="1" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-icon header-cart d-flex">
                <div class="d-none d-lg-flex flex-wrap">
                    <a href="{{ route('frontend.redirect_to_page', 've-basic') }}" class="fw-semibold me-2 fs-7 py-1">Về Basic</a>
                    <a href="{{ route('frontend.redirect_to_page', 'lien-he') }}" class="fw-semibold me-2 fs-7 py-1">Liên hệ</a>
                </div>
                <div class="search-group dropdown px-2">
                    <a href="javascript:" class="cursor-pointer" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Search Icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#75512f" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu bg-secondary p-1 border-0 dropdown-search rounded-0">
                        @include('Base::frontend._search_form')
                    </div>
                </div>
                <x-cart::cart-icon/>
            </div>
        </div>
    </nav>
</header>
<x-cart::view-cart/>