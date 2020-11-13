
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Bảng Quản Trị Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if(Session::has('admin'))
                <i class="fa fa-user fa-fw"></i> {{ Session::get('admin')['name'] }}    <i class="fa fa-caret-down"></i>
                 @endif
            </a>
            <ul class="dropdown-menu dropdown-user">
                @if(Session::has('admin'))
                    <li>
                        <a href="admin/user/sua/ {{ Session::get('admin')['id'] }}">
                            <i class="fa fa-gear fa-fw"></i> Cập nhật thông tin
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                    </li>
                @endif
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    @include('admin.layout.menu')
    <!-- /.navbar-static-side -->
</nav>