@extends('admin.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Bình luận
                        <a href="{{url('admin/bai-viet/create')}}" class="btn btn-primary float-end">Thêm bình luận</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Người bình luận</th>
                                <th>Tin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @role('super-admin|admin')
                            @foreach ( $binhluan as $bl )
                                <tr>
                                    <td class="noi-dung">{{$bl->NoiDung}}</td>
                                    <td>{{$bl->created_at}}</td>
                                    <td>{{$bl->nguoibinhluan->email}}</td>
                                    <td>{{$bl->tintuc->TieuDe}}</td>
                                    
                                    <td>
                                        @can('delete binhluan')
                                        <form style="display: block;width:100%;margin:0" action="{{url('admin/binhluan/'.$bl->id.'/delete')}}" method="POST">
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