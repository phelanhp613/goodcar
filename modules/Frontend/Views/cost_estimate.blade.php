@extends('Base::frontend.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2-bootstrap5.min.css') }}"/>
@endpush
@php
    $options = [];
    $selected = [];
    if(!empty($product)) {
        $options[$product->id] = "$product->name | $product->sku";
        $selected[] = $product->id;
    }
	$area = request()->area ?? 1;
@endphp
@section('content')
    <section id="order-section" class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Ước tính chi phí lăn bánh') }}</li>
            </ol>
        </nav>
        <div class="mb-5" style="height: 80vh">
            <h1 class="fs-2 mb-4">{{ trans('Ước tính chi phí lăn bánh') }}</h1>
            <div class="row g-5">
                <div class="col-md-5">
                    <div class="mb-4">
                        <form action="" method="get">
                            <div class="form-group">
                                <label for="" class="fw-semibold">Chọn xe</label>
                                <x-base::autocomplete-field name="product_id" id="product-id" action="{{ route('get.product_variant.find') }}" :options="$options" :selected-options="$selected" :multiple="false"/>
                            </div>
                            <div class="form-group mb-4">
                                <label for="" class="fw-semibold">Chọn khu vực (*)</label>
                                <select name="area" id="area" class="form-control">
                                    <option value="">Chọn khu vực</option>
                                    <option value="1" @if($area == 1) selected @endif>Khu vực 1</option>
                                    <option value="2" @if($area == 2) selected @endif>Khu vực 2</option>
                                    <option value="3" @if($area == 3) selected @endif>Khu vực 3</option>
                                </select>
                            </div>
                            <button type="submit" class="rounded-0 btn btn-primary w-100">Tra cứu</button>
                        </form>
                    </div>
                    <div class="fs-7">
                        <div>(*) Khu vực I: Gồm TP Hà Nội và TP Hồ Chí Minh</div>
                        <div>Khu vực II: Gồm các TP trực thuộc trung ương (trừ TP Hà Nội và TP Hồ Chí Minh), các TP trực thuộc tỉnh và các thị xã</div>
                        <div>Khu vực III: Gồm các khu vực khác ngoài khu vực I và khu vực II nêu trên</div>
                    </div>
                </div>
                <div class="col-md-7">
                    @if(!empty($product))
                        <div class="fs-5">
                            <table>
                                <tr>
                                    <td><span class="fw-semibold text-info">{{ $product->name }}</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold">Giá xe (bao gồm VAT): </span></td>
                                    <td><span class="price">{{ currency_format($price) }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold">Lệ phí trước bạ: </span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="ps-3">- Mức lệ phí</span></td>
                                    <td><span class="rate_fee">{{ $mucLePhi[request()->area ?? 1]*100 }}%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="ps-3">- Thành tiền</span></td>
                                    <td><span class="rate_fee">{{ currency_format($lePhi) }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold">Phí kiểm định:</span></td>
                                    <td><span class="phi_kiem_dinh">{{ currency_format($phiKiemDinh) }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold">Lệ phí đăng ký:</span></td>
                                    <td>
                                        <span class="phi_kiem_dinh">{{ currency_format($phiDK[request()->area ?? 1]) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold">Phí sử dụng đường bộ (1 năm):</span></td>
                                    <td><span class="su_dung_duong_bo">{{ currency_format($phiSuDungDuongBo) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold">Bảo hiểm TNDS (1 năm):</span></td>
                                    <td><span class="bao_hiem_tnds">{{ currency_format($bhTNSD) }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold fs-4"> TỔNG CỘNG (VNĐ):</span></td>
                                    <td><span class="total fw-semibold fs-4">{{ currency_format($total) }}</span></td>
                                </tr>
                            </table>
                            <div class="cost-note fs-6">
                                Mức biểu phí trên đây là tạm tính và có thể thay đổi do sự thay đổi của
                                thuế và các bên cung cấp dịch vụ khác. Mức bảo hiểm đã gồm 10% VAT.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
@endpush