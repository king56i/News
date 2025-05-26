@extends('admin.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Bài viết
                        <a href="{{url('admin/bai-viet/create')}}" class="btn btn-primary float-end">Thêm Tin</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Thumbnail</th>
                                <th>Tóm tắt</th>
                                <th>Nội dung</th>
                                <th>Lượt xem</th>
                                <th>Nổi bật</th>
                                <th>Người đăng</th>
                                <th>Loại tin</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @role('super-admin|admin')
                            @foreach ( $tins as $tin )
                                <tr>
                                    <td>{{$tin->TieuDe}}</td>
                                    <td><img height="50px" src="{{asset($tin->thumbnail)}}" alt=""></td>
                                    <td class="noi-dung" width="50px !important">{{$tin->TomTat}}</td>
                                    <td class="noi-dung">{{$tin->NoiDung}}</td>
                                    <td>{{$tin->Xem}}</td>
                                    <td>{{$tin->NoiBat==1?'Có':'Không'}}</td>
                                    <td>{{$tin->nguoidang->email}}</td>
                                    <td>{{$tin->TenLoai}}</td>
                                    <td>
                                        @if ($tin->status==1)
                                        Đã duyệt
                                        @else
                                        <form action="{{route('baiviet.duyet',$tin?->id)}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success">Duyệt</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        @can('update tin')
                                        <a style="display: block;width:100%" href="{{url('admin/bai-viet/'.$tin->id.'/edit')}}" class="btn btn-success mb-2">Sửa</a>
                                        @endcan
                                        @can('delete tin')
                                        <form style="display: block;width:100%;margin:0" action="{{url('admin/bai-viet/'.$tin->id.'/delete')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Xóa</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            @endrole
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection