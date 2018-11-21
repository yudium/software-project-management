@extends('template.master')
@section('title', 'Agent Payment History')
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
        
        .page-title {
            margin: 0 auto;
        }
        </style>
@endsection
@section('content')
<div class="container">

    <div class="page-header">
	<h1 class="page-title">
		

		Riwayat Komisi Agen
	</h1>
	
</div>

    <div class="card mx-auto" style="width:800px">
	<div class="table-responsive">
		<table class="table table-hover table-outline table-vcenter text-nowrap card-table">
			<thead>
            <tr>
                
                <th>No</th>
                <th>Tanggal</th>
                <th>Sumber Pembayaran</th>
                <th>Jumlah</th>
            </tr>
			</thead>
			<tbody>		
            @foreach ($agent_commission_history as $commission_history)
			<tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{$commission_history->pay_date}}</td>
                <td>{{$commission_history->bank->name}}</td>
                <td>Rp.{{$commission_history->amount}}</td>
            </tr>
			@endforeach
		
			</tbody>
		</table>
	</div>

</div>

</div>
@endsection