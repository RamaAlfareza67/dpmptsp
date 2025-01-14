@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->
<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
        <!-- <video autoplay muted loop id="bg-video">
            <source src="../assets/video/dpmptsp.mp4" type="video/mp4" />
        </video> -->
        <img src="../assets/img/1.png" id="bg-video">	
        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Selamat Datang di Website</h6>
                <h2>DPM<em>PTSP</em></h2>
                <h6>KABUPATEN INDRAMAYU</h6>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
<!-- BEGIN section -->
<!-- BEGIN section -->
<!-- <div class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 pe-lg-4 mb-5 mb-lg-0">
                <div class="display-6 ">Our Platform</div>
                <div class="section-title">Stunning cross-platform template</div>
                <div class="section-desc">
                    Our suite of developer-friendly products and services help you build, secure, and deliver enterprise-grade apps in less time — for any platform.
                </div>
                <a href="#" class="section-btn"><i class="fa fa-arrow-right"></i> Learn More</a>
            </div>
            <div class="col-lg-6 ps-lg-4">
                <div class="section-media">
                    <img src="../assets/img/mpp.png" alt="" class="mw-100">	
                </div>
            </div>
        </div>
    </div>
</div>  -->


<!-- BEGIN section -->
<div class="section ">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN section-title -->
        <div class="pt-lg-5 pb-lg-3 text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
               Grafik Investasi
            </div>
            <p class="fs-18px mb-5">Update Seputar Data Investasi per tahun</p>    
            <div class="row">
                <hr>
                <div class="col-xl-12 col-md-12 mb-2 ">               
                    <div class="row mb-2">
                        <div class="col-xl-9 col-md-7 mb-2">
                            <label for="">Tahun</label>
                            <select name="tahun_filter" id="tahun_filter" class="form-control">
                                @foreach ($data['tahun'] as $val)
                                    <option value="{{$val->tahun}}">{{$val->tahun}}</option>
                                @endforeach
                            </select>
                        </div>   
                        <div class="col-xl-3 col-md-5 mb-2" style="align-self: flex-end;">
                            <button class="btn btn-primary" id="filter" style="width:100px; color:white;"> Filter</button>
                        </div>
                    </div>        
                </div>
                <hr>
            </div>
            <div class="row" style="margin-bottom:10px;">
                <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row" >
                            <div id="investasi_tahun"></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6"> 
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div id="realisasi"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6"> 
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="row">
                            <div id="proyek"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END section-title -->
    </div>
    <!-- END container -->
</div>

