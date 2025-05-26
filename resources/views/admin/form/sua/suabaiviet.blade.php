
@extends('admin.dashboard')
@section('content')
<div class="container position-static" style="height:80vh;">
      <!-- Tab panes -->
      <div class="tab-content">
            <div class="tab-pane active" id="">  
                  &nbsp;       
                  <div class="container col-8 m-auto">
                  <h2 class="py-2 text-center h4 ">Bài viết</h2>
                  <form action="{{url('admin/bai-viet/'.$tin->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-line active my-2">
                              <label for="TieuDe">Tiêu đề:</label>
                              <input type="text" name="TieuDe" id="TieuDe" value="{{old('TieuDe',$tin->TieuDe)}}" class="form-control">
                        </div>
                        @error('TieuDe')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <div class="form-line active my-2">
                              <label for="thumbnail">Ảnh thumbnail:</label>
                              <input type="file" name="thumbnail" id="thumbnail" value="{{old('thumbnail',$tin->thumbnail)}}" class="form-control">
                        </div>
                        @error('thumbnail')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <div class="form-line active my-2">
                              <label for="TomTat">Tóm Tắt:</label>
                              <input type="text" name="TomTat" id="TomTat" value="{{old('TomTat',$tin->TomTat)}}" class="form-control">
                        </div>
                        @error('TomTat')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <div class="form-line active my-2">
                              <label for="NoiDung">Nội Dung:</label>
                              <textarea name="NoiDung" id="NoiDung" class="form-control" height="300px" style="overflow:scroll">{{old('NoiDung',$tin->NoiDung)}}</textarea>
                        </div>
                        @error('NoiDung')
                        <p class="error-message">{{$message}}</p>
                        @enderror

                        <div class="form-line mt-2">
                              <label style="min-width:10px">Nổi Bật:</label>
                              <input type="radio" name="NoiBat" value="0" {{old('NoiBat',$tin->NoiBat)==0 ? 'checked':''}}> Không
                              <input type="radio" name="NoiBat" value="1" {{old('NoiBat',$tin->NoiBat)==1 ? 'checked':''}}> Có&nbsp; &nbsp;        
                        </div>
                        @error('NoiBat')
                        <p class="error-message">{{$message}}</p>
                        @enderror
                        <div class="form-line active my-2">
                              <label for="idLT">Loại tin:</label>
                              <select name="idLT" id="idLT">
                                    @foreach ($listloai as $loaitin)
                                          <option value="{{$loaitin->idLT}}" {{old('idLT',$tin->idLT)==$loaitin->idLT ? 'selected':''}}>{{$loaitin->TenLoai}}</option>
                                    @endforeach
                              </select>
                        </div>
                        <button class="btn btn-success px-3 mt-3" name="submit">Thêm</button>
                  </form>
                  </div>
            </div> <!-- tab-pane-->
      </div>
</div>
@endsection
