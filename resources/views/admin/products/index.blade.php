@extends('admin.main')
@section('content')
@include('admin.error')
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Sản phẩm </th>
            <th>Danh mục</th>
            <th>Giá gốc</th>
            <th>Giá bán</th>
            <th>Active</th>
            <th colspan="2">Hành động</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $value)
            
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->menu->name}}</td>
            <td>{{$value->price}}</td>
            <td>{{$value->price_sale}}</td>
            {{-- <td>
                {!!\App\helpers\Helper::active($value->active)!!}</td> --}}
            <td>
                @if ($value['active']==1)
                <a href="{{url("admin/products/editActive/".$value["id"])}}">
                    hoạt động
             </a>
                @endif
                @if ($value['active']==0)
                <a href="{{url("admin/products/editActive/".$value["id"])}}">
                    Ngưng bán
             </a>
                @endif
            </td>
            <td>
            <a href="{{url('admin/products/edit/'.$value->id)}}", class="btn btn-primary btn-sm">
            <i class="fas fa-edit"></i></a>
            <a href="" onclick="removeRow({{ $value->id }},'delete')" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i></a>
        </td>
        @endforeach
    </tbody>
</table>

{{-- {!! $products->link()!!} --}}

@endsection

@section('footer')
@endsection
