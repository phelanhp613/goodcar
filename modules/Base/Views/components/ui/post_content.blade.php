<div class="accordion px-md-5 px-0" id="accordion-table-of-contents">
    <div class="accordion-item mb-3">
        <div class="accordion-button cursor-pointer fw-semibold fs-md-5 fs-6"
             role="button"
             data-bs-toggle="collapse"
             data-bs-target="#collapse-table-of-contents"
             aria-expanded="true"
             aria-controls="collapse-table-of-contents">
            <span class="me-2">{{ trans('Main Contain') }}</span>
            <span class="fs-md-7 fs-8 mt-1">[{{ trans('hide/show') }}]</span>
        </div>
        <div id="collapse-table-of-contents" class="accordion-collapse collapse show" aria-labelledby="collapse-table-of-contents"
             data-bs-parent="#accordion-table-of-contents">
            <div class="accordion-body px-0">
                <ul class="list-group list-unstyled">
                    @foreach($content as $key => $item)
                        <li class="list-group-item border-0 px-2 py-1 px-md-3">
                            <a class="text-decoration-none fw-semibold fs-md-6 fs-7" href="#{{$item->url}}">
                                <span>{{$item->label}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content mb-5">
    @if(!empty($content))
        <div class="body-content mb-4">
            @foreach($content as $key => $item)
                <div id="{{$item->url}}" class="content-section mb-4 fs-7 fs-md-6">
                    <h2 class="fs-md-4 fs-5 mb-3">{!! $item->label !!}</h2>
                    {!! str_replace('src=', 'class="lazy" data-src=', $item->content) !!}
                </div>
            @endforeach
        </div>
        {{--<div class="body-content hide-content mb-4">
            @foreach($content as $key => $item)
                <div class="content-section mb-4 fs-7 fs-md-6">
                    <h2 id="{{$item->url}}" class="fs-md-4 fs-5 mb-3">{!! $item->label !!}</h2>
                    {!! str_replace('src=', 'class="lazy" data-src=', $item->content) !!}
                </div>
            @endforeach
        </div>
        <div class="show-more text-center">
            <a class="btn btn-sm btn-outline-primary text-uppercase px-4 btn-show-more" href="javascript:">{{ trans("Show more") }}</a>
        </div>--}}
    @endif
</div>

@push('js')
    <script>
        $(document).ready(function () {
	        /*let btnShow = $(".btn-show-more");
	        let showMore = $(".show-more");
	        let bodyContent = $(".body-content");

	        btnShow.on("click", function() {
		        if($(".body-content").hasClass("hide-content")) {
			        btnShow.text('{{ trans("Show less") }}');
			        bodyContent.removeClass("hide-content");
			        showMore.addClass("no-before");
		        }else{
			        btnShow.text('{{ trans("Show more") }}');
			        bodyContent.addClass("hide-content");
			        showMore.removeClass("no-before");
		        }
	        });*/

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
        });
    </script>
@endpush