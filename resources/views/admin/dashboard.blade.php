@extends('layout.layout_admin.index')
@section('title')
    Dashboard
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    
    <!-- BEGIN panel -->
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info text-white">
                            <h4>TOTAL ARTIKEL</h4>
                            <p class="artikel">0</p>	
                        </div>
                        <div class="stats-link detail_artikel">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="widget widget-stats bg-cyan">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info text-white">
                            <h4>TOTAL PEGAWAI</h4>
                            <p class="artikel">0</p>	
                        </div>
                        <div class="stats-link detail_artikel">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12"> 
                    <div class="panel">
                        <div class="panel-heading bg-blue-700 text-white">
                            <h4 class="panel-title">Artikel Terbaru</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="table_artikel" class="table small table-striped table-bordered dataTables_wrapper" width="100%">
                                        <thead>
                                            <tr>
                                                {{-- <th width="5%">No</th> --}}
                                                {{-- <th width="10%">Foto</th> --}}
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th width="10%">Penulis</th>
                                                <th width="5%">Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-xl-8 col-md-6">
                    <div class="panel">
                        <div class="panel-heading bg-blue-700 text-white">
                            <h4 class="panel-title">Grafik Pengaduan</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="container" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="panel">
                        <div class="panel-heading bg-blue-700 text-white">
                            <h4 class="panel-title">Total Pengaduan</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-small table-striped table-bordered">
                                        <tr>
                                            <td>Menunggu</td>
                                            <td>:</td>
                                            <td class="pengaduan_menunggu">0</td>
                                        </tr>
                                        <tr>
                                            <td>Dijawab</td>
                                            <td>:</td>
                                            <td class="pengaduan_dijawab">0</td>
                                        </tr>
                                        <tr>
                                            <td>Ditolak</td>
                                            <td>:</td>
                                            <td class="pengaduan_ditolak">0</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>:</td>
                                            <td class="pengaduan">0</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-md-6">
                    <div class="panel">
                        <div class="panel-heading bg-blue-700 text-white">
                            <h4 class="panel-title">Grafik Pengaduan WBS</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="wbs" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="panel">
                        <div class="panel-heading bg-blue-700 text-white">
                            <h4 class="panel-title">Total Pengaduan WBS</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-small table-striped table-bordered">
                                        <tr>
                                            <td>Menunggu</td>
                                            <td>:</td>
                                            <td class="wbs_menunggu">0</td>
                                        </tr>
                                        <tr>
                                            <td>Diterima</td>
                                            <td>:</td>
                                            <td class="wbs_diterima">0</td>
                                        </tr>
                                        <tr>
                                            <td>Ditolak</td>
                                            <td>:</td>
                                            <td class="wbs_ditolak">0</td>
                                        </tr>
                                        <tr>
                                            <td>Diproses</td>
                                            <td>:</td>
                                            <td class="wbs_diproses">0</td>
                                        </tr>
                                        <tr>
                                            <td>Selesai</td>
                                            <td>:</td>
                                            <td class="wbs_selesai">0</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>:</td>
                                            <td class="wbs_total">0</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    <!-- END panel -->
    </div>
@endsection
@section('js')
<script>

function get_count(){
    $.ajax({
        url: "/user/get_count",
        method: "GET",
        success:function(res){
            $('.artikel').html(res.artikel);
            $('.pengaduan').html(res.pengaduan);
            $('.pengaduan_menunggu').html(res.pengaduan_menunggu);
            $('.pengaduan_dijawab').html(res.pengaduan_dijawab);
            $('.pengaduan_ditolak').html(res.pengaduan_ditolak);

            $('.wbs_total').html(res.wbs);
            $('.wbs_menunggu').html(res.wbs_menunggu);
            $('.wbs_diterima').html(res.wbs_diterima);
            $('.wbs_diproses').html(res.wbs_diproses);
            $('.wbs_selesai').html(res.wbs_selesai);
            $('.wbs_ditolak').html(res.wbs_ditolak);

            // $('.detail_artikel').html('<a href="/artikel" target="_blank">Lihat Detail <i class="fa fa-arrow-alt-circle-right"></i></a>');
        }
    })
}

function get_grafik(){
    $.ajax({
        url: "/user/grafik_pengaduan",
        method: "GET",
        success:function(res){
            // console.log(res.data)
            grafik_pengaduan(res.js, res.data);
            // $('.detail_artikel').html('<a href="/artikel" target="_blank">Lihat Detail <i class="fa fa-arrow-alt-circle-right"></i></a>');
        }
    })
}

function get_grafik_wbs(){
    $.ajax({
        url: "/user/grafik_pengaduan_wbs",
        method: "GET",
        success:function(res){
            // console.log(res.data)
            grafik_pengaduan_wbs(res.js, res.data);
            // $('.detail_artikel').html('<a href="/artikel" target="_blank">Lihat Detail <i class="fa fa-arrow-alt-circle-right"></i></a>');
        }
    })
}

function grafik_pengaduan(jenis, datas){
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pengaduan Berdasarkan Jenis'
        },
        subtitle: {
            text: 'E-Pengaduan Masyarakat'
        },
        xAxis: {
            categories: jenis,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Penanganan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Pengaduan</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: datas
    });
}

function grafik_pengaduan_wbs(jenis, datas){
    Highcharts.chart('wbs', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik WBS Berdasarkan Jenis'
        },
        subtitle: {
            text: 'WBS (whistleblowing System)'
        },
        xAxis: {
            categories: jenis,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Penanganan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Pengaduan</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: datas
    });
}

$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#table_artikel').DataTable({
        // dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex me-0 me-md-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
        processing: true,
        serverSide: true,
        searching: false, 
        ordering:false,
        paging: false, 
        info: false,
        ajax: {
            url: '/user/get_new_artikel_',
            method: 'POST',
            data: function(d){

            }
        },
        
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            // {data: 'img', name: 'img'},
            {data: 'judul', name: 'judul'},
            {data: 'desc', name: 'desc'},
            {data: 'penulis', name: 'penulis'},
            {data: 'status', name: 'status'}, 
        ],
        columnDefs: [
            {
                targets: [1,2],
                className: 'text-wrap width-200'
                
            },
            {
                targets: [3],
                className: 'text-center'
                
            },
        ],
    });

   
    get_count();
    get_grafik();
    get_grafik_wbs();

})
</script>
@endsection