@extends('layout.layout_admin.index')
@section('title')
    Investasi
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Investasi</li>
    </ol>
    {{-- <h1 class="page-header">Data Artikel</h1> --}}
    <div class="panel panel-inverse">
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
                                <label>Tahun</label>
                                <select name="tahun_filter" id="tahun_filter" class="form-control">
                                    <option value="">- Pilih Tahun -</option>
                                    @foreach ($data['tahun'] as $val)
                                        <option value="{{$val->tahun}}">{{$val->tahun}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-6">
                                <label>Jenis</label>
                                <select name="jenis_filter" id="jenis_filter" class="form-control">
                                    <option value="">- Pilih Jenis -</option>
                                    <option value="realisasi">PMDN</option>
                                    <option value="proyek">PMA</option>
                                </select>
                            </div>
                            {{-- <div class="col-md-4 mb-6">
                                <label>Tipe</label>
                                <select name="tipe_filter" id="tipe_filter" class="form-control form-control-sm">
                                    <option value="INTERNAL">Internal</option>
                                    <option value="EKSTERNAL">Eksternal</option>
                                </select> 
                            </div> --}}
                        </div>   
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="filter"> Filter</button>
                                <button class="btn btn-warning" id="reset"> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading bg-blue-700 text-white">
            <h4 class="panel-title">Data Investasi</h4>
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
                            <th>Tahun</th>
                            <th>Triwulan</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
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

                                <input type="hidden" name="hidden_status" id="hidden_status"  value="add">
                                <input type="hidden" name="hidden_id" id="hidden_id" >
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" id="tahun" name="tahun" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Triwulan</label>
                                            <select name="triwulan" id="triwulan" class="form-control">
                                                <option value="">- Pilih Triwulan -</option>
                                                <option value="Triwulan I">Triwulan I</option>
                                                <option value="Triwulan II">Triwulan II</option>
                                                <option value="Triwulan III">Triwulan III</option>
                                                <option value="Triwulan IV">Triwulan IV</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <select name="jenis" id="jenis" class="form-control">
                                                <option value="">- Pilih Jenis -</option>
                                                <option value="realisasi">PMDN</option>
                                                <option value="proyek">PMA</option>
                                            </select>
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
    function get_tahun(){
        $.ajax({
            url: "/user/get_tahun_investasi",
            method: "GET",
            success:function(res){
                $('#tahun_filter').html(res.tahun);
            }
        })
    }

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
            deferLoading: 0,
            language: {
                "emptyTable": "Data tidak ditemukan - Silahkan Filter Data Pengaduan terlebih dahulu !"
            },
            ajax: {
                url: '/user/investasi_',
                method: 'POST',
                data: function(d){
                    d.tahun = $('#tahun_filter').val();
                    d.jenis = $('#jenis_filter').val();
                }
            },
          
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'tahun', name: 'tahun'},
                {data: 'triwulan', name: 'triwulan'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'jenis', name: 'jenis'},   
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
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
                        $('.judul-modal').text('Tambah Data Investasi');
                        $('#hidden_status').val('add');
                        $("#tahun").prop('disabled', false);
                        $("#triwulan").prop('disabled', false);
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
            $('.judul-modal').text('Edit Data Investasi');
            $('#hidden_status').val('edit');
            $('#hidden_id').val($(this).data('id'));
            $('#tahun').val($(this).data('tahun'));
            $('#triwulan').val($(this).data('triwulan'));
            $('#jumlah').val($(this).data('jumlah'));
            $('#jenis').val($(this).data('jenis'));
            $("#tahun").prop('disabled', true);
            $("#triwulan").prop('disabled', true);
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
                        url: "/user/delete_investasi",
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
                tahun: {
                    required: true
                },
                triwulan: {
                    required: true
                },
                jumlah: {
                    required: true
                },
                jenis: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/user/create_investasi';
                } else {
                    url = '/user/update_investasi';
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
                        if (data.result == false) {
                            Swal.fire({
                                title: 'Gagal',
                                text: "Gagal Tambah / Edit Data Realisasi Investasi",
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                            // table.ajax.reload();
                        } 

                        if (data.result == "ada") {
                            Swal.fire({
                                title: 'Peringatan!',
                                text: "Data Realisasi Investasi Sudah Ada!",
                                icon: 'warning',
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                            // table.ajax.reload();
                        } 
                        
                        if(data.result == true){
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: true
                            });
                            get_tahun();
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

        $(document).on('click', '#filter', function(){
            table.ajax.reload();
        })
    });
</script>
@endsection