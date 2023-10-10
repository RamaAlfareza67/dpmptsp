@extends('layout.layout_admin.index')
@section('title')
    Visi - Misi 
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Visi - Misi </li>
    </ol>
    {{-- <h1 class="page-header">Data Artikel</h1> --}}
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="panel">
            <div class="panel-heading bg-blue-700 text-white">
                <h4 class="panel-title">Form Visi Misi</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <form id="add-form">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" id="judul" name="judul" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->judul}}" >
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="hidden" id="isi_hidden" value="{{$data['data']->isi}}">
                                <textarea name="isi" id="isi" class="form-control deskripsi" rows="3" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div style="align-items: right">
                        <button type="reset" class="btn btn-dark">Reset</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>   
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

        $(".deskripsi").summernote({
            height: "300"
        });

        

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                judul: {
                    required: true
                },
                isi: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                url = '/user/create_visi_misi';

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
                                text: "Gagal Update Visi Misi",
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

        var isi_ = $('#isi_hidden').val();
        $('.deskripsi').summernote('code', isi_);
        // $(".summernote").summernote('code', isi_);

        // $(document).on('click', '#filter', function(){
        //     table.ajax.reload();
        // })

    });
</script>
@endsection