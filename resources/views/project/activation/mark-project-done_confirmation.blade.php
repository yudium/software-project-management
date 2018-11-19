@extends('template.master')
@section('title', 'Atur Pembayaran Proyek')

@section('content')
<div class="container">

    <div class="card mx-auto" style="width: 400px; margin-top: 100px;">
        <div class="card-header">
            <h3 class="card-title">Konfirmasi</h3>
        </div>
        <div class="card-body">
            <p>
                Apakah aksi berikut yakin anda lakukan sekarang?
                <br>
                <table>
                <tr>
                    <td>Proyek</td>
                    <td>:</td>
                    <td><b>{{ $project->name }}</b></td>
                </tr>
                <tr>
                    <td>Aksi</td>
                    <td>:</td>
                    <td>
                        <b>
                            @if (\App\Project::IS_DONE_SUCCESS == $choice)
                                Tandai Proyek <span class="text-success">Sukses</span>
                            @endif
                            @if (\App\Project::IS_DONE_FAIL == $choice)
                                Tandai Proyek <span class="text-danger">Gagal</span>
                            @endif
                        </b>
                    </td>
                </tr>
                </table>

                <div class="alert alert-warning mt-4">
                    Anda tidak bisa membatalkan aksi ini.
                </div>
            </p>
        </div>
        <div class="card-footer">
            <div class="d-flex">
                <a href="{{ route('project-detail', ['id' => $project->id]) }}" class="btn btn-link">Batal</a>
                <a href="{{ route('confirmed-mark-project-done', ['id' => $project->id, 'choice' => $choice]) }}" class="btn btn-outline-danger ml-auto">Ya, Tandai</a>
            </div>
        </div>
    </div>

</div>
@endsection
