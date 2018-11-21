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
</style>
@endsection

@section('content')
<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Histori Pembayaran
        </h1>
    </div>

    <div class="row row-cards">
        <div class="col-2">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h5">Termin Pembayaran</div>
                    <div class="display-4 font-weight-bold mb-4 text-red">#{{ $termin_detail->serial_number }}</div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Tanggal bayar</th>
                            <th>Sumber Pembayaran</th>
                            <th>Jumlah</th>
                            <th>Foto Bukti</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if ($termin_payments->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                        @endif

                        @foreach ($termin_payments as $termin_payment)
                        <tr>
                            <td class="text-center">{{ date('d M Y', strtotime($termin_payment->pay_date)) }}</td>
                            <td>
                            @if ($termin_payment->bank_id)
                                {{ $termin_payment->bank->name }}
                            @else
                                <span class="tag tag-blue">Cash</span>
                            @endif
                            </td>
                            <td>Rp.{{ $termin_payment->amount }}</td>
                            <td class="text-right">
                                @if ($termin_payment->photo_evidance)
                                    <a target="_blank" class="btn btn-secondary btn-sm" href="{{ asset("storage/termin_photos/$termin_payment->photo_evidance") }}">Buka</a>
                                @else
                                    <small><i>Tidak ada</i></small>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h6>Sisa bayar:</h6>
                    <!-- TODO: below code -->
                    <span class="mt-2">Rp. {{ $termin_detail->amount - $termin_detail->paid_amount }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
