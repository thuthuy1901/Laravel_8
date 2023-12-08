@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">STT</th>
                <th>Tiêu đề</th>
                <th>Url</th>
                <th>Ảnh</th>
                <th>Kích hoạt</th>
                <th>Thời gian cập nhập</th>
                <th style="width: 120px;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            ?>
            @foreach ($sliders as $key => $slider)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->url }}</td>
                    <td>
                        <a href="{{ $slider->thumb }}" target="_blank">
                            <img src="{{ $slider->thumb }}" alt="" height="40px">
                        </a>
                    </td>
                    <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                    <td>{{ $slider->updated_at }}</td>
                    <td>
                        <a href="/admin/sliders/edit/{{ $slider->id }}" class="btn btn-secondary">
                            <img src="/template/admin/dist/img/edit.png" alt="edit" style="width: 15px;">
                        </a>
                        <a href="#" class="btn btn-dark"
                            onClick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                            <img src="/template/admin/dist/img/remove.png" alt="remove" style="width: 15px;">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $sliders->links() !!}
@endsection
