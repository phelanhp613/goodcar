<form action="{{ route('frontend.product.search') }}" method="get">
    <div class="input-group">
        <span class="input-group-text bg-secondary border-0 border-bottom border-primary rounded-0" id="search-header-input">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#75512f" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </span>
        <input type="text" name="keyword" class="form-control border-0 border-bottom border-primary bg-secondary rounded-0" placeholder="{{ trans('Search') }}" id="search-header-input" aria-label="Search">
    </div>
</form>