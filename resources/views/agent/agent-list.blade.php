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
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}
            <span aria-hidden="true"></span><button type="button"
            class="close" data-dismiss="alert" aria-label="Close"></button></p>
    @endif
    <div class="page-header">
        <h1 class="page-title">
            Daftar Agen
        </h1>
    </div>

    <div class="card">
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
                        <th ></th>
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
        $('#agentTable').DataTable({
            serverSide:true,
            ajax: "{{ route('getAgent') }}",
            order:[],
            columnDefs:[
                {
                    render:function(data,type,row){
                        if (row['photo']) {
                            return `
                                <div class="avatar d-block" style="background-image: url( ${ require.toUrl('storage/clientImage/' + row['photo']) } )"></div>
                            `;
                        }

                        return `
                            <div class="avatar avatar-placeholder d-block"></div>
                        `;
                },
                {
                    render:function(data,type,row){
                        console.log(row)
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
                {
                    render:function(data,type,row){
                       return  data ? formatRupiah(data, "Rp. ") : "Belum Ada";   
                    },
                    orderable:false,
                    targets:3,
                },
                {
                    render:function(data,type,row){
                        return data;
                    },
                    orderable:false,
                    targets:4,
                },
                {
                    render:function(data,type,row){
                        let phone_html = '';
                        data.forEach(function(value,index,array){
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
                    orderable:false,
                    targets:5,
                },
                {
                    render:function(data,type,row){
                        let email_html = '';
                        data.forEach(function(value,index,array){
                        email_html +=value.email+'<br>';
                        });
                        return email_html;
                        
                    },
                    orderable:false,
                    targets:6,
                },
            ],
            columns: [
                { data: 'photo' },
                { data: 'name' },
                { data: 'username' },
                { data: 'total_com' },
                { data: 'city' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'options' },
            ]
        });
    $(document).ready(function(){

     $('#agentTable').on('click', '.deleteAgent',function(e){
         e.preventDefault()
         idAgent = $(this).data('id-agent')
         if(confirm('Apakah anda ingin menghapus data ini?'))
                {
                    
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : "{{url('agent/deleteAgent')}}"+"/"+idAgent,
                        type: "POST",
                        dataType: "JSON",
                    }).done(function(res){
                            console.log(res)
                            window.location.reload();
                            toastr.success('Berhasil menghapus data', {timeOut: 5000});
                    })


                }
     });
    })
    });
 
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
