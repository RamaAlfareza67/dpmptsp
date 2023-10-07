<div class="navbar-header">
    <a href="/" class="navbar-brand"><img src="{{asset((Session::get('logo') == null) ? '/uploads/logo/no-logo.png' : Session::get('logo'))}}"  style="margin-right:10px;"  alt=""></a>
    <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
</div>
<!-- END navbar-header -->
<!-- BEGIN header-nav -->
<div class="navbar-nav">
    <div class="navbar-item navbar-form">
        {{-- <form action="" method="POST" name="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter keyword" />
                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
            </div>
        </form> --}}
    </div>
    <div class="navbar-item dropdown">
        {{-- <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
            <i class="fa fa-bell"></i>
            <span class="badge">0</span>
        </a>
        <div class="dropdown-menu media-list dropdown-menu-end">
            <div class="dropdown-header">NOTIFICATIONS (0)</div>
            <div class="text-center w-300px py-3">
                No notification found
            </div>
        </div> --}}
    </div>
    <div class="navbar-item navbar-user dropdown">
        <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
            <div class="me-2 avatar-sm rounded-circle">
                <?php if(Auth::user()->foto != null) {
                    $foto = asset(Auth::user()->foto);
                } else {
                    $foto = asset('uploads/noimage.jpg');
                }?>
                <img style="object-fit: cover;" src="{{$foto}}" alt="" class="mr-2" width="15%"/>
            </div>
            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span> <b class="caret ms-6px"></b>
        </a>
        <div class="dropdown-menu dropdown-menu-end me-1">
            <a href="/user/profil" class="dropdown-item">Edit Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('signout') }}" class="dropdown-item">
                Logout
            </a>
        </div>
    </div>
</div>
<!-- END header-nav -->