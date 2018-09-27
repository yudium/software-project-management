@extends('template.master')
@section('title', 'Prospek')
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
		Daftar Prospect
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
		<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="prospectTable">
			<thead>
            <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th>Nama</th>
                <th class="text-center">Jenis</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Status Hub. Bisnis</th>
                <th class="text-center"><i class="icon-settings"></i></th>
            </tr>
			</thead>
			<tbody>		
			{{-- <tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box" style='background: #e9ecef'><i style='color: #868e96' class="fe fe-user"></i></i>
                    <div class="small text-muted">
                        Individu
                    </div>    
                </td>
                <td>
                    0851284617468 <small>(ada 1 lagi)</small>
                </td>
                <td>
                    example@gmail.com <small>(ada 1 lagi)</small>
                </td>
                <td>
                    <span class="status-icon bg-success"></span> Baik
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                    </div>
                    </div>
                </td>
            </tr>		
			<tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box" style='background: #e9ecef'><i style='color: #868e96' class="fe fe-user"></i></i>
                    <div class="small text-muted">
                        Individu
                    </div>    
                </td>
                <td>
                    0851284617468 <small>(ada 1 lagi)</small>
                </td>
                <td>
                    example@gmail.com <small>(ada 1 lagi)</small>
                </td>
                <td>
                    <span class="status-icon bg-success"></span> Baik
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                    </div>
                    </div>
                </td>
            </tr>
			<tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box" style='background: #e9ecef'><i style='color: #868e96' class="fe fe-user"></i></i>
                    <div class="small text-muted">
                        Individu
                    </div>    
                </td>
                <td>
                    0851284617468 <small>(ada 1 lagi)</small>
                </td>
                <td>
                    example@gmail.com <small>(ada 1 lagi)</small>
                </td>
                <td>
                    <span class="status-icon bg-success"></span> Baik
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                    </div>
                    </div>
                </td>
            </tr>
			<tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box" style='background: #e9ecef'><i style='color: #868e96' class="fe fe-user"></i></i>
                    <div class="small text-muted">
                        Individu
                    </div>    
                </td>
                <td>
                    0851284617468 <small>(ada 1 lagi)</small>
                </td>
                <td>
                    example@gmail.com <small>(ada 1 lagi)</small>
                </td>
                <td>
                    <span class="status-icon bg-success"></span> Baik
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                    </div>
                    </div>
                </td>
            </tr>
			<tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box" style='background: #e9ecef'><i style='color: #868e96' class="fe fe-user"></i></i>
                    <div class="small text-muted">
                        Individu
                    </div>    
                </td>
                <td>
                    0851284617468 <small>(ada 1 lagi)</small>
                </td>
                <td>
                    example@gmail.com <small>(ada 1 lagi)</small>
                </td>
                <td>
                    <span class="status-icon bg-success"></span> Baik
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                    </div>
                    </div>
                </td>
            </tr>
			<tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box" style='background: #e9ecef'><i style='color: #868e96' class="fe fe-user"></i></i>
                    <div class="small text-muted">
                        Individu
                    </div>    
                </td>
                <td>
                    0851284617468 <small>(ada 1 lagi)</small>
                </td>
                <td>
                    example@gmail.com <small>(ada 1 lagi)</small>
                </td>
                <td>
                    <span class="status-icon bg-success"></span> Baik
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                    </div>
                    </div>
                </td>
            </tr> --}}
			
			</tbody>
		</table>
	</div>

</div>

</div>
@endsection
@section('js')
<script>
    require(['datatables', 'jquery'], function (c3, $) {
    $(document).ready(function(){
       let table = $('#prospectTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('getProspect') }}",
            columns: [
                {data:'photo',name:'photo'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data:'status_hub',name:'status_hub'},
                {data:'options',name:'options'},
               
            ],
            columnDefs:[{
                targets: 0,
                render: function ( data, type, row ) {
                   return '<div class="avatar d-block"><span class="avatar-status bg-green"></span></div>';
                    }
                },
                {
                    targets: 1,
                    data:'name',
                    render: function ( data, type, row ) {
                       return '<div>'+data+'</div><div class="small text-muted">Registered: Mar 19, 2018</div>';
                    },
                },
                {
                    targets: 2,
                    data:'type',
                    render: function ( data, type, row ) {
                       return '<div class="text-center"><i class="icon-box" style="background: #e9ecef"><i style="color: #868e96" class="fe fe-user"></i></i><div class="small text-muted">'+data+'</div></div>';
                    },
                },
                {
                    targets: 3,
                    data:'phone',
                    render: function ( data, type, row ) {
                       return data;
                    },
                },
                {
                    targets: 4,
                    data:'email',
                    render: function ( data, type, row ) {
                       return data;
                    },
                },
                {
                    targets: 5,
                    data:'status_hub',
                    render: function ( data, type, row ) {
                       return '<span class="status-icon bg-success"></span>'+data+'';
                    },
                },
                
            ]

        })
    })
})
</script>
@endsection