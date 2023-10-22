@extends('layout.layout_admin.index')
@section('title')
    Pengaduan
@endsection
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Pengaduan</li>
    </ol>
    {{-- <h1 class="page-header">Data Artikel</h1> --}}
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
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
                                        <label>Tanggal</label>
                                        <div class="input-group input-daterange">
											<input type="text" class="form-control datepicker-autoClose" name="start" id="start" placeholder="Date Start">
											<span class="input-group-text input-group-addon">to</span>
											<input type="text" class="form-control datepicker-autoClose" name="end" id="end" placeholder="Date End">
										</div>
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
                    <h4 class="panel-title">Data Pengaduan</h4>
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th width="40%">Pengaduan</th>
                                    <th>File Pendukung</th>
                                    <th>Jenis Pengaduan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>


<div class="modal  fade" id="detail_jawab_" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judul-modal-detail" id="detail_jawab_"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <h4>Pengaduan :</h4>
                    <div class="row table-responsive">
                        <table class="table small table-striped table-bordered dataTables_wrapper" width="100%">
                            <tr>
                                <td width="10%">Isi</td>
                                <td width="5%">:</td>
                                <td id="isi_pengaduan_"></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td id="tgl_pengaduan_"></td>
                            </tr>
                        </table>
                    </div>
                    <h4>Jawaban : </h4>
                    <div class="row table-responsive">
                        <table class="table small table-striped table-bordered dataTables_wrapper" width="100%">
                            <tr>
                                <td width="10%">Isi</td>
                                <td width="5%">:</td>
                                <td id="isi_jawaban_"></td>
                            </tr>
                            <tr>
                                <td>Petugas</td>
                                <td>:</td>
                                <td id="petugas_jawaban_"></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td id="tgl_jawaban_"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('js')
<script>
    let table_jenis_pengaduan;
$(document).ready(function() {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".datepicker-autoClose").datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
        }).datepicker("setDate",'now');

        // $(".summernote").summernote({
        //     height: "300"
        // });

        var table = $('#table').DataTable({
            dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex me-0 me-md-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
            processing: true,
            serverSide: true,
            // deferLoading: 0,
            // language: {
            //     "emptyTable": "Data tidak ditemukan - Silahkan Filter Data Pengaduan terlebih dahulu !"
            // },
            "lengthMenu": [
                [30, 60, 100, 200, -1],
                [30, 60, 100, 200, "All"]
            ],
            ajax: {
                url: '/user/pengaduan_',
                method: 'POST',
                data: function(d){
                    // d.tipe = $('#tipe_filter').val();
                    d.tanggal_start = $('#start').val();
                    d.tanggal_end = $('#end').val();
                }
            },
          
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'nama', name: 'nama'},
                {data: 'isi', name: 'isi'},   
                {data: 'file', name: 'file', orderable: false, searchable: false},
                {data: 'jenis', name: 'jenis'},   
                {data: 'created_date', name: 'created_date'},   
                {data: 'status', name: 'status'},   
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: [2],
                    className: 'text-wrap width-200'
                    
                },
                {
                    targets: [3,6,7],
                    className: 'text-center'
                    
                },
             ],
            rowCallback: function (row, data) {
                $('.popover_', row).webuiPopover({
                    title: 'Detail Pengadu',
                    animation: 'fade',
                    width: '500px',
                    html: true,
                    cache: false,
                    closeable: true,
                    dismissible:false,
                    type:'async',
                    url:'/user/detail_pengadu/'+data.id,
                    content: function(data){
                        return data
                    }
                });
            },
            buttons: [{
                    extend: 'excel',
                    title: 'Layanan Dinas',
                    className: 'btn',
                    text: '<i class="far fa-file-code"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }] 

        });
       
        

        $(document).on('click', '.detail_jawab', function(){
            $('#detail_jawab_').modal('show');
            $('.judul-modal-detail').text('Detail Pengaduan');
            $('#isi_pengaduan_').html($(this).data('isi'))
            $('#tgl_pengaduan_').html($(this).data('tgl'))
            $('#isi_jawaban_').html($(this).data('isi_jawaban'))
            $('#petugas_jawaban_').html($(this).data('petugas'))
            $('#tgl_jawaban_').html($(this).data('tgl_jawaban'))
        })

        $(document).on('click', '.accept', function() {
            var id = $(this).data('id');
            Swal.fire({
            title: 'Tanggapan / Jawaban',
            input: 'textarea',
            inputPlaceholder: 'Type your message here...',
            inputAttributes: {
                'aria-label': 'Type your message here'
            },
            showCancelButton: true,
            confirmButtonText: 'Tanggapi / Jawab',
            showLoaderOnConfirm: true,
            preConfirm: (jawab) => {
                // const jawab = document.getElementsByClassName("swal2-textarea");
                if (!jawab) {
                    Swal.showValidationMessage(`Tolong isi form Jawabannya`)
                }
                return { jawab:jawab }
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if(result.value){
                    
                    var tanggap = result.value.jawab;
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Dijawab!',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "/user/accept_rejact_pengaduan",
                                type: "POST",
                                data: {
                                    id: id,
                                    status: 'DIJAWAB',
                                    jawab: tanggap,
                                },
                                dataType: "JSON",
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
                }
            });
        });

        $(document).on('click', '.rejact', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Ditolak!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/user/accept_rejact_pengaduan",
                        type: "POST",
                        data: {
                            id: id,
                            status: 'DITOLAK'
                        },
                        dataType: "JSON",
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

        $(document).on('click', '#filter', function(){
            table.ajax.reload();
        })

    });
</script>
@endsection