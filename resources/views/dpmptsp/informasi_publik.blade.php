@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->
<section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/layanan.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
                <div class="container mb-5">
                    <h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">INFORMASI PUBLIK DPMPTSP</b></h1>
                    <h6 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</b></h6>
                </div>
                
            </section>
<!-- end #page-title -->
<section style="padding-bottom:100px;">
<div class="container">
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
                                            <select id="jenis_kategori" name="informasi_filter" class="form-control">
                                            <option value="">Semua Informasi</option>
                                            @foreach($data['kategori'] as $val)
                                            <option value="{{$val->id}}">{{$val->nama}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary" style="color:white;" id="filter"> Filter</button>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</section>
<section class="featured-section">
    <div class="container">
    <?php 
                if(count($data['informasi_publik']) > 0){
            ?>
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-lg-2">
            	<div class="custom-block bg-white shadow-lg">      
					<div class="d-flek"> 
					    <div class="row row-space-30" style="position: relative; bottom: 0px;margin-bottom: 30px;" id="items_container">
                            @foreach ($data['informasi_publik'] as $val) 
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
                            @endforeach
                        </div>
                        <div class="row" style="position: relative; bottom: 0px;margin-bottom: 0px;">
                            <div class="text-center">
                                <button id="load_more_button" data-page="{{ $data['informasi_publik']->currentPage() + 1 }}"
                                class="btn btn-danger" style="color:white;">Load More</button>
                            </div>
                        </div>  
                    </div>   
                </div>     
            </div>
        </div>
        <?php 
                    } 
                    else { 
            ?>
                
                <div class="row justify-content-center">
                    <img src="../assets/images/kosong.jpg"  alt="" style="object-fit:cover; width:50%;">
                </div>
                
            <?php } ?>
    </div>
</section>

@endsection
@section('js')
<script>
    function get_data(kategori){
        start = 4;

        $.ajax({
            url: '/informasi_filter',
            type: "POST",
            data: {
                kategori: kategori,
            },
            beforeSend: function(){
                    swal.fire({
                        title: 'Harap Tunggu!',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        buttons: false,
                        timer: 2000,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
            success: function(data) {
                if (data.result != true) {
                    Swal.fire({
                        title: 'Gagal',
                        text: "Gagal Filter Informasi Publik",
                        icon: 'error',
                        showCancelButton: false,
                        showConfirmButton: true,
                        // buttons: false,
                    });
                } else {
                    Swal.fire({
                        title: 'Berhasil',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: true
                    });
                    $('#items_container').html(data.data);
                    $('#load_more_button').html('Load More');
                    $('#load_more_button').attr('disabled', false);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }

    $(document).ready(function() {
       
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

       var start = 8;

       $(document).on('click', '#load_more_button',function() {
           // var kecamatan = $('#kecamatan').val();
           var kategori = $('#kategori').val();
           $.ajax({
               url: "/load_more_informasi",
               method: "get",
               data: {
                   start: start,
                   // kecamatan: kecamatan,
                   kategori: kategori,
               },
               dataType: "json",
               beforeSend: function() {
                   $('#load_more_button').html('Loading...');
                   $('#load_more_button').attr('disabled', true);
               },
               success: function(data) {
                   console.log(data);
                   if (data.data.length > 0) {
                       var html = '';
                       for (var i = 0; i < data.data.length; i++) {
                           let ids = data.data[i].id;
                           html += `<div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card shadow border-0 mb-5">
                                        <div class="card-body p-4">
                                            <div class="work">
                                                <div class="image">
                                                    <a href="`+data.data[i].file+`" target="_blank"><img src="`+data.data[i].cover+`" alt="Work 1" /></a>
                                                </div>
                                                <div class="desc">
                                                    <span class="desc-title">`+data.data[i].nama+`</span>
                                                    <span class="desc-text">`+data.data[i].deskripsi+`</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>`;
                       }
                       //console.log(html);
                       //append data  without fade in effect
                       //$('#items_container').append(html);

                       //append data with fade in effect
                       $('#items_container').append($(html).hide().fadeIn(1000));
                       $('#load_more_button').html('Load More');
                       $('#load_more_button').attr('disabled', false);
                       start = data.next;
                   } else {
                       $('#load_more_button').html('No More Data Available');
                       $('#load_more_button').attr('disabled', true);
                   }
               }
           });
       });
       $(document).on('click', '#filter', function(){
           var kategori = $('#jenis_kategori').val();
           get_data(kategori);
       })
   });
</script>
@endsection
