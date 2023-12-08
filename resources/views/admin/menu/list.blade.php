@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">STT</th>
                <th>Tên danh mục</th>
                <th>Kích hoạt</th>
                <th>Thời gian cập nhập</th>
                <th style="width: 120px;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            {!! App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>
@endsection
