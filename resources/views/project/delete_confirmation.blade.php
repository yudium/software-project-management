@extends('template.master')
@section('title', 'Aktifasi Proyek: Cara Pembayaran')

@section('content')
<div class="container">

    <form action="">
        <div class="card mx-auto" style="width: 400px;">
            <div class="card-header">
                <h3 class="card-title">Konfirmasi Hapus Proyek</h3>
            </div>
            <div class="card-body">
                <p>
                    <div class="text-center">
                        <div>
                            Anda akan menghapus proyek:
                        </div>
                        <b>{{ $project->name }}</b>
                    </div>
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ route('project-detail', ['id' => $id]) }}" class="btn btn-secondary">Batal</a>
                    <a href="{{ route('project-delete', ['id' => $id]) }}" class="btn btn-danger ml-auto">Hapus</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
