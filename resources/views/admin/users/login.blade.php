@extends('admin.users.base')

@section('admin')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>BookShop</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>
                @include('admin.alert')
                <form action="login/store" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name= "email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center">
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-secondary btn-block">Đăng Nhập</button>
                        </div>
                        <!-- /.col -->
                        <div>
                            <a href="/admin/users/register" style="font-style:italic;">Đăng ký</a>
                        </div>

                    </div>
                    @csrf
                </form>

            </div>
        </div>
    </div>
@endsection
