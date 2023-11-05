@php($params = request()->except(['column_desc', 'column_asc']))
@if($direction == 'asc')
    <a href="{{ route($route, $params + ['column_desc' => $column]) }}">
        <i class="fa fa-arrow-down-wide-short"></i>
    </a>
@else
    <a href="{{ route($route, $params + ['column_asc' => $column]) }}">
        <i class="fa fa-arrow-down-short-wide"></i>
    </a>
@endif