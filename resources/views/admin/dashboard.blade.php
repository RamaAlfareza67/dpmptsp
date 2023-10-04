@extends('layout.layout_admin.index')
@section('title')
    Dashboard
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
                        <h4>Dashboard</h4>
                    </div>  
                </div>  
                </div>  
            </div>
        </div>
    <!-- END panel -->
    </div>
@endsection