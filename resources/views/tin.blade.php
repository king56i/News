@extends('layouts.app')
@section('content')
@isset($tin)
<div class="container" style="text-align:center">
    <h3><?=$tin->TieuDe?></h3>
    <em><b>Người đăng: <?=$tin->nguoidang->name?></b></em><br>
    <em><?=$tin->NgayDang?></em>
    <p><?=$tin->NoiDung?></p>
</div>
@endisset

<h6><b>Bình luận</b></h6>
    <section class="my-5">
        @auth
        <div id="comment-section" method="POST" action="{{url('binhluan')}}">
            <form id="commentForm">
                @csrf
                <input type="hidden" id="Tinid" value="{{$tin->id}}">
                <textarea id="comment" placeholder="Enter your comment..."></textarea>
                <button type="submit" class="btn btn-success" id="submit">Gửi</button>
            </form>
            <div id="commentsList"></div>
        </div>
        @endauth
    </section>
<h6><b>Đọc thêm</b></h6>
@foreach ($listloai as $loaitin)
    <section class="my-5" style="text-align:center; border-bottom:1px dotted gray">
        <span>{{$loaitin?->TenLoai}}</span>
        <hr>
        @isset($loaitin->tins()->where('status','=',1)->orderBy('created_at','ASC')->get()[0])
        <a style="text-decoration:none" href="{{config('app.url')}}/tin/<?=$loaitin->tins()->where('status','=',1)->orderBy('created_at','ASC')->get()[0]?->id?>">
            <article>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <img src="{{asset($loaitin->tins()->where('status','=',1)->orderBy('created_at','ASC')->get()[0]?->thumbnail)}}"/>
                    </div>
                    <div class="col-12 col-md-9">
                        <h3>{{$loaitin->tins()->where('status','=',1)->orderBy('created_at','ASC')->get()[0]?->TieuDe}}</h3>
                        <p>{{$loaitin->tins()->where('status','=',1)->orderBy('created_at','ASC')->get()[0]?->TomTat}}</p>
                    </div>  
                </div>
            </article>
        </a>
        @endisset
    </section>
@endforeach
@endsection

