@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User
                        <a href="{{url('admin/users')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/users/'.$user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" value="{{old('name',$user->name)}}" name="name" class="form-control"/>
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="text" value="{{old('email',$user->email)}}" name="email" class="form-control"/>
                            </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" value="{{old('password')}}" name="password" class="form-control"/>
                            @error('password') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" class="form-control" multiple>
                                <option value="#">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{$role}}" {{in_array($role,$userRoles) ? 'selected' : ''}}>{{$role}}</option>
                                @endforeach
                            </select>
                            @error('roles') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection