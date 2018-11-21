@extends('template.master')
@section('title', 'Termin: Daftar')

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
    background-size: cover;
    color: #a4a3a3; /* for icon */
}

#photo-preview i { /* icon */
    font-size: 128px;
}

div.separator {
    margin-top: 30px;
    margin-bottom: 10px;
    border-top: 1px dotted #dcdcdc;
}
</style>
@endsection

@section('content')
<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Pembayaran
        </h1>
    </div>

    <form action="{{ route('store-termin-payment', ['termin_detail_id' => $termin_detail->id]) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row row-cards">
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        @include('includes.cards.client-with-project-info', [
                            'project' => $project,
                        ])
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
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data</h3>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="form-group">
                            <label class="form-label">Sumber pembayaran</label>
                            <select name="bank" class="form-control custom-select" required>
                                <option value="">-- Pilih --</option>

                                {{-- NOTE: be careful with "cash" value. It should same as in TerminController@storePayment value --}}
                                <option value="cash">[Pembayaran dilakukan secara Cash]</option>

                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }} -- {{ $bank->account_number }} -- {{ $bank->owner }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('includes.form-element.datepicker', [
                            'label' => 'Tanggal pembayaran',
                            'id' => 'pay-date',
                            'name' => 'pay_date',
                            'required' => true,
                        ])
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Total bayar</label>
                                    <input class="form-control" name="example-disabled-input" value="Rp.@money($termin_detail->amount)" disabled="" type="text">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Yang sudah dibayar</label>
                                    <input class="form-control" name="example-disabled-input" value="Rp.@money($total_paid_amount)" disabled="" type="text">
                                </div>
                            </div>
                        </div>
                        @include('includes.form-element.input-money', [
                            'id' => 'amount',
                            'name' => 'amount',
                            'class' => 'form-control',
                            'placeholder' => '',
                            'required' => true,
                        ])
                        <div class="row">
                            <div class="col-6"><button class="btn btn-primary btn-block">Simpan</button></div>
                            <div class="col-6"><button class="btn btn-outline-primary btn-block">Batal</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="h5">Termin Pembayaran</div>
                                <div class="display-4 font-weight-bold mb-4 text-red">#{{ $termin_detail->serial_number }}</div>
                            </div>
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
    require(['jquery', 'global_functions'], function($, g) {
        $(document).ready(function(){
            $('form').submit(function(){
                // take value from DB with laravel
                let total_amount = {{ $termin_detail->amount }};
                let paid_amount = {{ $total_paid_amount }};

                // <input id="amount">
                let input_amount = Number(g.cleanValMask( $('#amount').val() ));

                // we don't need validate minus value because input mask prevent
                // user to input minus value
                if ((input_amount+paid_amount) > total_amount) {
                    alert('Jumlah uang tidak valid');
                    // abort submit
                    return false;
                }
            });

            /**
             * Upload preview
             */
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
