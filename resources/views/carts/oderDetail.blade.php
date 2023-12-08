@extends('carts.order')
@section('order')
    <div class="customer mt-3 ml-3">
        <h5>Thông tin KH</h5>
        <ul>
            <li>Tên KH: <strong>{{ $customer->name }}</strong></li>
            <li>SĐT: <strong>{{ $customer->phone }}</strong></li>
            <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
            <li>Email: <strong>{{ $customer->email }}</strong></li>
            <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
        </ul>
    </div>
    <div class="carts ">
        @php $total=0; @endphp
        <table class="table">
            <tbody>
                <tr class="table_head">
                    <th class="column-1">Ảnh</th>
                    <th class="column-2">Sản phẩm</th>
                    <th class="column-3">Giá</th>
                    <th class="column-4">Số lượng</th>
                    <th class="column-5">Thành tiền</th>
                    <th class="column-6"></th>
                </tr>

                @foreach ($orders as $key => $cart)
                    @php
                        $price = $cart->price * $cart->qty;
                        $total += $price;
                    @endphp
                    <tr class="table_row">
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="{{ $cart->product->thumb }}" alt="IMG" width="40px">
                            </div>
                        </td>
                        <td class="column-2">
                            {{ $cart->product->name }}
                        </td>
                        <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
                        <td class="column-4">{{ $cart->qty }}</td>
                        <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>

                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Tổng tiền: </td>
                    <td style="font-weight: bold;">{{ number_format($total, 0, '', '.') }}</td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
