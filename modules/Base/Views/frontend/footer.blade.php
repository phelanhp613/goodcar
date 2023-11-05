@php use Modules\Setting\Models\Website; @endphp@php($setting_website = cache('setting_website'))@php($facebook = $setting_website[Website::FACEBOOK]['value'] ?? getSetting(Website::FACEBOOK))@php($zalo = $setting_website[Website::ZALO]['value'] ?? getSetting(Website::ZALO))@php($phone = $setting_website[Website::PHONE_NUMBER]['value'] ?? getSetting(Website::PHONE_NUMBER))
<footer class="footer bg-secondary py-5 px-2">
    <div class="container text-primary">
        <div class="row">
            <div class="col-md-3 d-flex align-items-center mb-4">
                <div class="border border-primary rounded-4 text-center p-3 w-100">
                    <div class="mb-1">
                        <a class="navbar-brand logo" href="{{ route('frontend.home') }}" aria-label="logo">
                            <img src="{{ cache('setting_website')[Website::LOGO]['value'] ?? getSetting(Website::LOGO) }}" alt="" class="w-auto" width="214" height="40">
                        </a>
                    </div>
                    <div class="fs-7 fs-md-6 fw-semibold text-uppercase">
                        {{ $setting_website[Website::SLOGAN]['value'] ?? getSetting(Website::SLOGAN) ?? ''}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-footer">
                    @if(!empty($setting_website[Website::ADDRESS]['value'] ?? getSetting(Website::ADDRESS)))
                        <div class="mb-4">
                            <h1 class="fs-md-5 fs-6 mb-md-3 mb-1">
                                <div class="footer-icon d-inline-block">
                                    <svg style="color: rgb(117, 81, 47);" height="20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" fill="#75512f"></path>
                                    </svg>
                                </div>
                                <span>{{ trans('Address') }}</span>
                            </h1>
                            <div class="fs-md-6 fs-7">
                                {!! $setting_website[Website::ADDRESS]['value'] ?? getSetting(Website::ADDRESS) !!}
                            </div>
                        </div>
                    @endif
                    @if(!empty($phone))
                        <div class="mb-4">
                            <h1 class="fs-md-5 fs-6 mb-md-3 mb-1">
                                <div class="footer-icon d-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#75512f" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                </div>
                                <span>{{ trans('Hotline') }}:</span>
                                <a href="tel:{{ $phone }}" class="fw-semibold" aria-label="{{ $phone }}">
                                    {{ $phone }}
                                </a>
                            </h1>
                        </div>
                    @endif
                    @if(!empty($setting_website[Website::EMAIL]['value'] ?? getSetting(Website::EMAIL)))
                        <div class="mb-4">
                            <h1 class="fs-md-5 fs-6 mb-md-3 mb-1">
                                <div class="footer-icon d-inline-block">
                                    <svg style="color: rgb(117, 81, 47);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="3 3 30 30" preserveAspectRatio="xMidYMid meet" version="1.0">
                                        <defs>
                                            <clipPath id="id2">
                                                <path d="M 3.460938 6.5625 L 26.539062 6.5625 L 26.539062 24.707031 L 3.460938 24.707031 Z M 3.460938 6.5625 " clip-rule="nonzero" fill="#75512f"></path>
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#id2)">
                                            <path fill="#75512f" d="M 24.230469 11.101562 L 15 16.769531 L 5.769531 11.101562 L 5.769531 8.832031 L 15 14.503906 L 24.230469 8.832031 Z M 24.230469 6.5625 L 5.769531 6.5625 C 4.492188 6.5625 3.472656 7.578125 3.472656 8.832031 L 3.460938 22.441406 C 3.460938 23.695312 4.492188 24.707031 5.769531 24.707031 L 24.230469 24.707031 C 25.507812 24.707031 26.539062 23.695312 26.539062 22.441406 L 26.539062 8.832031 C 26.539062 7.578125 25.507812 6.5625 24.230469 6.5625 " fill-opacity="1" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                </div>
                                <span>{{ trans('Email') }}:</span>
                                <a href="mailto:{{ $setting_website[Website::EMAIL]['value'] ?? getSetting(Website::EMAIL) }}" class="fs-md-6 fs-7" aria-label="{{ $setting_website[Website::EMAIL]['value'] ?? getSetting(Website::EMAIL) }}">
                                    {{ $setting_website[Website::EMAIL]['value'] ?? getSetting(Website::EMAIL) }}
                                </a>
                            </h1>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
				<?php
				$settings    = cache('setting_website');
				$menu_footer = json_decode($settings[Website::MENU_FOOTER]['content'] ?? '[]', 1);
				?>
                <div class="textwidget custom-html-widget mb-4">
                    <h1 class="fs-md-5 fs-6 mb-md-3 mb-1">
                        <div class="footer-icon d-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#75512f" class="bi bi-person-workspace" viewBox="0 0 20 20">
                                <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                            </svg>
                        </div>
                        <span>{{ trans('Customer support') }}</span>
                    </h1>
                    <div class="mb-4">
                        @foreach($menu_footer as $item)
                            <div class="mb-2 fs-md-6 fs-7">
                                <a href="{{ $item['url'] }}" class="hover text-decoration-underline">{{ $item['label'] }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <a href='http://online.gov.vn/Home/WebDetails/105553' rel="nofollow" target="_blank">
                            <img src='{{ asset('images/logoSaleNoti.png') }}' class="w-80 h-auto" width="100" height="100" alt='http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png' title='Đã thông báo bộ công thương'/>
                        </a>
                    </div>
                    <div>
                        <a href="//www.dmca.com/Protection/Status.aspx?ID=bec4c8a4-0218-401a-beef-768190ff58fd" title="DMCA.com Protection Status" class="dmca-badge" rel="nofollow" target="_blank">
                            <img src="https://www.locklizard.com/wp-content/uploads/2023/04/dmca-protected.png?ID=bec4c8a4-0218-401a-beef-768190ff58fd" class="w-80 h-auto" width="100" height="100" alt="DMCA.com Protection Status"/>
                        </a>
                        <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div id="custom_html-3" class="widget_text col pb-0 widget widget_custom_html">
                    <div class="textwidget custom-html-widget">
                        <h1 class="fs-md-5 fs-6 mb-md-3 mb-2">Fanpage</h1>
                        <div class="fanpage-desktop">
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0" nonce="6R9NazmY"></script>
                            <div class="fb-page" data-href="{{ !empty($facebook) ? $facebook : 'https://www.facebook.com/basics.vietnam/' }}" data-tabs="" data-lazy="true" data-width="380" data-height="350" data-small-header="false" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="{{ !empty($facebook) ? $facebook : 'https://www.facebook.com/basics.vietnam/' }}" class="fb-xfbml-parse-ignore">
                                    <a href="{{ !empty($facebook) ? $facebook : 'https://www.facebook.com/basics.vietnam/' }}">Basics Vietnam</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 py-md-0"></div>
</footer>

<!-- Contact Buttons -->
<div class="contact-buttons d-flex d-md-block flex-row-reverse">
    <a href="{{ !empty($facebook) ? $facebook : "https://www.facebook.com/basics.vietnam/" }}" class="contact-button" target="_blank" aria-label="facebook">
        <div class="contact-button-circle"></div>
        <div class="contact-button-fill"></div>
        <div class="contact-button-image bg-white rounded-circle border border-white">
            <img src="{{ asset('images/fb-messenger.png') }}" alt="" width="30" height="30">
        </div>
    </a>
    <a href="{{ !empty($zalo) ? $zalo : "https://zalo.me/" }}" target="_blank" class="contact-button" aria-label="zalo">
        <div class="contact-button-circle"></div>
        <div class="contact-button-fill"></div>
        <div class="contact-button-image bg-info rounded-circle border border-2 border-white">
            <img src="{{ asset('images/zalo.png') }}" alt="" width="30" height="30">
        </div>
    </a>
    <a href="tel:{{ !empty($phone) ? $phone : null }}" target="_blank" class="contact-button" aria-label="phone">
        <div class="contact-button-circle phone"></div>
        <div class="contact-button-fill phone"></div>
        <div class="contact-button-image bg-danger rounded-circle border border-2 border-white">
            <img src="{{ asset('images/phone.png') }}" class="d-flex justify-content-center align-items-center" alt="" width="30" height="30">
        </div>
    </a>
</div>