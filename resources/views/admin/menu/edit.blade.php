@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <!-- general form elements -->
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" class="form-control" placeholder="Tên danh mục" value="{{ $menu->name }}">
            </div>

            <div class="form-group">
                <label for="parent_id">Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{ $menu->parent_id == 0 ? 'selected' : '' }}>Danh mục cha</option>
                    @foreach ($menus as $menuParent)
                        <option value="{{ $menuParent->id }}" {{ $menu->parent_id == $menuParent->id ? 'selected' : '' }}>
                            {{ $menuParent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control" id='content'>
                    {{ $menu->description }}
                </textarea>
            </div>

            <div class="form-group">
                <label for="active">Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active"
                        checked="" {{ $menu->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active"
                        {{ $menu->active == 0 ? 'checked' : '' }}>
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
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
