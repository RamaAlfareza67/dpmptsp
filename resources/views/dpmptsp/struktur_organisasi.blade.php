@extends('layout.layout.layout')
@section('content')

<div id="page-title" class="page-title has-bg">
    <div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-8.jpg) center 0px / cover no-repeat"></div>
    <div class="container">
        <h1 style="color:black;">Struktur <a style="color:red;">Organisasi</a></h1>
        <p>Struktur Organisasi Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</p>
    </div>
</div>
<div id="content" class="content">
    <!-- begin container -->
    <div class="container">
<!-- end #page-title -->
        <div class="row">
        <ul id="tree-data" style="display:none">
            <li id="root">
                Direktorat Utama
                <ul>
                    <li id="node1">
                       Direktorat Operasi
                       <ul>
                            <li id="node6">
                            Divisi Layanan
                            </li>
                            <li id="node6">
                            Divisi Kepersetaan
                            <ul>
                                <li id="node6">
                                Divisi Administrasi
                                </li>
                                <li id="node6">
                                Divisi Sosialisasi
                                </li>
                            </ul>
                            </li>
                            <li id="node6">
                            Divisi Aktuaria
                            </li>
                        </ul>
                    </li>
                    <li id="node2">
                        Direktorat Investasi
                        <ul>
                            <li id="node6">
                            Divisi Investasi
                            Pasar Uang
                            </li>
                            <li id="node6">
                            Divisi Investasi
                            Pasar Modal
                            </li>
                            <li id="node6">
                            Analisis Investasi
                            </li>
                        </ul>
                    </li>
                    <li id="node3">
                       Direktorat Umum
                        
                    </li>
                    <li id="node4">
                       Direktorat Keuangan
                       
                    </li>
                    <li id="node5">
                       Direktorat Informasi
                    </li>
                </ul>
                
            </li>
    </ul>
    <div id="tree-view"></div>  
    @section('js')
<script>
    $(document).ready(function () {
    // create a tree
    $("#tree-data").jOrgChart({
        chartElement: $("#tree-view"), 
        nodeClicked: nodeClicked
    });
    // lighting a node in the selection
    function nodeClicked(node, type) {
        node = node || $(this);
        $('.jOrgChart .selected').removeClass('selected');
            node.addClass('selected');
        }
    });
</script>      
 @endsection
        
</div>
</div>

@endsection

