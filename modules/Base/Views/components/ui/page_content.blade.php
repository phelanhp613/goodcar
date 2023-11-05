<div class="content mb-5">
    @if(!empty($content))
        <div class="body-content mb-5">
            @foreach($content as $key => $item)
                <div class="content-section mb-4 fs-7 fs-md-6">
                    <h2 id="{{$item->url}}" class="fs-md-4 fs-5 mb-3">{!! $item->label !!}</h2>
                    {!! str_replace('src=', 'class="lazy" data-src=', $item->content) !!}
                </div>
            @endforeach
        </div>
    @endif
</div>
@push('js')
    @if(in_array('view', request()->segments()))
        <script>
            @if(in_array('view', request()->segments()))
                $.each($('a'), function (i, item) {
                    let href = $(item).attr('href');
                    if(href.indexOf('#') === -1){
                        $(item).attr('href','javascript:')
                    }

					if($(item).attr("data-bs-target") === '#view-cart') {
						$(item).attr("data-bs-target", 'view-cart')
                    }
                });
            @endif
        </script>
    @endif
@endpush