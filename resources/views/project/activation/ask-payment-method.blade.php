@extends('template.master')
@section('title', 'Aktifasi Proyek: Cara Pembayaran')

@section('content')
<div class="container">

    <form action="">
        <div class="card mx-auto" style="width: 400px;">
            <div class="card-header">
                <h3 class="card-title">Aktifasi Proyek <i class="fe fe-chevron-right"></i> Pembayaran Proyek</h3>
            </div>
            <div class="card-body">
                <p>
                    Pilih cara pembayaran proyek
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ route('project-detail', ['id' => $id]) }}" class="btn btn-secondary">Batal</a>
                    <a href="{{ route('project-activation-step3', ['id' => $id, 'choice' => \App\Project::PAYMENT_BY_TERMIN]) }}" class="btn btn-primary ml-auto">Termin</a>
                    <a href="{{ route('project-activation-step3', ['id' => $id, 'choice' => \App\Project::PAYMENT_BY_FULLCASH]) }}" class="btn btn-primary ml-auto">Full Cash</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
