@extends('template.master')
@section('title', 'Prospek')
@section('css')

<style>

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
        margin-top: 40px;
    }
    .stepwizard p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .stepwizard-step .btn.disabled {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    
    .button-step .btn {
        width: 140px;
        display: inline-block;
    }
    .button-step .btn-as-text {
        width: 60px;
    }
    
    .page-title { margin: auto }
    
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
    .clearfix .left, .clearfix .right {display: inline-block}
    .clearfix .left {float: left}
    .clearfix .right {float:right}
    .check-circle-container {
        position: relative;
    }
    .check-circle {
        display: hidden;
        position: absolute;
        top: -7px;
        right: -3px;
        font-size: 17px;
        color: green;
        font-weight: bold;
        text-shadow: 0px 1px #fff;
    }
    </style>
@endsection
@section('content')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="{{ Route('newProspectTypes') }}" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-secondary btn-circle disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-secondary btn-circle disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>

<div class="container">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="page-header">
	<h1 class="page-title">
		Pilih Jenis Prospect
	</h1>

</div>

    <div class="row row-cards">
        <div class="col col-3 mx-auto">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <tbody>
                            @foreach ($listProspectTypes as $type)
                            <tr>
                                <td width="10%" class="text-center"><i class="{{ $type->icon }} text-muted"></i></td>
                                <td width="80%" >{{ $type->name }}</td>
                                <td width="10%" class="text-center">
                                        <span class="check-circle-container">
                                    <a href="javascript:select({{ $type->id  }})"  class="btn btn-outline-info btn-sm pilihType" >Pilih</a>
                                    <i class="fe fe-check-circle check-circle"></i>
                                        </span>
                                </td>
                            </tr>
                            @endforeach

                                <td class="text-center" colspan="3">
                                    <a href="#" class="btn btn-outline-success"><i class="fe fe-plus mr-2"></i>Buat Baru</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards">
        <div class="col col-3 mx-auto">
            <a href="/prospect/new/prospect" class="btn btn-primary" id="btn-next">Berikutnya</a>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
require(['jquery'], function ($) {
    $(document).ready(function(){

        $(".check-circle").hide();
        $(".check-circle-container a").click(function(e){
            e.preventDefault();
            $(".check-circle").hide();
            $(this).closest(".check-circle-container").find(".check-circle").show();
    })
 
})

})
function select(prospect_id_type)
{
    //alert(prospect_id_type)
    next_btn = document.getElementById("btn-next")
    //reset parameters
    next_btn.href = next_btn.href.replace(/\?prospect_type_id=\d/, '')
    //add parameters in url
    next_btn.href = next_btn.href+'?prospect_type_id='+prospect_id_type


}


</script>
@endsection

