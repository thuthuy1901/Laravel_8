@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <!-- general form elements -->
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Tên user" value="{{ $user->name }}">
            </div>

            <div class="form-group" style="display: none;">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
            </div>

            <div class="form-group" style="display: none;">
                <label>Email</label>
                <input type="text" name="password" class="form-control" placeholder="password"
                    value="{{ $user->password }}">
            </div>

            <div class="form-group">
                <label for="active">Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active"
                        checked="" {{ $user->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active"
                        {{ $user->active == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-secondary">Cập nhập</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
@endsection
