@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Order') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Order') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('Order::_search')
        @php use Modules\Order\Models\Order; @endphp
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
                                <th>{{ trans('Code') }}</th>
                                <th>{{ trans('Name') }}</th>
                                <th>{{ trans('Phone') }}</th>
                                <th style="width: 300px;">{{ trans('Delivery address') }}</th>
                                <th>{{ trans('Total Price') }}</th>
                                <th class="text-center" style="width: 100px">{{ trans('Status') }}</th>
                                <th style="width: 180px">{{ trans('Created At') }}</th>
                                <th class="action" style="width: 150px">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
                                <tr>
                                    <td><span class="number">{{$key++}}</span></td>
                                    <td class="fw-semibold text-danger">#{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="fw-bold text-primary">{{ currency_format($item->total_price) }}</td>
                                    <td>
                                        @php($status = $item->status)
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
                                    <td>{{ formatDate($item->created_at,'d-m-Y H:i') }}</td>
                                    <td class="text-center">
                                        @can('order-update')
                                            <a href="{{ route("get.order.update", $item->id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('order-delete')
                                            <a href="{{ route('get.order.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
                                                <i class="fa-solid fa-trash"></i>
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