@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Danh mục</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Kích hoạt</th>
                <th>Thời gian cập nhập</th>
                <th style="width: 120px;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            ?>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>
                        <a href="{{ $product->thumb }}" target="_blank">
                            <img src="{{ $product->thumb }}" alt="" height="40px">
                        </a>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price_sale }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a href="/admin/products/edit/{{ $product->id }}" class="btn btn-secondary">
                            <img src="/template/admin/dist/img/edit.png" alt="edit" style="width: 15px;">
                        </a>
                        <a href="#" class="btn btn-dark"
                            onClick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                            <img src="/template/admin/dist/img/remove.png" alt="remove" style="width: 15px;">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $products->links() !!}
    </div>
@endsection
