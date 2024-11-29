
<!-- begin #header -->
<div id="navbar" class="header navbar navbar-default navbar-expand-lg navbar-fixed-top">
    <!-- begin container -->
    <div class="container"><!-- begin navbar-brand -->
        <a href="/" class="navbar-brand">
            <img src="{{($profil->logo != null) ? asset($profil->logo) : ''}}" class="img-fluid">
        </a>
        <!-- end navbar-brand -->
        <!-- begin navbar-toggle -->
        <button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#header-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- end navbar-toggle -->
        <!-- begin navbar-collapse -->
        <div class="collapse navbar-collapse" id="header-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="/" class="nav-item">BERANDA</a></li>
                <li class="dropdown ">
                    <a href="#" data-bs-toggle="dropdown" >PROFIL <b class="caret"></b></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/visi_misi">VISI & MISI</a>
                        <a class="dropdown-item" href="/struktur_organisasi">STRUKTUR ORGANISASI</a>
                        <a class="dropdown-item" href="/informasi_publik">INFORMASI PUBLIK</a>
                        <!-- <a class="dropdown-item" href="index.html">TUPOKSI</a>
                        <a class="dropdown-item" href="index.html">RENCANA KERJA</a>
                        <a class="dropdown-item" href="index.html">LAPORAN AKUNTABILITAS</a> -->
                    </div>
                </li>
                <li ><a href="/layanan_dinas">LAYANAN DINAS</a></li>
                <li ><a href="/berita">BERITA</a></li>
                <li ><a href="/pengaduan">PENGADUAN</a></li>
                <!-- <li ><a href="/wbs">WBS</a></li> -->
                <li ><a href="/kontak">KONTAK KAMI</a></li>
            </ul>
        </div>
        <!-- end navbar-collapse -->
    </div>
    <!-- end container -->
</div>
<!-- end #header -->