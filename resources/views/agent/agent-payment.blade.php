@extends('template.master')
@section('title', 'Agent Payment')
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

#photo-preview {
    width: 8rem;
	height: 8rem;
    margin: 0 auto;
	background: #cecece;
	color: #a4a3a3; /* for icon */
}

#photo-preview .fe {
    font-size: 128px;
}
</style>
@endsection
@section('content')
<div class="container">

    <div class="page-header">
	<h1 class="page-title">
		Pembayaran Komisi Agen
	</h1>
</div>
<form action="{{ route('storePaymentAgent', ['id_payment_detail' => $id]) }}" method="post" enctype="multipart/form-data">
        @csrf
	<div class="row row-cards">
        <div class="col-3">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Agen</h3>
						</div>
						<div class="card-body d-flex flex-column">
							<div class="d-flex align-items-center pt-2 mt-auto">
								<div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
								<div>
								<a href="./profile.html" class="text-default">{{$agent->name}}</a>
								<small class="d-block text-muted">Username: {{$agent->username}}</small>
								</div>
								<div class="ml-auto">
									<a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
						<div class="card">
								<div class="card-body">
									<h6 class="text-center">Unggah Bukti</h6>
									<div id="photo-preview" class="mb-4 mt-4">
										<i class="fe fe-image"></i>
									</div>
									<div class="form-group">
										<div class="custom-file">
											<input id="photo" class="custom-file-input" name="photo" type="file">
											<label class="custom-file-label">Choose file</label>
										</div>
									</div>
									<p id="photo-message" class="text-muted"></p>
								</div>
							</div>
				</div>
			</div>
		</div>
		<div class="col-5">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data</h3>
				</div>
				<div class="card-body d-flex flex-column">
					<div class="form-group">
						<label class="form-label">Sumber pembayaran</label>
						<select class="form-control custom-select" name="bank">
							@foreach ($listBank as $bank)
						<option value={{$bank->id}}>{{$bank->name}} - {{$bank->account_number}} - {{$bank->owner}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						
							@include('includes.form-element.datepicker', [
								'label' => 'Tanggal pembayaran',
								'id' => 'pay-date',
								'name' => 'pay_date',
							])
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">Total komisi</label>
								<input class="form-control" name="example-disabled-input" value="Rp.@money($agentCommission->amount)" disabled="" type="text">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">Komisi sudah diberikan</label>
								<input class="form-control" name="example-disabled-input" value="Rp.@money($totalCommission)" disabled="" type="text">
							</div>
						</div>
					</div>
					<label class="form-label">Sisa pembayaran</label>
					@include('includes.form-element.input-money', [
						'id' => 'amount',
						'name' => 'amount',
						'class' => 'form-control',
						'placeholder' => '',
					])
					<div class="row">
						<div class="col-6"><button class="btn btn-primary btn-block">Simpan</button></div>
						<div class="col-6"><button class="btn btn-outline-primary btn-block">Batal</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

</div>
@endsection
@section('js')
<script type="text/javascript">
    require(['jquery'], function($) {
        $(document).ready(function(){
            var imagesPreview = function (input, place, place2 = '') {
                if (input.files) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $(place).css('background-image', 'url('+event.target.result+')');
                    }
                    $(place2).html('Photo changed (not saved)');
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $(place2).html('Please select a file');
                }
            };
            $('#photo').on('change', function () {
                imagesPreview(this, '#photo-preview', '#photo-message');
                $('#photo-preview i').remove();
            });
        });
    });
</script>
@endsection