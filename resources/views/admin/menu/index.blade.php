@extends('admin.main')
@section('content')
@include('admin.error')
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Danh mục</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {!! \App\helpers\Helper::menu($categoryList) !!}
    </tbody>
@endsection

@section('footer')
@endsection
