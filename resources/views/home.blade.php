@extends('layouts.app')
@section('content')
    <!-- Feature Start -->
    <section class="whats-news-area pt-50 gray-bg">

      <div class="container-xxl">
        <div class="container">
          <div class="row g-5">
  
            <div class="col-lg-12">
              <div class="whats-news-wrapper">
                  <!-- Heading & Nav Button -->
                  <div class="row justify-content-between align-items-end mb-15">
                      <div class="col-xl-4">
                          <div class="section-tittle mb-30">
                              <h3>Tin mới</h3>
                          </div>
                      </div>
                      <div class="col-xl-8 col-md-9">
                          <div class="properties__button">
                              <!--Nav Button  -->                                            
                              <nav>                                                 
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                      <a class="nav-item nav-link active" id="chinh-tri-tab" data-toggle="tab" href="#chinh-tri" role="tab" aria-controls="chinh-tri" aria-selected="true">Chính trị</a>
                                      @for ( $i=1;$i<$listloai->count();$i++ )
                                      <a class="nav-item nav-link" id="{{$listloai[$i]->slug}}-tab" data-toggle="tab" href="#{{$listloai[$i]->slug}}" role="tab" aria-controls="{{$listloai[$i]->slug}}" aria-selected="false">{{$listloai[$i]->TenLoai}}</a>
                                      @endfor
                                  </div>
                              </nav>
                              <!--End Nav Button  -->
                          </div>
                      </div>
                  </div>
                  <!-- Tab content -->
                @isset($listloai)
                  <div class="row">
                      <div class="col-12">
                          <!-- Nav Card -->
                          <div class="tab-content" id="nav-tabContent">
                              <!-- card one -->
                               @foreach ( $listloai as $loaitin )
                                @php
                                    $tin = $loaitin->tins()->where('status','=',1)->get();
                                @endphp
                                @isset($tin)
                               <div class="tab-pane fade show {{$loaitin->slug=='chinh-tri'? 'active':''}}" id="{{$loaitin?->slug}}" role="tabpanel" aria-labelledby="{{$loaitin?->slug}}-tab">       
                                   <div class="row">
                                       <!-- Left Details Caption -->
                                       @isset($tin[0])
                                       <div class="col-xl-6 col-lg-12">
                                           <div class="whats-news-single mb-40 mb-40">
                                               <div class="whates-img">
                                                   <img src="{{asset($tin[0]?->thumbnail)}}" alt="">
                                               </div>
                                               <div class="whates-caption">
                                                   <h4><a href="{{url('/tin/'.$tin[0]?->id)}}">{{$tin[0]?->TieuDe}}</a></h4>
                                                   <span>bởi: Lê Nguyễn Hoàng King | {{$tin[0]?->NgayDang}}</span>
                                                   <p>{{$tin[0]?->TomTat}}</p>
                                               </div>
                                           </div>
                                       </div>
                                       @endisset
                                        @if(count($tin)>=2)

                                       <div class="col-xl-6 col-lg-12">
                                           <div class="row">
                                             @for ($i=1;$i<min(5,count($tin));$i++)
                                               <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                   <div class="whats-right-single mb-20">
                                                       <div class="whats-right-img">
                                                           <img src="{{asset($tin[$i]?->thumbnail)}}" alt="">
                                                       </div>
                                                       <div class="whats-right-cap">
                                                           <span class="colorb">{{$tin[$i]?->TenLoai}}</span>
                                                           <h4><a href="{{url('/tin/'.$tin[$i]?->id)}}">{{$tin[$i]?->TieuDe}}</a></h4>
                                                           <p>{{$tin[$i]?->NgayDang}}</p> 
                                                       </div>
                                                   </div>
                                               </div>
                                             
                                             @endfor
                                               
                                           </div>
                                       </div>
                                        @endif
                                   </div>
                               </div>
                               @endisset
                               @endforeach
                              
                          </div>
                      <!-- End Nav Card -->
                      </div>
                  </div>
                @endisset
              </div>

              <div class="banner-one mt-20 mb-30">
                  <img src="{{asset('images/banner.jpeg')}}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @isset($tin24h) 
    <div class="weekly2-news-area pb-30">
        <div class="container">
            <div class="weekly2-wrapper">
                <div class="slider-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="small-tittle mb-30">
                                <h4>Tin 24H</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row col-12">
                        @for ($i = 0;$i<min(4,count($tin24h));$i++)
                            <div class="weekly2-single col-md-3 col-6" max-height="230px" style="margin:0">

                                <a href="{{route('chitiettin',$tin24h[$i]->id)}}">
                                    <div class="weekly2-img"><img src="{{asset($tin24h[$i]?->thumbnail)}}" alt=""></div>
                                    <div class="weekly2-caption">
                                        <h6>{{$tin24h[$i]?->TieuDe}}</h6>
                                    </div>
                                </a>
                            </div>
                        @endfor
                        </div>
                        @if(count($tin24h)>4)
                        <hr>
                        <div class="row">
                        @for ($i = 4;$i<count($tin24h);$i++)
                        <div class="weekly2-single col-md-3 col-6" max-height="230px" style="margin:0">
                            <a href="{{route('chitiettin',$tin24h[$i]->id)}}">
                                <div class="weekly2-img"><img src="{{asset($tin24h[$i]?->thumbnail)}}" alt=""></div>
                                <div class="weekly2-caption">
                                    <h6>{{$tin24h[$i]?->TieuDe}}</h6>
                                </div>
                            </a>
                        </div>
                        @endfor
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @isset($tinNB)
    <div class="weekly2-news-area pb-30">
        <div class="container">
            <div class="weekly2-wrapper">
                <div class="slider-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="small-tittle mb-30">
                                <h4>Tin nổi bật</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="weekly2-news-active d-flex">
                                @foreach ($tinNB as $tin)
                                    <div class="weekly2-single col-lg-3 col-12">
                                        <div class="weekly2-img">
                                            <img src="{{asset($tin->thumbnail)}}" alt="">
                                        </div>
                                        <div class="weekly2-caption">
                                            <h4><a href="{{config('app.url')}}/tin/{{$tin->id}}">{{$tin->TieuDe}}</a></h4>
                                            <p>Lê Nguyễn Hoàng King | {{$tin->NgayDang}}</p>
                                        </div>
                                    </div> 
                                
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @isset($listloai)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Các loại tin</h6>
                <h1 class="mb-4">Khám phá nhiều tin mới với các thể loại khác nhau</h1>
            </div>
            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-5" id="portfolio-filters">
                        <li class="mx-2 active" data-filter="*">All</li>
                        @foreach ($listloai as $loaitin)
                        <li class="mx-2" data-filter=".{{$loaitin->slug}}">{{$loaitin->TenLoai}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row g-5 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
                @foreach ( $listloai as $loaitin )
                    @php
                    $tins = $loaitin->tins()->where('status','=',1)->get();
                    @endphp
                    @isset($tins)
                        @foreach ($tins as $tin)
                        
                        <div class="col-lg-4 col-md-6 portfolio-item {{$loaitin->slug}}">
                            <div class="portfolio-img rounded overflow-hidden">
                                <img class="img-fluid" src="{{asset($tin->thumbnail)}}" alt="">
                                <div class="portfolio-btn">
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{asset($tin->thumbnail)}}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{config('app.url')}}/tin/{{$tin->id}}"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="pt-3">
                                <p class="text-primary mb-0">{{$tin->TieuDe}}</p>
                                <hr class="text-primary w-25 my-2">
                                <h5 class="lh-base">{{$tin->TomTat}}</h5>
                            </div>
                        </div>
                        
                        @endforeach
                    @endisset
                @endforeach
            </div>
        </div>
    </div>
    @endisset
    @isset($tintuc)
    <div class="weekly3-news-area pt-80 pb-130">
        <div class="container">
            <div class="weekly3-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="small-tittle mb-30">
                                        <h4>Tin Mới Nhất</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly3-news-active dot-style d-flex">
                                        @foreach ($tintuc as $tin)
                                        <div class="weekly3-single col-lg-4 col-12">
                                            <div class="weekly3-img">
                                                <img src="{{asset($tin->thumbnail)}}" alt="">
                                            </div>
                                            <div class="weekly3-caption">
                                                <h4><a href="{{config('app.url')}}/tin/{{$tin->id}}">{{$tin->TieuDe}}</a></h4>
                                                <p>{{$tin->NgayDang}}</p>
                                            </div>
                                        </div> 
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    

    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{asset('/images/tin-chuan.jpg')}}" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <h6 class="text-primary">Về chúng tôi</h6>
                        <h1 class="mb-4">25+ năm kinh nghiệm trong nghề nhà báo</h1>
                        <p>Đằng sau mỗi bài viết trên trang Báo vương là một đội ngũ biên tập viên đầy nhiệt huyết và luôn thiếu khả năng nhét chữ, chế biến thông tin. Nói không với fake news !!!</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Tin chuẩn 100%</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Trust me bro</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Những thông tin đều phải qua kiểm duyệt gay gắt !</p>
                        <a href="" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Hình ảnh</h6>
                <h1 class="mb-4">Thư viện ảnh</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                    <div class="position-relative">
                        <img class="img-fluid mx-auto mb-5" src="https://vcdn1-vnexpress.vnecdn.net/2024/11/15/DJI-0133-JPG-1731631255.jpg?w=900&h=540&q=100&dpr=1&fit=crop&s=XYZ3tBc4dfloZgrmie4jKQ">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Chợ nổi Long Xuyên họp trên sông Hậu, vẫn giữ tập quán mua bán trên sông cùng nếp sống bình dị, dù không nhộn nhịp như trước.</p>
                        <h5 class="mb-1">Hồn quê trên chợ nổi Long Xuyên</h5>
                        <span class="fst-italic">Du lịch</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="position-relative">
                        <img class="img-fluid mx-auto mb-5" src="https://vcdn1-dulich.vnecdn.net/2024/11/17/huy-3852-1731845496-1731845509-1731847514-1731849136.jpg?w=900&h=540&q=100&dpr=1&fit=crop&s=RcULzmWr33VgXVdgqul1Dw">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Khoảng 400 người trong trang phục cổ Việt Nam diễu hành trên phố cổ Hà Nội thu hút sự quan tâm từ du khách trong lẫn ngoài nước, chiều 17/11.</p>
                        <h5 class="mb-1">Hàng trăm người diễu hành cổ phục trên phố đi bộ Hà Nội</h5>
                        <span class="fst-italic">Du lịch</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="position-relative">
                        <img class="img-fluid mx-auto mb-5" src="https://vcdn1-vnexpress.vnecdn.net/2024/11/16/dsc05414-jpg-1731759529-1731767315.jpg?w=900&h=540&q=100&dpr=1&fit=crop&s=Sds2rbO_nzrL3R1HETwiig">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Nhóm lao động ngâm mình nhiều giờ dưới nước để cắt năn - loại cỏ mọc tự nhiên trên các cánh đồng trũng phèn ở huyện Tháp Mười, thu nhập 300.000 đồng mỗi ngày.</p>
                        <h5 class="mb-1">Ngâm mình cắt cỏ năn trên cánh đồng miền Tây</h5>
                        <span class="fst-italic">Du lịch</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
   
    @section('sidebar',)
        <div class="tin-nb col-12">
            <h6><b>Tin nổi bật</b></h6>
            <ul class="col-12">
                @foreach ($tinNB as $tin)
                <li>
                    <a class="row tin-item" href="{{config('app.url')}}/tin/{{$tin->id}}">
                        <div class="col-md-4 col-12 tin-img">
                            <img src="{{asset($tin->thumbnail)}}" width="100%" alt="">
                        </div>
                        <div class="col-md-8 col-12">
                            <span class="noi-dung">{{$tin->TieuDe}}</span>
                            <p>{{$tin->NgayDang}}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-12 mt-5 pd-2">
            <h6><b>Thời sự</b></h6>
            <ul class="col-12">
                @isset($thoiSu)
                    @isset($thoiSu[0])
                        <li>
                            <a class="row tin-item" href="{{config('app.url')}}/tin/{{$thoiSu[0]?->id}}">
                                <div class="col-12 tin-img">
                                    <img src="{{asset($thoiSu[0]?->thumbnail)}}" width="100%" alt="">
                                </div>
                                <div class="col-12">
                                    <span class="noi-dung">{{$thoiSu[0]?->TieuDe}}</span>
                                    <p>{{$thoiSu[0]?->NgayDang}}</p>
                                </div>
                            </a>
                        </li>
                    @endisset
                    @if(count($thoiSu)>=2)
                        @for ($i=1;$i<min(4,count($thoiSu));$i++)
                            <li>
                                <a class="row tin-item" href="{{config('app.url')}}/tin/{{$thoiSu[$i]?->id}}">
                                    <div class="col-md-4 col-12 tin-img">
                                        <img src="{{asset($thoiSu[$i]?->thumbnail)}}" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <span class="noi-dung">{{$thoiSu[$i]?->TieuDe}}</span>
                                        <p>{{$thoiSu[$i]?->NgayDang}}</p>
                                    </div>
                                </a>

                            </li>
                        @endfor
                    @endif
                    <a href="{{route('loaitin.ref',['loaitinSlug'=>'thoi-su'])}}"><button class="xem-them">Xem Thêm</button></a>
                @endisset
            </ul>
        </div>
        <div class="col-12 mt-5 pd-2">
            <h6><b>Thế giới</b></h6>
            <ul class="col-12">
                @isset($theGioi)
                    @isset($theGioi[0])
                        <li>
                            <a class="row tin-item" href="{{config('app.url')}}/tin/{{$theGioi[0]?->id}}">
                                <div class="col-12 tin-img">
                                    <img src="{{asset($theGioi[0]?->thumbnail)}}" width="100%" alt="">
                                </div>
                                <div class="col-12">
                                    <span class="noi-dung">{{$theGioi[0]?->TieuDe}}</span>
                                    <p>{{$theGioi[0]?->NgayDang}}</p>
                                </div>
                            </a>
                        </li>
                    @endisset
                    @if(count($theGioi)>=2)
                        @for ($i=1;$i<min(4,count($theGioi));$i++)
                            <li>
                                <a class="row tin-item" href="{{config('app.url')}}/tin/{{$theGioi[$i]?->id}}">
                                    <div class="col-md-4 col-12 tin-img">
                                        <img src="{{asset($theGioi[$i]?->thumbnail)}}" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <span class="noi-dung">{{$theGioi[$i]?->TieuDe}}</span>
                                        <p>{{$theGioi[$i]?->NgayDang}}</p>
                                    </div>
                                </a>
                            </li>
                        @endfor
                    @endif
                    <a href="{{route('loaitin.ref',['loaitinSlug'=>'the-gioi'])}}"><button class="xem-them">Xem Thêm</button></a>
                @endisset
            </ul>
        </div>
        <div class="col-12 mt-5 pd-2">
            <div class="nav nav-tabs hop-tab" role="tablist">
                <a class="nav-item nav-link active" id="tin-moi-tab" href="#tin-moi" data-toggle="tab" role="tab" aria-controls="tin-moi" aria-selected="true">Tin mới</a>
                <a class="nav-item nav-link" id="most-view-tab" href="#most-view" data-toggle="tab" role="tab" aria-controls="most-view" aria-selected="false">Nhiều lượt Xem</a>
            </div>
            <div class="tab-content row">
                @isset($tintuc)
                <div class="col-12 tab-pane fade show active" id="tin-moi" role="tabpanel" aria-labelledby="tin-moi-tab">
                    <ul class="hop-content">
                        @for ($i=0;$i<min(15,count($tintuc));$i++)
                        <li><a href="{{route('chitiettin',$tintuc[$i]?->id)}}">{{$tintuc[$i]?->TieuDe}}</a></li>
                        @endfor
                    </ul>
                    <a href="{{route('tinmoi')}}"><button class="xem-them">Xem Thêm</button></a>
                </div>
                @endisset
                @isset($tinXN)
                <div class="col-12 tab-pane fade" id="most-view" role="tabpanel" aria-labelledby="most-view-tab">
                    <ul class="hop-content">
                        @for ($i=0;$i<min(15,count($tinXN));$i++)
                        <li><a href="{{route('chitiettin',$tinXN[$i]?->id)}}">{{$tinXN[$i]?->TieuDe}}</a></li>
                        @endfor
                    </ul>
                </div>
                @endisset
            </div>
        </div>

    @endsection