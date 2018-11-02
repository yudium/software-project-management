@extends('template.master')
@section('title', 'Agent | Activation')
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
        
        h1.page-title {
            margin: 0 auto;
        }
        </style>
@endsection
@section('content')
<div class="container">

    <div class="page-header">
	<h1 class="page-title">
		Kode aktifasi akun agen
	</h1>
</div>

    <div class="card mx-auto" style="width: 300px">
        <div class="card-body">
            Silakan berikan kode ini kepada Agen:
        <p class="text-center" style="font-size: 30px">{{$usernameKode}}</p>
        <center><a href="{{route('agentList')}}" class="btn btn-primary">Kembali</a></center>
        </div>
    </div>

</div>
@endsection