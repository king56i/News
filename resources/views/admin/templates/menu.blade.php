<div class="container position-absolute menu" height="100vh">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav flex-column nav-pills">
                @can('view tin')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="{{config('app.url')}}/admin/bai-viet">Quản lý bài viết</a>
                </li>
                @endcan
                @can('view loai')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="{{config('app.url')}}/admin/loai">Quản lý loại tin</a>
                </li>
                @endcan
                @can('view user')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="{{config('app.url')}}/admin/users">Quản lý người dùng</a>
                </li>
                @endcan
                @can('view binhluan')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="{{config('app.url')}}/admin/binhluan">Quản lý bình luận</a>
                </li>
                @endcan
                @can('view permission')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="{{config('app.url')}}/admin/permissions">Quản lý quyền lợi</a>
                </li>
                @endcan
                @can('view role')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="{{config('app.url')}}/admin/roles">Quản lý vai trò</a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="../" target="public">Public</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="thoat.php">Thoát</a>
                </li>
            </ul>
        </div>
    </div>
</div>