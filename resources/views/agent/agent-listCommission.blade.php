@extends('template.master')
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
		Komisi Agen
	</h1>	
</div>

    <div class="card">
		<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="listCommission">
			<thead>
            <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th>Agen</th>
                <th>Username</th>
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
 require(['datatables', 'jquery','toastr'],function (datatable, $,toastr) {
    $('#listCommission').DataTable({
            serverSide:true,
            ajax: "{{ route('getListCommission') }}",
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
                        return '<div>'+data+'</div><div class="small text-muted">Registered: '+row['created_at']+'</div>';
                    },
                    orderable:false,
                    targets:1,
                },
                {
                    render:function(data,type,row){
                       return data;   
                    },
                    orderable:false,
                    targets:2,
                },        
                
             
            ],
            columns: [
                { data: 'photo_evidance' },  
                { data: 'name' },
                { data: 'username' },
                { data: 'options', orderable: false, searchable: false },
            ]
 })
})
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

</script>
@endsection