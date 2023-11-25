<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vn" xml:lang="vn">
<head>
    <title>BÁO CÁO TỔNG DOANH SỐ NHÂN VIÊN</title>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" /><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style type="text/css">
		body, th, h1, td, div, span {font-family: "Open Sans", sans-serif !important;}
        th, td, div, span { font-size: 13px }
		.text-center { text-align: center }
		table, th, td {  border: 1px solid black }
		th { font-weight: 700;}
		th, td {padding: 5px 10px}
        div { font-weight: 600;}
        .fw-bold { font-weight: 700; }
        i { font-weight: 400 !important;}
    </style>
</head>
<body>
    <div class="text-center">
        <h1 style="font-size: 17px; margin-bottom: 0">HÓA ĐƠN GIÁ TRỊ GIA TĂNG</h1>
        <div><i>(Bản thể hiện của hóa đơn điện tử)</i></div>
        <div>{{ 'Ngày ' . formatDate($created_at, 'd') . ' Tháng ' . formatDate($created_at, 'm') . ' Năm ' . formatDate($created_at, 'Y') }}</div>
    </div>
    <hr style="margin-bottom: 1rem;">
    <div style="margin-bottom: 1rem;">
        <div">Họ tên người mua hàng: {{ $name }}</div>
        <div>Tên đơn vị: </div>
        <div>Mã số thuế: </div>
        <div>Số điện thoại: </div>
        <div>Địa chỉ: </div>
        @php($payment_methods  = \Modules\Setting\Models\PaymentConfig::PAYMENT_METHOD)
        <div>Hình thức thanh toán: {{ trans($payment_methods[$payment_method]) }}</div>
    </div>
    <div class="table-responsive" style="margin-bottom: 1rem;">
        <table class="table">
            <tr>
                <th>STT</th>
                <th>Tên hàng hóa, dịch vu</th>
                <th>Đơn vị tính</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>1</th>
                <th>2</th>
                <th>3=1x2</th>
            </tr>
            @foreach($details as $key =>$item)
                @php($item =  (object)$item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>Chiếc</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ currency_format($item->price, '') }}</td>
                    <td>{{ currency_format($item->total_price, '') }}</td>
                </tr>
            @endforeach
            @for($i = 0; $i <= 3; $i++)
                <tr>
                    <td style="color: white">A</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
            <tr>
                <td colspan="6" class="text-center">
                    Cộng tiền hàng: <span class="fw-bold">{{ currency_format($total_price, '') }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Thuế xuất GTGT: <span class="fw-bold">10%</span>
                </td>
                <td colspan="3">
                    Tiền thuế GTGT: <span class="fw-bold">{{ currency_format($total_price*10/100, '') }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-center">
                    Tổng tiền thanh toán: <span class="fw-bold">{{ currency_format($total_price + $total_price*10/100, '') }}</span>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <table style="border: none; width: 100%;">
            <tr style="border: none">
                <td style="border: none">
                    <div class="text-center">
                        <div class="fw-bold">Người mua hàng</div>
                        <div>(Ký, ghi rõ họ tên)</div>
                    </div>
                </td>
                <td style="border: none">
                    <div class="text-center">
                        <div class="fw-bold">Người bán hàng</div>
                        <div>(Ký, ghi rõ họ tên)</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>