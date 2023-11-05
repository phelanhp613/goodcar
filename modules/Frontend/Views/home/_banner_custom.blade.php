<div class="banner-custom d-block d-md-flex justify-content-center align-items-center @if($fullwidth) banner-full @endif">
    <div class="part-item-list py-5" data-image-pc="{{ $banner['image_pc'] ?? '' }}" data-image-mb="{{ $banner['image_mb'] ?? '' }}">
        @foreach($partItems as $key => $partItem)
            @continue(!$partItem['status'])
            <div class="part-item @if($key%2 != 0) reverse @endif">
                <div class="square position-relative">
                    <div class="circle-container position-relative">
                        <div class="circle bg-secondary d-flex justify-content-center align-items-center">
                            <div class="circle-content text-center">
                                <a href="{{ $partItem['url'] ?? 'javascript' }}" class="fw-semibold text-uppercase">{{ $partItem['name'] ?? '' }}</a>
                                <img src="{{ $partItem['icon'] }}" class="mx-auto" width="80" height="80" alt="{{ $partItem['name'] ?? '' }}"/>
                            </div>
                        </div>
                        <div class="sub-category">
                            <ul>
                                @foreach($partItem['children'] ?? [] as $child)
                                    @continue(empty($child['name']))
                                    <li>
                                        <a href="{{ $child['url'] ?? 'javascript' }}" class="fw-semibold">{{ $child['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>