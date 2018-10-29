@extends('template.master')
@section('title', 'Detail Proyek')

@section('css')
<style>
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.multiple-field-js {
    background: #f8f8f8;
    border: none;
}
.multiple-field-copy-target .fe {
    color: #a19090
}
</style>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Detail Proyek
            </h1>
        </div>

        <div class="row row-cards">
            <div class="col-4">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card card-client">
                            <div class="card-header">
                                <h3 class="card-title">Data Client</h3>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center pt-2 mt-auto">
                                    <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                                    <div>
                                        <a href="./profile.html" class="text-default">{{ $project->client->name }}</a>
                                        <small class="d-block text-muted">{{ $project->client->phone()->first()->phone }}</small>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
                                    </div>
                                </div>
                                <div class="info mt-3">
                                    <div class="clearfix">
                                        <div class="left"></div>
                                        <div class="right">
                                            <span class="badge badge-success">{{ ucfirst($project->client->type->name) }}</span>
                                            <span class="badge badge-info">{{ ucfirst($project->client->status_text) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Person In Charge</h4>
                            </div>
                            <table class="table card-table">
                            <tbody>
                                @foreach ($project->PICs as $PIC)
                                <tr>
                                    <td width="1">#{{ $loop->iteration }}</td>
                                    <td>{{ $PIC->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-client">
                            <div class="card-header">
                                <h3 class="card-title">Link</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label" for="backup_link">Link backup source code</label>
                                    <div class="form-control-plaintext">
                                        <small>
                                            <i>@echoIf('kosong', count($project->backup_source_code_project_links) === 0)</i>
                                        </small>
                                        @foreach ($project->backup_source_code_project_links as $link)
                                            <a href="{{ $link->link_text }}">{{ $link->link_text }}</a><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="project_link">Link proyek</label>
                                    <div class="form-control-plaintext">
                                        <small>
                                            <i>@echoIf('kosong', count($project->project_links) === 0)</i>
                                        </small>
                                        @foreach ($project->project_links as $link)
                                            <a href="{{ $link->link_text }}">{{ $link->link_text }}</a><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card card-client">
                    <div class="card-header">
                        <h3 class="card-title">{{ $project->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->status == \App\Project::IS_DRAFT)
                                            <span class="badge badge-secondary">Draft</span>
                                        @elseif ($project->status == \App\Project::IS_ONPROGRESS)
                                            <span class="badge badge-primary">Berjalan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Cara Pembayaran</label>
                                    <div class="form-control-plaintext">{{ $project->payment_method_text }} </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="price">Nilai</label>
                                    <div class="form-control-plaintext">Rp.@money($project->price)</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Dimulai pada</label>
                                    <div class="form-control-plaintext">{{ $project->starttime }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Berakhir pada</label>
                                    <div class="form-control-plaintext">{{ $project->endtime }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">ID Board Trello</label>
                                    <div class="form-control-plaintext">{{ $project->trello_board_id }}</div>
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal bayar DP</label>
                                    <div class="row gutters-xs">
                                        <div class="form-control-plaintext">{{ $project->DP_time }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12"><hr></div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="note">Catatan</label>
                                    <div class="form-control-plaintext">
                                        {{ $project->additional_note OR 'tidak ada catatan' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Aksi</h4>
                            </div>
                            <div class="card-body">
                                <a href="project-detail_progress-tracker.html" class="btn btn-secondary btn-block btn-sm">Progress Tracker</a>
                                <a href="{{ route('termin-list', ['project_id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm @echoIf('disabled', ! $project->termin)">Termin Pembayaran</a>
                                <a href="{{ route('invoice-form', ['project_id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm @echoIf('disabled', ! $project->status == \App\Project::IS_ONPROGRESS)">Cetak Invoice</a>
                                <hr>
                                @if (! $project->termin)
                                    <div class="alert alert-warning">
                                    <p>
                                        <small>
                                            <b>Pembayaran belum diatur</b>
                                            <br><br>
                                            <i>Sehingga tombol di bawah menjadi disabled.</i>
                                            <br><br>
                                            Jika proyek dibayar secara cicilan, klik <code>Buat Termin</code>.
                                            Jika dibayar cash, <code>Pembayaran secara Cash</code>
                                        </small>
                                    </p>
                                    <div class="btn-list">
                                        <a href="{{ route('set-payment-method-fullcash', ['id' => $project->id]) }}" class="btn btn-secondary btn-sm">1. Pembayaran secara Cash</a>
                                        <a href="{{ route('create-termin', ['project_id' => $project->id]) }}" class="btn btn-secondary btn-sm">2. [atau] Buat Termin</a>
                                    </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block btn-sm @echoIf('disabled', ! $project->payment_method)">Tandai Proyek Aktif</a>
                                @elseif ($project->termin AND $project->status == \App\Project::IS_DRAFT)
                                    <a href="{{ route('activate-project', ['id' => $project->id]) }}" class="btn btn-primary btn-block btn-sm">Tandai Proyek Aktif</a>
                                @endif

                                @if ($project->status == \App\Project::IS_ONPROGRESS)
                                    <div class="alert alert-warning" role="alert">
                                        <small>Anda tidak bisa membatalkan setelah aksi ini dilakukan</small>
                                    </div>
                                    <a href="#" class="btn btn-danger btn-block btn-sm">Tandai Proyek Selesai</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    $(document).ready(function(){
        $(".form-group").on("click", ".multiple-field-js", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multiple-field-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.children("input")
                .val("")
                .focus();
        });
    });
</script>
@endsection
