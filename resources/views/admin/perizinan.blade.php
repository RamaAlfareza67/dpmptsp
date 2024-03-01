@extends('layout.layout_admin.index')
@section('title')
    Perizinan
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Perizinan</li>
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
                                <label>Kategori</label>
                                <select name="kategori_filter" id="kategori_filter" class="form-control">
                                    <option value="">- Pilih Jenis -</option>
                                    @foreach ($data['kategori'] as $val)
                                        <option value="{{$val->id}}">{{$val->nama}}</option>
                                    @endforeach
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
            <h4 class="panel-title">Data Perizinan</h4>
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
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
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
                                            <label>Tahun</label>
                                            <input type="number" id="tahun" name="tahun" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <select name="bulan" id="bulan" class="form-control">
                                                <option value="">- Pilih Bulan -</option>
                                                <option value="JANUARI">JANUARI</option>
                                                <option value="FEBRUARI">FEBRUARI</option>
                                                <option value="MARET">MARET</option>
                                                <option value="APRIL">APRIL</option>
                                                <option value="MEI">MEI</option>
                                                <option value="JUNI">JUNI</option>
                                                <option value="JULI">JULI</option>
                                                <option value="AGUSTUS">AGUSTUS</option>
                                                <option value="SEPTEMBER">SEPTEMBER</option>
                                                <option value="OKTOBER">OKTOBER</option>
                                                <option value="NOVEMBER">NOVEMBER</option>
                                                <option value="DESEMBER">DESEMBER</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="total" id="total" class="form-control ">
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
            url: "/user/get_tahun_perizinan",
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
                url: '/user/perizinan_',
                method: 'POST',
                data: function(d){
                    d.tahun = $('#tahun_filter').val();
                    d.kategori = $('#kategori_filter').val();
                }
            },
          
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'kategori', name: 'kategori'},
                {data: 'tahun', name: 'tahun'},
                {data: 'bulan', name: 'bulan'},
                {data: 'total', name: 'total'},  
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: [0,5],
                    className: 'text-center'
                    
                },
             ],
            buttons: [{
                    text: '<i class="far fa-edit"></i> New',
                    className: 'btn btn-info',
                    action: function(e, dt, node, config) {
                        $('#add-form')[0].reset();
                        $('#Modal').modal('show');
                        $('.judul-modal').text('Tambah Data Perizinan');
                        $('#hidden_status').val('add');
                    }
                }, 
                {
                    text: '<i class="far fa-edit"></i> Kategori Perizinan',
                    className: 'btn btn-info',
                    action: function(e, dt, node, config) {
                        window.location.href = '/user/kategori_perizinan';
                    }
                },
                {
                    extend: 'excel',
                    title: 'Perizinan',
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
            $('.judul-modal').text('Edit Data Perizinan');
            $('#hidden_status').val('edit');
            $('#hidden_id').val($(this).data('id'));
            $('#tahun').val($(this).data('tahun'));
            $('#bulan').val($(this).data('bulan'));
            $('#total').val($(this).data('total'));
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
                        url: "/user/delete_perizinan",
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
                bulan: {
                    required: true
                },
                total: {
                    required: true
                },
                kategori: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/user/create_perizinan';
                } else {
                    url = '/user/update_perizinan';
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
                                text: "Gagal Tambah / Edit Data Perizinan",
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                            // table.ajax.reload();
                        } else {
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