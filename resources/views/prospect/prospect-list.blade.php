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
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}<span aria-hidden="true"></span><button type="button"
            class="close" data-dismiss="alert" aria-label="Close"></button></p>
        @endif
    <div class="page-header">
	<h1 class="page-title">
		Daftar Prospect
	</h1>
</div>
    <div class="card">
	
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
                    <tr>
                            <td class="text-center" colspan="8">
                                <div class="loader mx-auto"></div>
                            </td>
                        </tr>
			</tbody>
		</table>


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
            ordering: false,
            ajax:"{{ route('getProspect') }}",
            columns: [
                {data:'photo',name:'photo'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data:'business_relationship_status',name:'business_relationship_status'},
                {data:'options',name:'options'},
               
            ],
            columnDefs:[{
                targets: 0,
                orderable:false,
                render: function ( data, type, row ) {
                        if (row['photo']) {
                            return `
                                <div class="avatar d-block" style="background-image: url( ${ require.toUrl('storage/clientImage/' + row['photo']) } )"></div>
                            `;
                        }

                        return `
                            <div class="avatar avatar-placeholder d-block"></div>
                        `;
                    },
                },
                {
                    targets: 1,
                    data:'name',
                    render: function ( data, type, row ) {
                       return '<div>'+data+'</div><div class="small text-muted">Registered: '+row['created_at']+'</div>';
                    },
                },
                {
                    targets: 2,
                    data:'type',
                    orderable:false,
                    render: function ( data, type, row ) {
                        return '<div class="text-center"><i class="icon-box" style="background: #e9ecef"><i style="color: #868e96" class="'+row['type']['icon']+'"></i></i><div class="small text-muted">' +
                                data.name + '</div></div>';
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
                    data:'business_relationship_status',
                    orderable:false,
                    render: function ( data, type, row ) {
                       return '<span class="status-icon bg-success"></span>'+data+'';
                    },
                },                
            ]

        })
    })
})

 function deleteProspect(id) {
                // alert(id)
                if(confirm('Apakah anda ingin menghapus data ini?'))
                {
                    
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : "{{url('prospect/deleteProspect')}}"+"/"+id,
                        type: "POST",
                        dataType: "JSON",
                    }).done(function(res){
                            console.log(res)
                            window.location.reload();
                            toastr.success('Berhasil menghapus data', {timeOut: 5000});
                    })


                }
            }
</script>
@endsection