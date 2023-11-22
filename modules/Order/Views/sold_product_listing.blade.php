@extends('Base::backend.master')

@php use Modules\Order\Models\Order; @endphp
@section('content')
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Sold Product') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Sold Product') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        @include('Order::_search_sold_product')
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>{{ trans('Product') }}</th>
                                <th>{{ trans('Order Info') }}</th>
                                <th>{{ trans('Chassis number') }}</th>
                                <th>{{ trans('Vehicle engine number') }}</th>
                                <th class="text-center">{{ trans('Status') }}</th>
                                <th >{{ trans('Created At') }}</th>
                                <th class="action" style="width: 150px">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
                                <tr>
                                    <td><span class="number">{{$key++}}</span></td>
                                    <td class="fw-semibold text-info">
                                        <a href="{{ route('get.product_variant.update', $item->productVariant->id) }}">{{ $item->productVariant->name }}</a>
                                    </td>
                                    <td class="fw-semibold text-danger">
                                        <a href="{{ route('get.order.update', $item->order->id) }}">#{{ $item->order->code }}</a>
                                    </td>
                                    <td>
                                        @php($status = $item->order->status)
                                        @if ($status == 0)
                                            <span class="badge bg-danger text-white w-100">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 2)
                                            <span class="badge bg-warning w-100">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 5)
                                            <span class="badge bg-success w-100">{{ Order::getStatus($status) }}</span>
                                        @else
                                            <span class="badge bg-info w-100">{{ Order::getStatus($status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->chassis_number }}</td>
                                    <td>{{ $item->vehicle_engine_number }}</td>
                                    <td>{{ formatDate($item->order->created_at,'d-m-Y H:i') }}</td>
                                    <td class="text-center">
                                        @can('order-update')
                                            <a href="{{ route("get.order.sold_product_detail", $item->id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5 pagination-style">
                            {{ $data->withQueryString()->render('vendor/pagination/default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection