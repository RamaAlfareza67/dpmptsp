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
    <div class="row " style="margin-bottom: 20px;">
        <div class="col-xl-3 col-md-6">
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
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info text-white">
                    <h4>TOTAL PENGADUAN</h4>
                    <p class="pengaduan">0</p>	
                </div>
                <div class="stats-link detail_artikel">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info text-white">
                    <h4>TOTAL PENGADUAN MENUNGGU</h4>
                    <p class="pengaduan_menunggu">0</p>	
                </div>
                <div class="stats-link detail_artikel">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info text-white">
                    <h4>TOTAL PENGADUAN DIJAWAB</h4>
                    <p class="pengaduan_dijawab">0</p>	
                </div>
                <div class="stats-link detail_artikel">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info text-white">
                    <h4>TOTAL PENGADUAN DITOLAK</h4>
                    <p class="pengaduan_ditolak">0</p>	
                </div>
                <div class="stats-link detail_artikel">
                </div>
            </div>
        </div>
        <div id="container"></div>
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

            // $('.detail_artikel').html('<a href="/artikel" target="_blank">Lihat Detail <i class="fa fa-arrow-alt-circle-right"></i></a>');
        }
    })
}

function get_grafik(){
    $.ajax({
        url: "/user/grafik_pengaduan",
        method: "GET",
        success:function(res){
            console.log(res.data)
            grafik_pengaduan(res.js, res.data);
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

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
    get_count();
    get_grafik();

})
</script>
@endsection