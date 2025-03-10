<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <div class="menu-profile-link" >
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image menu-profile-image-icon bg-gray-900 text-gray-600">
                        <?php if(Auth::user()->foto != null) {
                            $foto = asset(Auth::user()->foto);
                        } else {
                            $foto = asset('uploads/noimage.jpg');
                        }?>
                        <img src="{{$foto}}" alt=""/>
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                {{ auth()->user()->name }}
                            </div>
                            {{-- <div class="menu-caret ms-auto"></div> --}}
                        </div>
                        <small>{{ auth()->user()->jabatan }}</small>
                    </div>
                </div>
            </div>
            
            <div class="menu-header">Navigation</div>
            <?php if(Auth::user()->roles == 'SUPER_ADMIN'){ ?>
            <div class="menu-item {{ ($data['module'] == 'DASHBOARD') ? 'active' : '' }}">
                <a href="/user/dashboard" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'DASHBOARD_INVESTASI') ? 'active' : '' }}">
                <a href="/user/dashboard_investasi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Dashboard Investasi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'DASHBOARD_PERIZINAN') ? 'active' : '' }}">
                <a href="/user/dashboard_perizinan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Dashboard Perizinan</div>
                </a>
            </div>
            <div class="menu-header">Pengaduan</div>
            <div class="menu-item {{ ($data['module'] == 'PENGADUAN') ? 'active' : '' }}">
                <a href="/user/pengaduan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-paper-plane"></i>
                    </div>
                    <div class="menu-text">Pengaduan</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'WBS') ? 'active' : '' }}">
                <a href="/user/wbs" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="menu-text">Wishtleblowing System</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'JENIS_PENGADUAN') ? 'active' : '' }}">
                <a href="/user/jenis_pengaduan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Jenis Pengaduan</div>
                </a>
            </div>
            
            <div class="menu-header">CMS</div>
            <div class="menu-item {{ ($data['module'] == 'ARTIKEL') ? 'active' : '' }}">
                <a href="/user/artikel" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                    <div class="menu-text">Artikel</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'INVESTASI') ? 'active' : '' }}">
                <a href="/user/investasi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Investasi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'PERIZINAN') ? 'active' : '' }}">
                <a href="/user/perizinan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Perizinan</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'LAYANAN_DINAS') ? 'active' : '' }}">
                <a href="/user/layanan_dinas" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Layanan Dinas</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'INFORMASI_PUBLIK') ? 'active' : '' }}">
                <a href="/user/informasi_publik" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Informasi Publik</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'VISI_MISI') ? 'active' : '' }}">
                <a href="/user/visi_misi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Visi Misi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'STRUKTUR_ORGANISASI') ? 'active' : '' }}">
                <a href="/user/struktur_organisasi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">Struktur Organisasi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'PROFIL_DINAS') ? 'active' : '' }}">
                <a href="/user/profil_dinas" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-bank"></i>
                    </div>
                    <div class="menu-text">Profil Dinas</div>
                </a>
            </div>
            <div class="menu-header">Data</div>
            <div class="menu-item {{ ($data['module'] == 'PEGAWAI') ? 'active' : '' }}">
                <a href="/user/pegawai" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="menu-text">Pegawai</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'USERMANAGEMENT') ? 'active' : '' }}">
                <a href="/user/user_management" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="menu-text">User Management</div>
                </a>
            </div>
            <?php } ?>
            <?php if(Auth::user()->roles == 'ADMIN_PENGADUAN'){ ?>
            <div class="menu-item {{ ($data['module'] == 'PENGADUAN') ? 'active' : '' }}">
                <a href="/user/pengaduan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-paper-plane"></i>
                    </div>
                    <div class="menu-text">Pengaduan</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'WBS') ? 'active' : '' }}">
                <a href="/user/wbs" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="menu-text">Wishtleblowing System</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'JENIS_PENGADUAN') ? 'active' : '' }}">
                <a href="/user/jenis_pengaduan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Jenis Pengaduan</div>
                </a>
            </div>
            <?php } ?>
            <?php if(Auth::user()->roles == 'ADMIN_CMS'){ ?>
            <div class="menu-item {{ ($data['module'] == 'DASHBOARD_INVESTASI') ? 'active' : '' }}">
                <a href="/user/dashboard_investasi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Dashboard Investasi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'DASHBOARD_PERIZINAN') ? 'active' : '' }}">
                <a href="/user/dashboard_perizinan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Dashboard Perizinan</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'ARTIKEL') ? 'active' : '' }}">
                <a href="/user/artikel" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                    <div class="menu-text">Artikel</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'INVESTASI') ? 'active' : '' }}">
                <a href="/user/investasi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Investasi</div>
                </a>
            </div>
             <div class="menu-item {{ ($data['module'] == 'PERIZINAN') ? 'active' : '' }}">
                <a href="/user/perizinan" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Perizinan</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'LAYANAN_DINAS') ? 'active' : '' }}">
                <a href="/user/layanan_dinas" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Layanan Dinas</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'INFORMASI_PUBLIK') ? 'active' : '' }}">
                <a href="/user/informasi_publik" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Informasi Publik</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'VISI_MISI') ? 'active' : '' }}">
                <a href="/user/visi_misi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Visi Misi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'STRUKTUR_ORGANISASI') ? 'active' : '' }}">
                <a href="/user/struktur_organisasi" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">Struktur Organisasi</div>
                </a>
            </div>
            <div class="menu-item {{ ($data['module'] == 'PROFIL_DINAS') ? 'active' : '' }}">
                <a href="/user/profil_dinas" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-bank"></i>
                    </div>
                    <div class="menu-text">Profil Dinas</div>
                </a>
            </div>
            <?php } ?>
            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->
            
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>