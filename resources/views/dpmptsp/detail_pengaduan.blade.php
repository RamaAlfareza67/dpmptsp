@extends('layout.layout.layout')

@section('content')

    <section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/atas.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
        <div class="container mb-5">
            <h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">PENGADUAN DPMPTSP</b></h1>
            <h6 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi.</b></h6>
            
        </div>
    </section>
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
                                        <select id="jenis_pengaduan" name="jenis_pengaduan_filter" class="form-control">
                                        <option value="">Jenis Pengaduan</option>
                                        @foreach($data['jenis'] as $val)
                                        <option value="{{$val->id}}">{{$val->jenis}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" id="filter"> Filter</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <section class="featured-section">
    </section>
    <section class="featured-section">
        <div class="container">
            <?php 
                if(count($data['pengaduan']) > 0){
            ?>
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-lg-0">
                    <div class="custom-block bg-white shadow-lg">
                        <div class="d-flek"> 
                            <!-- begin card-forum -->
                            <div class="row" style="position: relative; bottom: 0px;margin-bottom: 0px;" id="items_container">
                                @foreach ($data['pengaduan'] as $val) 
                                <div class="col-lg-6 col-md-12">
                                    <div class="card card-forum mb-4">
                                        <!-- begin forum-list -->
                                        <ul class="forum-list forum-topic-list">
                                            <li>
                                                <!-- begin media -->
                                                <div class="media">
                                                    <img src="../assets/img/user/user.png" alt="" class="rounded-lg" />
                                                </div>
                                                <!-- end media -->
                                                <!-- begin info-container -->
                                                <div class="info-container">
                                                    <div class="info">
                                                        <p>Jenis Pengaduan : {{$val->jp}}</p>
                                                        <h5 class="title"><a href="detail.html">Pengaduan Dari : {{$val->nama}}</a></h4>
                                                        <p>"{{$val->isi}}"</p>
                                                        <h5 class="title"><a href="detail.html">Jawaban : {{$val->petugas}}</a></h4>
                                                        <p>"{{$val->tanggapan}}"</p>   
                                                    </div>
                                                    <div class="date-replies">
                                                        <div class="time">
                                                        {{$val->created_date}}
                                                        </div> 
                                                    </div>
                                                </div>
                                                <!-- end info-container -->
                                            </li>
                                        </ul>
                                            <!-- end forum-list -->
                                    </div>
                                        <!-- end card-forum -->
                                </div>
                                @endforeach
                            </div>
                            <div class="row" style="position: relative; bottom: 0px;margin-bottom: 0px;">
                                <div class="text-center">
                                <button id="load_more_button" data-page="{{ $data['pengaduan']->currentPage() + 1 }}"
                                class="btn btn-primary">Load More</button>
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
    function get_data(jenis){
        start = 4;
       

        $.ajax({
            url: '/pengaduan_filter',
            type: "POST",
            data: {
                jenis: jenis,
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
                        text: "Gagal Filter Pengaduan",
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

        var start = 4;

        $(document).on('click', '#load_more_button',function() {
            // var kecamatan = $('#kecamatan').val();
            var jenis_pengaduan = $('#jenis_pengaduan').val();
            $.ajax({
                url: "/load_more_pengaduan",
                method: "get",
                data: {
                    start: start,
                    // kecamatan: kecamatan,
                    jenis_pengaduan: jenis_pengaduan,
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
                            html += `<div class="col-lg-6 col-md-12">
                                        <div class="card card-forum mb-4">
                                            <ul class="forum-list forum-topic-list">
                                                <li>
                                                    <div class="media">
                                                        <img src="../assets/img/user/user.png" alt="" class="rounded-lg" />
                                                    </div>
                                                    <div class="info-container">
                                                        <div class="info">
                                                            <p>Jenis Pengaduan : `+data.data[i].jp+`</p>
                                                            <h5 class="title"><a href="detail.html">Pengaduan Dari : `+data.data[i].nama+`</a></h4>
                                                            <p>"`+data.data[i].isi+`"</p>
                                                            <h5 class="title"><a href="detail.html">Jawaban : `+data.data[i].petugas+`</a></h4>
                                                            <p>"`+data.data[i].tanggapan+`"</p>   
                                                        </div>
                                                        <div class="date-replies">
                                                            <div class="time">
                                                            `+data.data[i].created_date+`
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
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
            var jenis_pengaduan = $('#jenis_pengaduan').val();
            get_data(jenis_pengaduan);
        })
    });
</script>
@endsection