<div class="section  bg-light-200">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN section-title -->
        <div class="pt-lg-5 pb-lg-3 text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
               Grafik Perijinan
            </div>
            <p class="fs-18px mb-5">Update Seputar Data Perijinan per tahun</p>  
            <div class="row">
                <hr>  
                    <div class="col-xl-12 col-md-12 mb-2 "> 
                        <div class="row mb-2"> 
                            <div class="col-xl-5 col-md-6"> 
                                <label>Tahun</label>
                                <select name="tahun_perijinan_filter" id="tahun_perijinan_filter" class="form-control">
                                    @foreach ($data['tahun_perijinan'] as $val)
                                        <option value="{{$val->tahun}}">{{$val->tahun}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-5 col-md-6"> 
                                <label>Kategori</label>
                                <select name="kategori_filter" id="kategori_filter" class="form-control">
                                    @foreach ($data['kategori'] as $val)
                                        <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
                                </select>
                            </div>          
                            <div class="col-md-2" style="align-self: flex-end;">
                                <button class="btn btn-primary" id="filter_perizinan" style="width:70px; color:white;"> Filter</button>
                                <button class="btn btn-warning" id="reset" style="width:70px; color:white;"> Reset</button>
                            </div>
                        </div>
                    </div>
                <hr>
            </div>
                                
                </div>
                <div class="col-xl-12 col-md-12"> 
                <div class="row">
                <div id="perizinan"></div>
                </div>
                
           
        </div>
        <!-- END section-title -->
    </div>
    <!-- END container -->
</div>

<!-- BEGIN section -->
<div class="section">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN section-title -->
        <div class="pt-lg-5 pb-lg-3 text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
                Berita & Event Terbaru
            </div>
            <p class="fs-18px mb-5">Update Seputar Aktivitas, Acara dan Info lainnya</p>
            
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-3 -->
                <?php
                    if(count($data['berita']) > 0){
                        foreach ($data['berita'] as $val) {
                ?>
                <div class="col-lg-3">
                    <!-- BEGIN news -->
                    <div class="news">
                        <div class="news-media">
                            <div class="news-media-img news-media-img-lg" style="background-image: url({{$val->image}});"></div>
                        </div>
                        <div class="news-content">
                            <div class="news-title">{{$val->judul}}</div>
                            <div class="news-date">{{$val->created_date}}</div>
                        </div>
                        <a href="/berita/detail/{{Crypt::encrypt($val->id)}}" class="stretched-link"></a>
                    </div>
                    <!-- END news -->
                </div>
                <?php 
                        } 
                    } else { 
                ?>
                    <p class="fs-18px mb-5">Kosong</p>
                <?php } ?>
                <div class="text-center">
                    <a href="/berita" class="btn bg-red  fw-bold rounded-pill" style="color:aliceblue;">Berita Lainnya</a>
                </div>
            </div>
            
        <!-- END row -->
        </div>
        <!-- END section-title -->
    </div>
    <!-- END container -->
</div>



<section class="section-padding section-bg">
    
        <div class="row">


            <div class="col-lg-6 col-md-6 col-12 mt-3 mb-4 mb-lg-0">
                <div class="custom-block custom-block-overlay shadow-lg">
                    <a href="">
                    <img src="../assets/img/info.jpg" class="custom-block-image img-fluid" alt="">
                        <div class="custom-block-overlay-text d-flex">
                            <div>
                                <h1 style="color:red;">Informasi Layanan Pengaduan</h1>
                                    <br>
                                    <div class="header-btn">
                                    <a href="" class="btn custom-btn mt-2 mt-lg-3">LAYANAN PENGADUAN</a>
                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12 mt-3 mb-4 mb-lg-0">
                <div class="custom-block custom-block-overlay">
                <a href="">
                <img src="../assets/img/tes.jpg" class="custom-block-image img-fluid" alt="">
                    <div class="d-flex flex-column h-100">
                        <div class="custom-block-overlay-text d-flex" style="color:white;">
                            <div>
                            <h1 style="color:white;">Sudahkah Anda Mengurus Izin?</h1>
                            <br>
                    <div class="header-btn">
                    <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3" style="color:white;">INFORMASI LAYANAN</a>
                    </div>
                            </div>

                           
                        </div>
                        <div class="section-overlay"></div>
                    </div>
                    </a>
                </div>
            </div>

        </div>
    
</section>

<section class="section-padding section-bg" style="padding-top:0px;">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN section-title -->
        <div class="pt-lg-5 pb-lg-3 text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
                Informasi Publik
            </div>
            <p class="fs-18px mb-5"></p> 
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-4 -->
            <?php
                if(count($data['informasi_publik']) > 0){
                    foreach ($data['informasi_publik'] as $val) {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="{{asset($val->file)}}" target="_blank"><img src="{{asset($val->cover)}}" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">{{$val->nama}}</span>
								<span class="desc-text">{{$val->deskripsi}}</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <?php 
                    } 
                } else { 
            ?>
                <p class="fs-18px mb-5">Kosong</p>
            <?php } ?>
            <div class="text-center">
                    <a href="/informasi_publik" class="btn bg-red  fw-bold rounded-pill" style="color:aliceblue;">Informasi Publik Lainnya</a>
                </div>
            <!-- END col-4 -->
            
        </div>
    </div>
    <!-- END container -->
    </section>
    <section> 
  <div class='air air1'></div>
  <div class='air air2'></div>
  <div class='air air3'></div>
  <div class='air air4'></div>
</section>
</div>
    
    <div class="section" style="background: url(../assets/img/tes.jpg)center 0px / cover no-repeat">
    <div class="section-overlay"></div>
        <section class="timeline-section section-padding" id="section_3" >
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4"> Mengurus izin kini jauh lebih nyaman, cepat, mudah</h1>
                        <p style="color:white;">5 Alasan pentingnya kita memiliki izin usaha,berikut penjelasannya :</p> <br>
                    </div>
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>
                                <li>
                                    <h4 class="text-white mb-3">Taat Hukum</h4>
                                    <p class="text-white">Usaha Yang Memiliki Izin Mendapat Jaminan Hukum dan Perlindungan dari Pemerintah Apabila Terjadi Hal Yang Tidak Diinginkan</p>
                                    <div class="icon-holder">
                                        <i>1</i>
                                    </div>
                                </li>     
                                <li>
                                    <h4 class="text-white mb-3">Usaha Berkembang</h4>
                                    <p class="text-white">Usaha Yang Memiliki Izin Lengkap & Sah Akan Mendapat Kemudahan Dalam Hal Pembiayaan Untuk Perkembangan Usaha</p>
                                    <div class="icon-holder">
                                        <i>2</i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">Ikut Serta Dalam Tender</h4>
                                    <p class="text-white">Usaha Yang Memiliki Izin Akan Lebih Mudah Ikut Serta Dalam Tender</p>
                                    <div class="icon-holder">
                                        <i>3</i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">Memperluas Usaha</h4>
                                    <p class="text-white">Usaha Lokal Yang Memilki Izin, Memiliki Kesempatan Untuk Memperluas Usahanya Ke Tingkat Internasional</p>
                                    <div class="icon-holder">
                                        <i>4</i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">Promosi Usaha</h4>
                                    <p class="text-white">Dengan Memiliki Izin Usaha, Maka Kredibilitas Usaha Anda Baik dan Semakin Mudah Untuk Mengikuti Promosi Melalui Pameran Yang Diselenggarakan Pemerintah</p>
                                    <div class="icon-holder">
                                        <i>5</i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<!-- END section -->
<!-- BEGIN section -->
   
		
    

@endsection
	
@section('js')
<script>
var tahun;
function get_realisasi(tahun, jenis){
    $.ajax({
        url: "/grafik_realisasi_investasi_publik",
        method: "POST",
        data: {
            tahun: tahun,
            jenis: jenis
        },
        success:function(res){
            // console.log(res.data)
            grafik_realisasi(res.data);
        }
    })
} 

function get_proyek(tahun, jenis){
    $.ajax({
        url: "/grafik_realisasi_investasi_publik",
        method: "POST",
        data: {
            tahun: tahun,
            jenis: jenis
        },
        success:function(res){
            // console.log(res.data)
            grafik_proyek(res.data);
        }
    })
} 

function get_investasi_tahun(){
    $.ajax({
        url: "/grafik_investasi_tahun",
        method: "POST",
        data: {

        },
        success:function(res){
            // console.log(res.data)
            grafik_investasi_tahun(res.kategori, res.data);
        }
    })
}

function grafik_realisasi(datas){
    // console.log(datas);
    if(datas.length == 0){
        datas = [0,0,0,0]
    }
    Highcharts.chart('realisasi', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik Realisasi Investasi PMDN',
            align: 'left'
        },
        // subtitle: {
        //     text: 'Source: ' +
        //         '<a href="https://www.ssb.no/en/statbank/table/08804/"' +
        //         'target="_blank">SSB</a>',
        //     align: 'left'
        // },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV'],
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            }
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Total Realisasi: Rp. {point.y}'
        },
        series: [{
            name: 'Total Realisasi',
            data: datas
        }]
    });
}

