@extends('layout.layout.layout')

@section('content')
<!-- begin #page-title -->
<div id="page-title" class="page-title has-bg">
		<div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-8.jpg) center 0px / cover no-repeat"></div>
		<div class="container">
			<h1 style="color:black;">Visi <a style="color:red;">Misi</a></h1>
		</div>
</div>
<!-- end #page-title -->
<div id="content" style="background: url(../assets/img/cover/red_waves_background.jpg) center 0px / cover no-repeat">

    <div class="container"  data-aos="fade-up">
        <h1 class="post-title">{{$data['vis_mis']->judul}}</h1>
        <p class="about-me-desc">
        {!!$data['vis_mis']->isi!!}
        </p>
    </div>
</div>


@endsection