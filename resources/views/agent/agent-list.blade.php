@extends('template.master')
@section('title', 'Agent')
@section('css')
<style>
    .clearfix .left, .clearfix .right {display: inline-block}
    .clearfix .left {float: left}
    .clearfix .right {float:right}
    
    .icon-box {
        width: 2.5rem;
        height: 1.5rem;
        display: inline-block;
        background: no-repeat center/100% 100%;
        vertical-align: bottom;
        font-style: normal;
        box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
        border-radius: 2px;
    }
    </style>
@endsection
@section('content')
<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Daftar Agen
        </h1>
    </div>

    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="form-group">
                <div class="input-icon mb-3">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="agentTable">
                <thead>
                    <tr>
                        <th class="text-center w-1"><i class="icon-people"></i></th>
                        <th>Agen</th>
                        <th>Username</th>
                        <th>Komisi Global</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th class="text-center"><i class="icon-settings"></i></th>
                    </tr>
                </thead>
                <tbody>

                    <tr
                        
                        <td>
                            elizabeth123
                        </td>
                        <td>
                            Rp.500.000
                        </td>
                        <td>
                            Jakarta
                        </td>
                        <td>
                            0851284617468 <small>(ada 1 lagi)</small>
                        </td>
                        <td>
                            example@gmail.com <small>(ada 1 lagi)</small>
                        </td>
                        <td class="text-center">
                            <a href='agen-aktifkan-akun.html' class="btn btn-primary btn-sm mr-3">Aktifkan akun</a>
                            <div class="item-action dropdown">
                                <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i>
                                        Detail </a>
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i>
                                        Termin Pembayaran </a>
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i>
                                        Progress Tracker</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i>
                                        Separated link</a>
                                </div>
                            </div>
                        </td>
                    </tr>






                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
<script>
    require(['datatables', 'jquery']),
        function (datatable, $) {
        $('#agentTable').Datatable({
            serverSide:true,
            ajax: "{{ url('agent/getAgent') }}",
            order:[],
            columnDefs:[
                {
                    render:function(data,type,row){
                        return ' <div class="text-center"><div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)"><span class="avatar-status bg-green"></span></div></div>';
                    },
                    orderable:false,
                    targets:0,
                },
                {
                    render:function(data,type,row){
                        return '<div>'+data+'</div><div class="small text-muted">Registered: Mar 19, 2018</div>';
                    },
                    targets:1,
                },
                {
                    render:function(data,type,row){
                        return data;
                    }
                }
            ]
        })
        });
</script>