@extends('template.master')
@section('title', 'Detail Proyek')

@section('css')
<style>
// TODO: move clearfix css to global css
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

ol.link-list {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
ol.link-list:hover {
    overflow: visible;
    position: relative;
    z-index: 9;
    background-color: white;
}
ol.link-list span.anticipate-long-text {
    background-color: white;
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
                        @include('includes.cards.client', [
                            'ganti_button' => false,
                            'client' => $project->client,
                        ])
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Person In Charge</h4>
                            </div>
                            <table class="table card-table">
                            <tbody>
                                @echoIf ('<td><small><i>Belum diatur</i></small></td>', $project->PICs->count() == 0)

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
                                        <ol class="link-list">
                                            @foreach ($project->backup_source_code_project_links as $link)
                                                <li><span class="anticipate-long-text"><a href="{{ $link->link_text }}">{{ $link->link_text }}</a><br></span></li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="project_link">Link proyek</label>
                                    <div class="form-control-plaintext">
                                        <small>
                                            <i>@echoIf('kosong', count($project->project_links) === 0)</i>
                                        </small>
                                        <ol class="link-list">
                                            @foreach ($project->project_links as $link)
                                                <li><a href="{{ $link->link_text }}">{{ $link->link_text }}</a><br></li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $project->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tipe Proyek</label>
                                    <div class="form-control-plaintext">
                                        <i class="{{ $project->project_type->icon }} mr-3"></i>
                                        {{ $project->project_type->name }}
                                    </div>
                                    {{-- dont worry, covered by $request->old() in controller in case of validation fails --}}
                                    <input name="project_type_id" type="hidden" value="{{ $project->project_type->id }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->status == \App\Project::IS_DRAFT)
                                            <span class="badge badge-secondary">Draft</span>
                                        @endif
                                        @if ($project->status == \App\Project::IS_ONPROGRESS)
                                            <span class="badge badge-primary">Berjalan</span>
                                        @endif
                                        @if ($project->status == \App\Project::IS_DONE_FAIL)
                                            <span class="badge badge-danger">Selesai [gagal]</span>
                                        @endif
                                        @if ($project->status == \App\Project::IS_DONE_SUCCESS)
                                            <span class="badge badge-success">Selesai [sukses]</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">ID Board Trello</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->trello_board_id)
                                            <a href="http://trello.com/b/{{ $project->trello_board_id }}" target="_blank">
                                                {{ $project->trello_board_id }}
                                                <i class="fa fa-external-link"></i>
                                            </a>
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="price">Kuantitas</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->quantity)
                                            {{ $project->quantity }}
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="price">Nilai</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->price)
                                            Rp.@money($project->price)
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Cara Pembayaran</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->payment_method_text)
                                            {{ $project->payment_method_text }}
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Dimulai pada</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->starttime)
                                            {{ date('d M Y', strtotime($project->starttime)) }}
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Deadline</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->endtime)
                                            {{ date('d M Y', strtotime($project->endtime)) }}
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal bayar DP</label>
                                    <div class="form-control-plaintext">
                                        @if ($project->DP_time)
                                            {{ date('d M Y', strtotime($project->DP_time)) }}
                                        @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
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

                            {{-- only show if the project is from potential project --}}
                            @if ($project->potential_project)
                                <a href="{{ route('follow-up-potential-project-history-list', ['potential_project_id' => $project->potential_project->id]) }}" class="btn btn-secondary btn-block btn-sm" target="_blank">Riwayat Follow Up</a>
                            @endif

                                {{-- Draft project doesn't have progress --}}
                                @if (! $project->is_draft AND $project->trello_board_id)
                                <a href="{{ route('project-progress', ['project_id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm">
                                    {{-- show different text for different project's status --}}
                                    @if ($project->is_onprogress)
                                        Progress Tracker
                                    @endif
                                    @if ($project->is_done)
                                        Riwayat Progress
                                    @endif
                                </a>
                                @endif

                                {{-- different edit button depends between draft
                                     and onprogress project --}}
                                @if ($project->is_draft)
                                    <a href="{{ route('edit-project', ['id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm">Ubah</a>
                                @endif
                                @if ($project->is_onprogress)
                                    <a href="{{ route('edit-restricted-project', ['id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm">Ubah</a>
                                @endif

                                @if ($project->is_draft)
                                    <a href="{{ route('project-delete-confirmation', ['id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm">Hapus</a>
                                @endif

                                <!-- this action only allowed for project draft -->
                                <a href="{{ route('change-project-client', ['id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm @echoIf('disabled', ! $project->is_draft)">Ubah Client</a>
                                <!-- this action only allowed for project draft -->
                                <a href="{{ route('change-project-type', ['id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm @echoIf('disabled', ! $project->is_draft)">Ubah Tipe Proyek</a>

                                {{-- show button 'Termin Pembayaran' only if project has termin data.
                                     that is, onprogress or archive project that payment method is termin --}}
                                @if ($project->termin)
                                    <a href="{{ route('termin-list', ['project_id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm @echoIf('disabled', ! $project->termin)">Termin Pembayaran</a>
                                @endif

                                {{-- print invoice only for onprogress project --}}
                                @if ($project->is_onprogress)
                                    <a href="{{ route('invoice-form', ['project_id' => $project->id]) }}" class="btn btn-secondary btn-block btn-sm @echoIf('disabled', ! $project->status == \App\Project::IS_ONPROGRESS)">Cetak Invoice</a>
                                @endif


                                {{-- user only can change project state to active
                                     only if the project's payment method already set up --}}
                                @if ($project->is_draft)
                                    <hr>
                                    @if ($project->PICs->count() == 0 OR
                                         ! $project->quantity OR
                                         ! $project->price OR
                                         ! $project->DP_time OR
                                         ! $project->starttime OR
                                         ! $project->endtime)

                                        <div class="alert alert-info">
                                            <p>
                                                <small>
                                                    Anda belum mengisi semua kolom wajib. Yaitu:
                                                    <ol>
                                                        <li>PIC</li>
                                                        <li>Kuantitas</li>
                                                        <li>Harga proyek</li>
                                                        <li>Tanggal bayar DP</li>
                                                        <li>Waktu mulai proyek</li>
                                                        <li>Waktu berakhir proyek</li>
                                                    </ol>
                                                </small>
                                            </p>
                                        </div>
                                        <a href="{{ route('project-activation-step1', ['id' => $project->id]) }}" class="btn btn-primary btn-block btn-sm disabled">Aktifkan Proyek</a>
                                    @else
 
                                        <div class="alert alert-warning">
                                            <p>
                                                <small>
                                                    <b>Peringatan</b><br>
                                                    Tindakan ini tidak bisa di-<i>undo</i>
                                                </small>
                                            </p>
                                        </div>
                                        <a href="{{ route('project-activation-step1', ['id' => $project->id]) }}" class="btn btn-primary btn-block btn-sm">Aktifkan Proyek</a>
                                    @endif
                               @endif

                                {{-- show button 'Tandai Proyek Selesai' --}}
                                @if ($project->is_onprogress)
                                    <hr>
                                    <div class="alert alert-warning" role="alert">
                                        <small>Anda tidak bisa membatalkan setelah aksi ini dilakukan</small>
                                    </div>
                                    <a href="{{ route('project-deactivation-confirmation', ['id' => $project->id]) }}" class="btn btn-danger btn-block btn-sm">Tandai Proyek Selesai</a>
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
