
@extends('admin.dashboard')
@section('content')
<div class="container position-static" style="height:80vh;margin-top:20%">
      <!-- Tab panes -->
      <div class="tab-content">
            <div class="tab-pane active" id="">  
                  &nbsp;       
                  <div class="container col-8 m-auto">
                  <h2 class="py-2 text-center h4 ">Loại</h2>
                  <form action="{{url('admin/loai')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-line active">
                              <label for="TenLoai">Tên loại:</label>
                              <input type="text" name="TenLoai" id="TenLoai" value="{{old('TenLoai')}}" class="form-control">
                        </div>
                        @error('TenLoai')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <div class="form-line mt-2">
                              <label style="min-width:10px">Ẩn Hiện:</label>
                              <input type="radio" name="AnHien" value="0" checked> Ẩn
                              <input type="radio" name="AnHien" value="1"> hiện&nbsp; &nbsp;        
                        </div>
                        @error('AnHien')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <div class="form-line">
                              <label for="MoTa">Mô tả:</label>
                              <input type="text" name="MoTa" id="MoTa" value="{{old('MoTa')}}" class="form-control">
                        </div>
                        @error('MoTa')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <button class="btn btn-success px-3 mt-3" name="submit">Lưu</button>
                  </form>
                  </div>
            </div> <!-- tab-pane-->
      </div>
</div>
@endsection
