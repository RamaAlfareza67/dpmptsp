@extends('layout.layout_admin.index')
@section('title')
    Dashboard
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard Perizinan</li>
    </ol>
    
    <!-- BEGIN panel -->
    <div class="row">
        <div class="col-xl-12 col-md-12"> 
        <div class="panel panel-inverse">
            <div class="accordion" id="accordion">
                <div class="accordion-item border-0">
                    <div class="accordion-header" id="headingOne">
                        <button class="accordion-button bg-gray-900 text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            <i class="fa fa-circle fa-fw text-blue me-2 fs-8px"></i>Filter
                        </button>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-gray-800 text-white">
                            <div class="row">
                                <div class="col-md-4 mb-6">
                                    <label>Tahun</label>
                                    <select name="tahun_filter" id="tahun_filter" class="form-control">
                                        @foreach ($data['tahun'] as $val)
                                            <option value="{{$val->tahun}}">{{$val->tahun}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-6">
                                    <label>Kategori</label>
                                    <select name="kategori_filter" id="kategori_filter" class="form-control">
                                        @foreach ($data['kategori'] as $val)
                                            <option value="{{$val->id}}">{{$val->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                               
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" id="filter"> Filter</button>
                                    <button class="btn btn-warning" id="reset"> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-12 col-md-12"> 
            <div class="panel">
                <div class="panel-heading bg-blue-700 text-white">
                    <h4 class="panel-title">Grafik Perizinan</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                       <div id="perizinan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END panel -->
@endsection
@section('js')
<script>
var tahun;
function get_perizinan(tahun, kategori){
    $.ajax({
        url: "/user/grafik_perizinan",
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
            text: 'Grafik Perizinan',
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
    kategori = $("#kategori_filter").val();
    get_perizinan(tahun , kategori);
    
    $(document).on('click', '#filter', function(){
        tahun = $("#tahun_filter").val();
        kategori = $("#kategori_filter").val();
        get_perizinan(tahun , kategori);
    })
})
</script>
@endsection