@extends('layout.layout.layout')

@section('content')

    <section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/wbs.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
                <div class="container mb-5">
                    <h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">WHISTLEBLOWING SYSTEM DPMPTSP</b></h1>
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
                                                <div class="col-lg-12   mb-lg-2">
                                                        <h4 class="mb-5" style="text-align:center;"><B>KIRIM PENGADUAN</B></h4>
                                                        
                                                    </div>
                                                    <div class="col-lg-12  mt-lg-2 ">
                                                        <h4 class="" style="text-align:center;"><B>KIRIM PENGADUAN</B></h4>
                                                        <p style="text-align:center;">Anda melihat atau mengetahui dugaan Tindak Pidana Korupsi yang dilakukan pegawai<b> DPMPTSP</b>. Silahkan melapor ke Inspektorat <b>DPMPTSP</b>. Jika laporan anda memenuhi syarat/kriteria, maka akan diproses lebih lanjut.</p>
                                                    </div>
                                                    <div class="col-lg-12  mt-lg-2 mb-2">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color: #931a2c; color:white;">
                                                                Data Pribadi
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row" style="position: relative; bottom: 0px;margin-bottom: 0px;">
                                                                    <div class="col-6 mb-2">
                                                                        <label for=""  >Nomor Induk Kependudukan<a style="color:red;">*</a></label>
                                                                        <input name="nik" id="nik"  class="form-control mb-2">
                                                                        <label for="" >E-mail<a style="color:red;">*</a></label>
                                                                        <input name="email" id="email"  class="form-control mb-2">
                                                                        <label for="" >Alamat<a style="color:red;">*</a></label>
                                                                        <input name="alamat" id="alamat"  class="form-control mb-2" >
                                                                        <label for="" >Kecamatan<a style="color:red;">*</a></label>
                                                                        <input name="kecamatan" id="kecamatan"  class="form-control mb-2" >
                                                                        
                                                                    </div>
                                                                    <div class="col-6 mb-2">
                                                                        <label for="" >Nama Lengkap<a style="color:red;">*</a></label>
                                                                        <input name="nama" id="nama"  class="form-control mb-2" >
                                                                        <label for="" >No Handphone<a style="color:red;">*</a></label>
                                                                        <input name="no_hp" id="no_hp"  class="form-control mb-2"> 
                                                                        <label for="" >Keluarahan<a style="color:red;">*</a></label>
                                                                        <input name="kelurahan" id="kelurahan"  class="form-control mb-2">
                                                                        
                                                                    </div>
                                                                    <div class="col-6 mb-2">
                                                                        
                                                                    
                                                                        
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12  mt-lg-2  mb-lg-2">
                                                        <div class="card">
                                                            <div class="card-header" style="background-color: #931a2c; color:white;">
                                                                Isi Pengaduan
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row" style="position: relative; bottom: 0px;margin-bottom: 0px;">
                                                                    <div class="col-lg-6">
                                                                        <label for="" >Jenis Pengaduan<a style="color:red;">*</a></label>
                                                                        <select name="jenis_pengaduan" id="jenis_pengaduan" class="form-control mb-2">
                                                                            <option value="">- Pilih Jenis Pengaduan -</option>
                                                                            @foreach($data['jenis'] as $val)
                                                                                <option value="{{$val->id}}">{{$val->jenis}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <label for="" >Nama Terlapor<a style="color:red;">*</a></label>
                                                                        <input name="nama_terlapor" id="nama_terlapor"  class="form-control mb-2" placeholder="dapat diisi lebih dari satu nama" >
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <label for="" >Lokasi Kejadian<a style="color:red;">*</a></label>
                                                                        <input name="lokasi_kejadian" id="lokasi_kejadian"  class="form-control mb-2" placeholder="detail nama tempat/alamat kejadian" >
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <label for="" >Kecamatan<a style="color:red;">*</a></label>
                                                                        <input name="kecamatan_" id="kecamatan_"  class="form-control mb-2" placeholder="nama kecamatan" >
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <label for="" >Keluarahan<a style="color:red;">*</a></label>
                                                                        <input name="kelurahan_" id="kelurahan_"  class="form-control mb-2" placeholder="nama kelurahan" >
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <label for="" >Tanggal Perkiraan Kejadian<a style="color:red;">*</a></label>
                                                                        <input type="date" name="tgl_kejadian" id="tgl_kejadian"  class="form-control mb-2" >
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <label for="" >Waktu Perkiraan Kejadian<a style="color:red;">*</a></label>
                                                                        <input name="waktu_kejadian" id="waktu_kejadian"  class="form-control mb-2" placeholder="Contoh : Sekitar waktu Peringatan Hari Ulang Tahun Instansi tsb." >
                                                                    </div> 
                                                                    <div class="col-lg-12">
                                                                        <label for="" >Lampiran</label>
                                                                        <input type="file" name="file" id="file"  class="form-control mb-2"> 
                                                                    </div> 
                                                                    <div class="col-12 mb-2 mt-2">
                                                                    <label for="" >Uraian Pengaduan</label>
                                                                    <textarea name="isi" id="isi" rows="5" class="form-control mb-2" placeholder="Maksimum 1000 karakter"></textarea> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12 mb-lg-2">
                                                        
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-dark " style="margin-right:8px;">Reset</button>
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </form>       
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
                nama_terlapor: {
                    required: true
                },
                lokasi_kejadian: {
                    required: true
                },
                kecamatan_: {
                    required: true
                },
                kelurahan_: {
                    required: true
                },
                tgl_kejadian: {
                    required: true
                },
                waktu_kejadian: {
                    required: true
                },
                file: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                url = '/create_wbs';

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
                                text:'Terimakasi Atas Pengaduan Anda dan Akan Segera Kami Proses, Untuk Jawaban nya akan Kami Kirim ke E-mail yang tertera di form',
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