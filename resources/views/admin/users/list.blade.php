@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Kích hoạt</th>
                <th>Thời gian cập nhập</th>
                <th style="width: 120px;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            ?>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{!! \App\Helpers\Helper::active($user->active) !!}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <a href="/admin/users/edit/{{ $user->id }}" class="btn btn-secondary">
                            <img src="/template/admin/dist/img/edit.png" alt="edit" style="width: 15px;">
                        </a>
                        {{-- <a href="#" class="btn btn-dark"
                            onClick="removeRow({{ $user->id }}, '/admin/users/destroy')">
                            <img src="/template/admin/dist/img/remove.png" alt="remove" style="width: 15px;">
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->links() !!}
@endsection
