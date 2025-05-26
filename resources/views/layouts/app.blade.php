
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>King - Lều báo uy tín nhất Việt Nam !!</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>

    <!-- Template Stylesheet -->
    <link href="{{asset('css/what-news.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('scss/app2.scss')}}" rel="stylesheet">
    <link href="{{asset('scss/app.scss')}}" rel="stylesheet">
    @stack('scripts')
    @stack('styles')
</head>
<body>
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <header>

        <div class="container-fluid bg-dark p-0">
            <div class="row gx-0 d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center me-4">
                        <small class="fa fa-map-marker-alt text-primary me-2"></small>
                        <small>80 Nguyễn Phước Chu, Việt Nam</small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center">
                        <small class="far fa-clock text-primary me-2"></small>
                        <small>Thứ 2 - Thứ 6 : 09.00 Sáng - 09.00 Tối</small>
                    </div>
                </div>
                <div class="col-lg-5 px-5 text-end">
                    <div class="h-100 d-inline-flex align-items-center me-4">
                        <small class="fa fa-phone-alt text-primary me-2"></small>
                        <small>+084 775 458 412</small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center mx-n2">
                        <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-square btn-link rounded-0" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->
    
    
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
            <a href="/" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
                <h2 class="m-0 text-primary">King</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/" class="nav-item nav-link active">Trang chủ</a>
                    <a href="" class="nav-item nav-link">Về chúng tôi</a>
                    @foreach ($listloai as $loaitin)
                    <a href="{{config('app.url')}}/loai/{{$loaitin->slug}}" class="nav-item nav-link">{{$loaitin->TenLoai}}</a>
                    @endforeach
                    @guest
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trang</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="{{config('app.url')}}/login" class="dropdown-item">Đăng nhập</a>
                            <a href="{{config('app.url')}}/register" class="dropdown-item">Đăng ký</a>
                        </div>
                    </div>
                    @else
                    <div class="nav-item dropdown">
                        <a class="nav-link btn btn-info dropdown-toggle rounded-0 py-4 px-lg-2 d-none d-lg-block" type="button" data-bs-toggle="dropdown">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- <a href="{{url('/thong-tin-nd/'.Auth::user()->id.'')}}">Tài khoản</a> -->
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit()">Đăng xuất</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endguest
                </div>
                @guest
                @else
                @role('super-admin|admin')
                <a href="/admin" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Quản lý<i class="fa fa-arrow-right ms-3"></i></a>
                @endrole
                @role('journalist')
                <a href="/journalist/bai-viet" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Quản lý tin<i class="fa fa-arrow-right ms-3"></i></a>
                @endrole
                @endguest
            </div>
        </nav>
    </header>
    <main class="container-fluid my-4">
        <div class="row">
            <div class="col-lg-9">
                @yield ('content')
            </div>
            <div class="col-lg-3" id="sidebar">
                @yield ('sidebar')
            </div>

        </div>
    </main>
    <footer style="margin-top:auto" id="footer">
        <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Địa chỉ</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>80 Nguyễn Phước Chu, Đà Nẵng, Việt Nam</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+084 775 458 412</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>kinglnhpd09634@fpt.edu.vn</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-square btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Links</h5>
                        <a class="btn btn-link" href="">Về chúng tôi</a>
                        @foreach ($listloai as $loaitin)
                            <a href="{{config('app.url')}}/{{$loaitin->slug}}" class="nav-item nav-link">{{$loaitin->TenLoai}}</a>
                        @endforeach
                    </div>
                    @if(count($tintuc)>0)
                    <div class="col-lg-6 col-md-6">
                        <h5 class="text-white mb-4">Tin mới nhất</h5>
                        <div class="row g-2">
                            @for ($i=0;$i<min(5,count($tintuc));$i++)
                            <div class="col-6">
                                <img class="img-fluid rounded" width="150px" src="{{$tintuc[$i]?->thumbnail}}" alt="">
                            </div>
                            <div class="col-6">
                                <p><a href="{{config('app.url')}}/tin/{{$tintuc[$i]?->id}}">{{$tintuc[$i]?->TieuDe}}</a></p>
                            </div>
                            @endfor
                           
                        </div>
                    </div>
                    @endif
                    <!-- <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>