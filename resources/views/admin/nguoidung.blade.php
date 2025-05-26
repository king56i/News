@extends('admin.dashboard')
@section('content')
<h1>Loại tin</h1>
<div class="container">
    <h2 class="py-2 text-center h2 mt-3">QUẢN LÝ NGƯỜI DÙNG</h2>
    <table class="table table-hover table-bordered">
    <thead  style="background-color: #43dd8b;color:white" >
        <tr>
            <th>Tên Người Dùng</th>
            <th>Email</th>
            <th>vai trò</th>
            <th colspan="2">
            <a class="btn btn-success" href="{{route('admin.tnd')}}">Thêm Mới</a>
            </th>            
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user) 
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->VaiTro}}</td>
                <td style="width:60px"><a href="{{route('admin.snd',$user->id)}}"><button class="btn btn-success">Sửa</button></a></td>
                <td style="width:60px"><button class="btn btn-success">Xóa</button></td>
            </tr>;
        @endforeach
    </tbody>
</table>
</div>

@endsection