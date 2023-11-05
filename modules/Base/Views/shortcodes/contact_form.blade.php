<div class="row flex-column-reverse flex-md-row">
    <div class="col-md-5 p-4 bg-secondary d-flex align-items-center">
        <div>
            <div class="address mb-5">
                <h3 class="fs-6 fw-bold mb-1">{{ trans('Trung tâm trải nghiệm Basic Galaxy') }}</h3>
                <div>{{ $params['address'] ?? null }}</div>
            </div>
            <div>
                <h3 class="fs-6 fw-bold mb-3">{{ trans('Theo dõi Basic tại') }}</h3>
                @if(!empty($params['facebook']))
                    <a href="{{ $params['facebook'] }}" class="me-2">
                        <img src="{{ asset('images/svg/facebook.svg') }}" height="38" width="38" alt="">
                    </a>
                @endif
                @if(!empty($params['youtube']))
                    <a href="{{ $params['youtube'] }}" class="me-2">
                        <img src="{{ asset('images/svg/youtube.svg') }}" height="40" width="40" alt="">
                    </a>
                @endif
                @if(!empty($params['tiktok']))
                    <a href="{{ $params['tiktok'] }}" class="me-2">
                        <img src="{{ asset('images/svg/tiktok.svg') }}" height="40" width="40" alt="">
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-7 bg-primary pt-5 pb-4 px-4">
        <div class="pt-4">
            <h3 class="fs-5 mb-3 fw-bold text-uppercase text-secondary">{{ trans('Đăng ký nhận tư vấn thiết kế') }}</h3>
            <form action="{{ route('frontend.post.contact') }}" method="post" id="contact-form-shortcode">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" name="name" id="name" required class="form-control rounded-0" placeholder="{{ trans('Full name') . ' (' .trans('required') . ')' }}" aria-label="{{ trans('Full name') }}">
                </div>
                <div class="form-group mb-3">
                    <input type="tel" name="phone" id="phone" required class="form-control rounded-0" placeholder="{{ trans('Phone') . ' (' .trans('required') . ')' }}" aria-label="{{ trans('Phone') }}">
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" id="email" required class="form-control rounded-0" placeholder="{{ trans('Email') . ' (' .trans('required') . ')' }}" aria-label="{{ trans('Email') }}">
                </div>
                <div class="form-group mb-4">
                    <textarea name="content" rows="4" id="content" class="form-control rounded-0" placeholder="{{ trans('Yêu cầu tư vấn của quý khách') }}" aria-label="{{ trans('Content') }}"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-secondary text-primary fw-bold text-uppercase rounded-5 fs-7">{{ trans('Gửi thông tin') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>