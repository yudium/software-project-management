@extends('template.master')
@section('title', 'Atur Pembayaran Proyek')

@section('content')
<div class="container">

    <div class="card mx-auto" style="width: 400px; margin-top: 100px;">
        <div class="card-body">
            <p>
                Manakah kondisi proyek sekarang?
            </p>
        </div>
        <div class="card-footer">
            <div class="btn-list text-right">
                <a href="" class="btn btn-link">Batal</a>
                <a href="{{ route('mark-project-done-confirmation', ['id' => $id, 'choice' => \App\Project::IS_DONE_FAIL]) }}" class="btn btn-outline-danger ml-auto">Gagal</a>
                <a href="{{ route('mark-project-done-confirmation', ['id' => $id, 'choice' => \App\Project::IS_DONE_SUCCESS]) }}" class="btn btn-outline-success ml-auto">Sukses</a>
            </div>
        </div>
    </div>

</div>
@endsection
