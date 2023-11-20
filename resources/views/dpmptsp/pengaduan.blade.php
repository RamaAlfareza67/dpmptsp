@extends('layout.layout.layout')

@section('content')

    <section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/atas.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
                <div class="container mb-5">
                    <h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">PENGADUAN DPMPTSP</b></h1>
                    <h6 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</b></h6>
                </div>
            </section>


            <section class="featured-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 mb-lg-0">
                            
                        </div>
                        <div class="col-lg-12 mb-lg-2">
                            <div class="custom-block bg-white shadow-lg">      
                                    <div class="d-flek"> 
                                            <form id="add-form">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 mb-lg-2">
                                                        <h4 class="mb-5" style="text-align:center;">Silahkan isi data pengaduan Anda</h4>
                                                    </div>
                                                    <div class="col-lg-12  mt-lg-2 ">
                                                        <h4 class="" style="text-align:center;"><B>KIRIM PENGADUAN</B></h4>
                                                        <p style="text-align:center;">Anda melihat atau mengetahui dugaan Tindak Pidana Korupsi yang dilakukan pegawai<b> DPMPTSP</b>. Silahkan melapor ke Inspektorat <b>DPMPTSP</b>. Jika laporan anda memenuhi syarat/kriteria, maka akan diproses lebih lanjut.</p>
                                                    </div>
                                                    <div class="col-lg-6 mb-lg-2">
                                                        <input name="nik" id="nik"  class="form-control mb-3" placeholder="NIK">
                                                        <input name="no_hp" id="no_hp"  class="form-control mb-3" placeholder="No Telp"> 
                                                        <input name="alamat" id="alamat"  class="form-control mb-3" placeholder="Alamat">
                                                        <input name="kecamatan" id="kecamatan"  class="form-control mb-3" placeholder="Kecamatan">
                                                        
                                                    </div>
                                                    <div class="col-lg-6 mb-lg-2">
                                                        <input name="nama" id="nama"  class="form-control mb-3" placeholder="Nama">
                                                        <input name="email" id="email"  class="form-control mb-3" placeholder="E-mail">
                                                        <input name="kelurahan" id="kelurahan"  class="form-control mb-3" placeholder="Kelurahan">
                                                    </div>
                                                    <div class="col-lg-6 mb-lg-2">
                                                        <select name="jenis_pengaduan" id="jenis_pengaduan" class="form-control mb-3">
                                                            <option value="">- Pilih Jenis Pengaduan -</option>
                                                            @foreach($data['jenis'] as $val)
                                                                <option value="{{$val->id}}">{{$val->jenis}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> 
                                                    <div class="col-lg-6 mb-lg-2">
                                                        <input type="file" name="file" id="file"  class="form-control mb-3"> 
                                                    </div> 
                                                    <div class="col-lg-12 mb-lg-2">
                                                        <textarea name="isi" id="isi" rows="5" class="form-control mb-3" placeholder="Pesan"></textarea> 
                                                        <button type="submit" class="btn btn-primary" style="width: 100%">Kirim Pengaduan</button>
                                                    </div>
                                                </div> 
                                            </form>       
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-lg-0">
                            <div class="custom-block bg-white shadow-lg">
                                    <div class="d-flek"> 
                                        <!-- begin card-forum -->
                                        <div class="row" style="position: relative; bottom: 0px;margin-bottom: 0px;">
                                <?php
                                    if(count($data['pengaduan']) > 0){
                                        foreach ($data['pengaduan'] as $val) {
                                ?>
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
                                                                    <h4 class="title"><a href="detail.html">Pengaduan Dari : {{$val->nama}}</a></h4>
                                                                    <p>"{{$val->isi}}"</p>
                                                                    <h4 class="title"><a href="detail.html">Jawaban : {{$val->petugas}}</a></h4>
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
                                            <?php 
                                                    } 
                                                } else { 
                                            ?>
                                                
                                                <img src="../assets/img/kosong.jpg"  alt="" style="object-fit:cover; width:100%;">
                                                
                                            <?php } ?>
                                        </div>
                                    </div>
                                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection


@section('js')
<script>
$(document).ready(function() {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                nik: {
                    required: true
                },
                nama: {
                    required: true
                },
                alamat: {
                    required: true
                },
                kecamatan: {
                    required: true
                },
                kelurahan: {
                    required: true
                },
                email: {
                    required: true
                },
                no_hp: {
                    required: true
                },
                jenis_pengaduan: {
                    required: true
                },
                isi: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                url = '/create_pengaduan';

                var form_data = new FormData(document.getElementById("add-form"));

                $.ajax({
                    url: url,
                    type: "POST",
                    data: form_data,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                            swal.fire({
                                title: 'Harap Tunggu!',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                buttons: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                    success: function(data) {
                        if (data.result != true) {
                            Swal.fire({
                                title: 'Gagal',
                                text: "Gagal Membuat Pengaduan",
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                        } else {
                            Swal.fire({
                                title: 'Berhasil',
                                text:'Pengaduan Anda Telah Kami Terima dan Akan Segera Kami Proses Untuk Jawaban nya akan Kami Kirim ke E-mail yang tertera di form',
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: true
                            });
                            $('#add-form')[0].reset();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });

    });
</script>
@endsection