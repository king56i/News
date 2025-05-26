@extends('admin.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Role
                        <a href="{{url('admin/roles/create')}}" class="btn btn-primary float-end">Thêm Role</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tên</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $roles as $role )
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                    <a href="{{url('admin/roles/'.$role->id.'/give-permissions')}}" class="btn btn-success">Thêm / Sửa Quyền Lợi Role</a>
                                    @can('update role')
                                    <a href="{{url('admin/roles/'.$role->id.'/edit')}}" class="btn btn-success">Sửa</a>
                                    @endcan
                                    @can('delete role')
                                        <form action="{{url('admin/roles/'.$role->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger mx-2">Xóa</button>
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