@section('sidebar')
    <div class="tin-nb col-12">
        <h6><b>Tin liên quan</b></h6>
        <ul class="col-12">
            @foreach ($tin->loaitin->tins()->where('status','=',1)->limit(7)->get() as $t)
            <li>
                <a class="row tin-item" href="{{config('app.url')}}/tin/{{$t->id}}">
                    <div class="col-md-4 col-12 tin-img">
                        <img src="{{asset($t->thumbnail)}}" width="100%" alt="">
                    </div>
                    <div class="col-md-8 col-12">
                        <span class="noi-dung">{{$t->TieuDe}}</span>
                        <p>{{$t->NgayDang}}</p>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @foreach ($listloai as $loaitin)
    <div class="col-12 mt-5 pd-2">
            <h6><b>{{$loaitin -> TenLoai}}</b></h6>
            <ul class="col-12">
                @if($loaitin->tins()->where('status','=',1)->get()->isNotEmpty())
                    @isset($loaitin->tins()->where('status','=',1)->get()[0])
                        <li>
                            <a class="row tin-item" href="{{config('app.url')}}/tin/{{$loaitin->tins()->where('status','=',1)->get()[0]?->id}}">
                                <div class="col-12 tin-img">
                                    <img src="{{asset($loaitin->tins()->where('status','=',1)->get()[0]?->thumbnail)}}" width="100%" alt="">
                                </div>
                                <div class="col-12">
                                    <span class="noi-dung">{{$loaitin->tins()->where('status','=',1)->get()[0]?->TieuDe}}</span>
                                    <p>{{$loaitin->tins()->where('status','=',1)->get()[0]?->NgayDang}}</p>
                                </div>
                            </a>
                        </li>
                    @endisset
                    @if(count($loaitin->tins()->where('status','=',1)->get())>=2)
                        @for ($i=1;$i<min(3,count($loaitin->tins()->where('status','=',1)->get()));$i++)
                            <li>
                                <a class="row tin-item" href="{{config('app.url')}}/tin/{{$loaitin->tins()->where('status','=',1)->get()[$i]?->id}}">
                                    <div class="col-12">
                                        <span class="noi-dung">{{$loaitin->tins()->where('status','=',1)->get()[$i]?->TieuDe}}</span>
                                        <p>{{$loaitin->tins()->where('status','=',1)->get()[$i]?->NgayDang}}</p>
                                    </div>
                                </a>
                            </li>
                        @endfor
                    @endif
                    <a href="{{route('loaitin.ref',['loaitinSlug'=>'the-gioi'])}}"><button class="xem-them">Xem Thêm</button></a>
                @endif
            </ul>
        </div>
    @endforeach
    <script type="module">
    const commentUrl = "{{ url('binhluan') }}";
    document.getElementById("commentForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Ngừng hành động mặc định của form (reload trang)
    
    const Tinid = document.getElementById('Tinid').value;
    const comment = document.getElementById("comment").value;
    if (comment.trim() === '') {
        alert("Please enter a comment.");
        return;
    }

    // Tạo FormData để gửi dữ liệu
    const formData = new FormData();
    formData.append('comment', comment);
    formData.append('Tinid', Tinid);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    // Gửi yêu cầu POST đến controller
    fetch(commentUrl, {  
    method: 'POST',
    body: formData
})
.then(response => {
    console.log('Response Status:', response.status);
    return response.text();  // Chuyển phản hồi thành text để kiểm tra
})
.then(text => {
    console.log('Response Text:', text);  // Xem phản hồi thực tế
    try {
        const data = JSON.parse(text);  // Thử parse JSON nếu có thể
        updateComment();
        console.log(data);
    } catch (error) {
        console.error('Error parsing JSON:', error);
        alert('Error: Response is not JSON');
    }
})
.catch(error => {
    console.error('Error submitting comment:', error);
    alert('Error submitting comment.');
});
});
const deleteComment = (commentId) => {
    axios.delete(`/binhluan/${commentId}`)
        .then(response => {
            if (response.data.success) {
                // Xóa bình luận khỏi UI (cập nhật lại danh sách bình luận)
                alert('Bình luận đã được xóa');
                updateComment();
                // Cập nhật lại danh sách bình luận nếu cần
            }
        })
        .catch(error => {
            console.error("Có lỗi khi xóa bình luận: ", error);
            alert('Không thể xóa bình luận. Vui lòng thử lại.');
        });
}
const updateComment = (e)=>{
    const Tinid = document.getElementById('Tinid').value;
    console.log(Tinid);
    fetch(`{{ url('binhluan')}}/${Tinid} `)
    .then(response => response.json())
    .then(data => {
        const commentsList = document.getElementById('commentsList');
        commentsList.innerHTML = ''; // Xóa danh sách cũ
        data.comments.forEach(comment => {
            console.log(comment);
            const commentDiv = document.createElement('div');
            commentDiv.classList.add('nd-cmt');
            commentDiv.innerHTML =  `<em>${comment.created_at}</em><br><p>${comment.nguoibinhluan.name}: ${comment.NoiDung}</p>
            <button class="xoa-cmt btn btn-danger" data-comment-id="${comment.id}">Xóa</button>`;
            commentsList.appendChild(commentDiv);
        });
        const deleteButtons = document.querySelectorAll('.xoa-cmt');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    if (commentId) {
                        deleteComment(commentId); // Gọi hàm xóa bình luận
                    } else {
                        console.error('Không tìm thấy comment ID');
                    }
                });
            });
    })
    .catch(error => {
        console.error('Lỗi khi tải danh sách bình luận:', error);
    });
}
// document.getElementsByClassName('xoa-cmt',deleteComment(this.getAttribute('data-comment-id')))
window.addEventListener('load',updateComment);

// }
</script>
@endsection
