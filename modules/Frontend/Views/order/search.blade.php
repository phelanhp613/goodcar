@extends('Base::frontend.master')
@section('content')
    <section id="order-section" class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Order Search') }}</li>
            </ol>
        </nav>
        <div class="mb-5">
            <h1 class="fs-2">Tra cứu đơn hàng</h1>
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <form action="" method="get">
                            <div class="d-flex gap-2">
                                <div class="w-80">
                                    <input type="tel" name="phone" class="rounded-0 form-control" value="{{ request()->phone }}" aria-label="T" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="w-20">
                                    <button type="submit" class="rounded-0 btn btn-primary w-100">Tra cứu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="height: 70vh">
                        @if(count($data) > 0)
                            @if($data->count() > 0)
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
                                                            <td>{{ formatDate($item->created_at,'d-m-Y H:i') }}</td>
                                                            <td class="text-center">
                                                                <a href="{{ route("frontend.get.orderDetail", $item->id) }}" class="btn btn-primary">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
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
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center fs-5"><i>Bạn chưa có đơn hàng nào</i></div>
                            @endif
                        @else
                            <div class="h-100 d-flex align-items-center justify-content-center fs-5"><i>Đơn hàng của bạn</i></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection