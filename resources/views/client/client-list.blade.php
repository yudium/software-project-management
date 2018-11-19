@extends('template.master')
@section('title', 'Client')
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
		Daftar Client
	</h1>	
</div>

    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="form-group">
     
            </div>
        </div>
    </div>

    <div class="card">
	<div class="table-responsive">
		<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="clientTable">
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
       let table = $('#clientTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax:"{{ route('getClient') }}",
            columns: [
                {data:'photo'},
                {data: 'name'},
                {data: 'type.name'},
                {data: 'phone'},
                {data: 'email'},
                {data:'business_relationship_status'},
                {data:'options',},
               
            ],
            columnDefs:[{
                targets: 0,
                orderable:false,
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
                    orderable:false,
                    render: function ( data, type, row ) {
                       return '<div class="text-center"><i class="icon-box" style="background: #e9ecef"><i style="color: #868e96" class="fe fe-user"></i></i><div class="small text-muted">'+data+'</div></div>';
                    },
                },
                {
                    targets: 3,
                    data:'phone',
                    orderable:false,
                    render: function ( data, type, row ) {
                        let phone_html = '';
                        let more = 0;

                        data.forEach(function(value, index, array){
                            // only show 2 item
                            if (index < 2) {
                                phone_html += value.phone + '<br>';
                            } else {
                                // count the number of item after 2 item
                                more++;
                            }
                        });

                        // show information about many item (phone number) that not displayed
                        if (more > 0) phone_html += `<span class="badge badge-info">${more}+ more</span>`

                       return phone_html;
                    },
                },
                {
                    targets: 4,
                    data:'email',
                    orderable:false,
                    render: function ( data, type, row ) {
                    let email_html = '';
                    let more = 0;

                    data.forEach(function(value,index,array){
                        if (index < 2) {
                            email_html +=value.email+'<br>';
                        } else {
                            // count the number of item after 2 item
                            more++;
                        }
                    });

                    // show information about many item (email) that not displayed
                    if (more > 0) email_html += `<span class="badge badge-info">${more}+ more</span>`

                    return email_html;
                    },
                },
                {
                    targets: 5,
                    data:'status_hub',
                    orderable:false,
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
