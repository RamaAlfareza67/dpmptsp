@extends('layout.layout_admin.index')
@section('title')
    Selamat Datang di DPMPTSP
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Library</a></li>
        <li class="breadcrumb-item active">Data</li> --}}
    </ol>
    
    <!-- BEGIN panel -->
    <div class="row " style="margin-bottom: 20px;">
        <div class="col-12"> 
            <div class="card border-0">
                <div class="card-body">
                    <div class=" d-flex">
                        
                        <div  style="margin: left 5px; justify-content:center; margin-left:20px;">
                        <h1>Hallo, <b>{{ Auth::user()->name }}  </b> 
                    <!-- weather widget start -->
                    
                        </h1><br><h4>Welcome to DPMPTSP</h4>
                        <p>Sistem Pengaduan DPMPTSP </p></div>
                    </div>  
                </div>  
                </div>  
            </div>
        </div>
    <!-- END panel -->
    </div>
@endsection