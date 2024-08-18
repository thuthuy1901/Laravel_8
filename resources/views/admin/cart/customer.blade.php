@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">STT</th>
                <th>Tên KH</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Ngày đặt</th>
                <th style="width: 120px;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            ?>
            @foreach ($customers as $key => $customer)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>
                        <a href="/admin/customers/view/{{ $customer->id }}" class="btn btn-secondary">
                            <img src="/template/admin/dist/img/see.png" alt="see" style="width: 15px;">
                        </a>
                        {{-- <a href="#" class="btn btn-dark"
                            onClick="removeRow({{ $customer->id }}, '/admin/customers/destroy')">
                            <img src="/template/admin/dist/img/remove.png" alt="remove" style="width: 15px;">
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $customers->links() !!}
    </div>
@endsection
