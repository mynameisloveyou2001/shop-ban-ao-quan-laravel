@extends('admin.main')
@section('header')
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@endsection
@section('content')
    <form  method="POST" action="{{route('addCategory')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên Danh Mục</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập danh mục">
            </div>

            <div class="form-group">
                <label>Danh Mục</label>
                <select class="form-control" name="parent_id" id="">
                    <option>Danh mục cha</option>
                    @foreach ($categoryList as $item)
                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Mô tả ngắn</label>
                <textarea type="text" name="description" class="form-control" id="description" rows="10" placeholder="Nhập mô tả"></textarea>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea type="text" name="content" class="form-control" id="content" rows="4" placeholder="Chi tiết"></textarea>
            </div>

            <div class="form-group">
                <label for="">Kích hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" value="1" type="radio" name="active" id="active" checked>
                    <label for="active" class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="0" type="radio" name="active">
                    <label for="no_active" class="form-check-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>

    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
