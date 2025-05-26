@extends('admin.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Bài viết
                        <a href="{{url('admin/loai/create')}}" class="btn btn-primary float-end">Thêm Loại Tin</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tên Loại</th>
                                <th>Ẩn Hiện</th>
                                <th>slug</th>
                                <th>Mô Tả</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $listloai as $loai )
                                <tr>
                                    <td>{{$loai->TenLoai}}</td>
                                    <td>{{$loai->AnHien==1?'Có':'Không'}}</td>
                                    <td>{{$loai->slug}}</td>
                                    <td>{{$loai->MoTa}}</td>
                                    <td>
                                        @can('update loai')
                                        <a href="{{url('admin/loai/'.$loai->idLT.'/edit')}}" class="btn btn-success">Sửa</a>
                                        @endcan
                                        @can('delete loai')
                                        <form style="display:inline-block;margin:0" action="{{url('admin/loai/'.$loai->idLT.'/delete')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" >Xóa</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
