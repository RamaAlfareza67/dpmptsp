@extends('layout.layout_admin.index')
@section('title')
    Informasi Publik
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Informasi Publik</li>
    </ol>
    {{-- <h1 class="page-header">Data Artikel</h1> --}}
    <div class="panel">
        <div class="panel-heading bg-blue-700 text-white">
            <h4 class="panel-title">Data Informasi Publik</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="table" class="table small table-striped table-bordered dataTables_wrapper" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Cover</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>file</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>   
</div>


<div class="modal  fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judul-modal" id="Modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="add-form">
                                <!--  -->
                                <input type="hidden" name="hidden_status" id="hidden_status"  value="add">
                                <input type="hidden" name="hidden_id" id="hidden_id" >
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" id="nama" name="nama" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control summernote" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori" id="kategori" class="form-control">
                                                <option value="">- Pilih Kategori -</option>
                                                @foreach ($data['kategori'] as $val)
                                                    <option value="{{$val->id}}">{{$val->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Cover</label>
                                            <input type="file" name="cover" id="cover"  accept="image/*" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" name="file" id="file"  accept="file/*" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                <button type="reset" class="btn btn-dark">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
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

        // $(".summernote").summernote({
        //     height: "300"
        // });

        var table = $('#table').DataTable({
            dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex me-0 me-md-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
            processing: true,
            serverSide: true,
            ajax: {
                url: '/user/informasi_publik_',
                method: 'POST',
                data: function(d){

                }
            },
          
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'cover', name: 'cover'},
                {data: 'nama', name: 'nama'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'kategori', name: 'kategori'},
                {data: 'file', name: 'file'},   
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: [3],
                    className: 'text-wrap width-200'
                    
                },
                {
                    targets: [1,5],
                    className: 'text-center'
                    
                },
             ],
            buttons: [{
                    text: '<i class="far fa-edit"></i> New',
                    className: 'btn btn-info',
                    action: function(e, dt, node, config) {
                        $('#add-form')[0].reset();
                        $('#Modal').modal('show');
                        $('.judul-modal').text('Tambah Informasi Publik');
                        $('#hidden_status').val('add');
                    }
                }, 
                {
                    text: '<i class="far fa-edit"></i> Kategori Informasi Publik',
                    className: 'btn btn-info',
                    action: function(e, dt, node, config) {
                        window.location.href = '/user/kategori_informasi_publik';
                    }
                },
                {
                    extend: 'excel',
                    title: 'Informasi Publik',
                    className: 'btn',
                    text: '<i class="far fa-file-code"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }] 

        });
       

        $(document).on('click', '.edit', function() {
            $('#add-form')[0].reset();
            $('#Modal').modal('show');
            $('.judul-modal').text('Edit Informasi Publik');
            $('#hidden_status').val('edit');
            $('#hidden_id').val($(this).data('id'));
            $('#nama').val($(this).data('nama'));
            $('#deskripsi').val($(this).data('deskripsi'));
            $('#kategori').val($(this).data('kategori'));
            // $(".summernote").summernote('code', $(this).data('isi'));
            // $('#file').val($(this).data('file'));
            // $('#status').val($(this).data('status'));

        });

       
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/user/delete_informasi_publik",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            table.ajax.reload();
                            Swal.fire({
                                title: data.title,
                                text:  data.status,
                                icon: data.icon,
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error');
                        }
                    });
                }
            })
        });

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                nama: {
                    required: true
                },
                deskripsi: {
                    required: true
                },
                cover: {
                    required: function() {
                        if ($('#hidden_status').val() == 'edit') {
                            return false;
                        } else {
                            return true;
                        }
                    },
                },
                file: {
                    required: function() {
                        if ($('#hidden_status').val() == 'edit') {
                            return false;
                        } else {
                            return true;
                        }
                    },
                },
            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/user/create_informasi_publik';
                } else {
                    url = '/user/update_informasi_publik';
                }

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
                                text: "Gagal Tambah / Edit Informasi Publik",
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: true
                            });
                            $('#Modal').modal('hide');
                            table.ajax.reload();
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