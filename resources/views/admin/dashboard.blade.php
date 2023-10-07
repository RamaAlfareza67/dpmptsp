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

            // $('.detail_artikel').html('<a href="/artikel" target="_blank">Lihat Detail <i class="fa fa-arrow-alt-circle-right"></i></a>');
        }
    })
}



$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
    get_count();


   

})
</script>
@endsection