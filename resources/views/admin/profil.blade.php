@extends('layout.layout_admin.index')
@section('title')
    Edit Profil
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Edit Profil</li>
    </ol>
    {{-- <h1 class="page-header">Data Artikel</h1> --}}
    <form id="add-form">
    <div class="row d-flex">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
            <div class="panel">
                <div class="panel-heading bg-blue-700 text-white">
                    <h4 class="panel-title">Preview Foto</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row mb-2">
                        <img id="imgPreview" src="#" alt="profil" style="width:-webkit-fill-available" />
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Upload</label>
                                <input type="file" name="foto" id="foto"  accept="image/*" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div> 
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12 layout-spacing">
            <div class="panel">
                <div class="panel-heading bg-blue-700 text-white">
                    <h4 class="panel-title">Preview Struktur Organisasi</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{$data['user']->name}}">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{$data['user']->username}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{$data['user']->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Retype Password</label>
                                <input type="password" name="repassword" id="repassword"  class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div style="align-items: right">
                        {{-- <button type="reset" class="btn btn-dark">Reset</button> --}}
                        <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </div>
            </div>  
        </div>    
    </div>
    </form> 
</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var image_ = "{{($data['user']->foto != null) ? asset($data['user']->foto) : asset('/uploads/noimage.jpg')}}";
        // console.log(image_);
        $("#imgPreview").attr("src", image_);

        $("#foto").change(function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgPreview")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                username: {
                    required: true
                },
                name: {
                    required: true
                },
                email: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                url = '/user/update_profil';

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
                                text: "Gagal Update Profil",
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
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });

        // $(document).on('click', '#filter', function(){
        //     table.ajax.reload();
        // })

    });
</script>
@endsection