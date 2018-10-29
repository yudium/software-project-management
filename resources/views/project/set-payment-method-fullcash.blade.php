@extends('template.master')
@section('title', 'Atur Pembayaran Proyek')

@section('content')
<div class="container">

    <form action="{{ route('set-payment-method-fullcash', ['id' => $id]) }}">
        <div class="card mx-auto" style="width: 400px; margin-top: 100px;">
            <div class="card-header">
                <h3 class="card-title">Pembayaran Proyek</h3>
            </div>
            <div class="card-body">
                <p>
                    Dengan menekan tombol <code>Full Cash</code> Anda mengatur pembayaran proyek sebagai sekali bayar (non-cicilan).
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="" class="btn btn-link">Batal</a>
                    <a href="" class="btn btn-outline-primary ml-auto">Full Cash</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