function grafik_proyek(datas){
    // console.log(datas);
    if(datas.length == 0){
        datas = [0,0,0,0]
    }
    Highcharts.chart('proyek', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik Realisasi Investasi PMA',
            align: 'left'
        },
        // subtitle: {
        //     text: 'Source: ' +
        //         '<a href="https://www.ssb.no/en/statbank/table/08804/"' +
        //         'target="_blank">SSB</a>',
        //     align: 'left'
        // },
        plotOptions: {
            column: {
                depth: 25,
                color: '#6AF9C4'
            }
        },
        xAxis: {
            categories: ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV'],
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            }
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Total Proyek: {point.y}'
        },
        series: [{
            name: 'Total Proyek',
            data: datas,
        }],
        colors: ['#6AF9C4'],
    });
}

function grafik_investasi_tahun(kategori, data){
    Highcharts.chart('investasi_tahun', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pertumbuhan Investasi Pertahun',
            align: 'left'
        },
        
        xAxis: {
            categories: kategori,
            crosshair: true,
        },

        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: "PMDN",
                data: data[0]
            },
            {
                name: "PMA",
                data: data[1]
            },
        ]
    });

}

function get_perizinan(tahun, kategori){
    $.ajax({
        url: "/grafik_perizinan_publik",
        method: "POST",
        data: {
            tahun: tahun,
            kategori: kategori
        },
        success:function(res){
            // console.log(res.data)
            grafik_perizinan(res.data);
        }
    })
} 


function grafik_perizinan(datas){
    // console.log(datas);
    if(datas.length == 0){
        datas = [0,0,0,0,0,0,0,0,0,0,0,0]
    }
    Highcharts.chart('perizinan', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik Izin Terbit',
            align: 'left'
        },
        // subtitle: {
        //     text: 'Source: ' +
        //         '<a href="https://www.ssb.no/en/statbank/table/08804/"' +
        //         'target="_blank">SSB</a>',
        //     align: 'left'
        // },
        plotOptions: {
            column: {
                depth: 25,
                color: '#44a832'
            }
        },
        xAxis: {
            categories: ['JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER'],
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            }
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Total Realisasi: Rp. {point.y}'
        },
        series: [{
            name: 'Total Realisasi',
            data: datas
        }]
    });
}


$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    tahun = $("#tahun_filter").val();
    get_realisasi(tahun , 'realisasi');
    get_proyek(tahun, 'proyek');
    get_investasi_tahun();
    
    $(document).on('click', '#filter', function(){
        tahun = $("#tahun_filter").val();
        get_realisasi(tahun , 'realisasi');
        get_proyek(tahun, 'proyek');
    })

    tahun_perizinan = $("#tahun_perijinan_filter").val();
    kategori = $("#kategori_filter").val();
    get_perizinan(tahun_perizinan , kategori);
    
    $(document).on('click', '#filter_perizinan', function(){
        tahun_perizinan = $("#tahun_perijinan_filter").val();
        kategori = $("#kategori_filter").val();
        get_perizinan(tahun_perizinan , kategori);
    })
})

</script>
@endsection
	
