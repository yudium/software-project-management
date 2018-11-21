@extends('template.master')
@section('title', 'Aktifasi Proyek: Cara Pembayaran')

@section('content')
<div class="container">

    <form action="">
        <div class="card mx-auto" style="width: 400px;">
            <div class="card-header">
                <h3 class="card-title">Konfirmasi Hapus Proyek Potensial</h3>
            </div>
            <div class="card-body">
                <p>
                    <div class="text-center">
                        <div>
                            Anda akan menghapus proyek potensial:
                        </div>
                        <b>{{ $project->project_name }}</b>
                    </div>
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ route('potential-project-list') }}" class="btn btn-secondary">Batal</a>
                    <a href="{{ route('potential-project-delete', ['id' => $id]) }}" class="btn btn-danger ml-auto">Hapus</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
