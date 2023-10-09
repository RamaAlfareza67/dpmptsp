@extends('layout.layout.layout')
@section('content')

<div id="page-title" class="page-title has-bg">
    <div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-8.jpg) center 0px / cover no-repeat"></div>
    <div class="container">
        <h1 style="color:black;">Struktur <a style="color:red;">Organisasi</a></h1>
        <p>Struktur Organisasi Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</p>
    </div>
</div>
<div id="content" class="content">
    <!-- begin container -->
    <div class="container">
<!-- end #page-title -->
        <div class="row">
            <img src="{{asset($data['st_organisasi']->image)}}" alt="">
        </div>
    </div>
</div>

@endsection

