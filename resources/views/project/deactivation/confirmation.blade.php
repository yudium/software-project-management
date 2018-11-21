@extends('template.master')
@section('title', 'Konfirmasi Deaktifasi Proyek')

@section('css')
<style>
/* NOTE: maybe this css selector suitable only for this page */
.container--anticipate-long-text {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.container--anticipate-long-text:hover {
    overflow: visible;
    position: relative;
    z-index: 9;
    background-color: white;
}
span.content--anticipate-long-text:hover {
    background-color: white;
}

/* to emphasize checkbox in this page only */
.custom-control-input ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #f5f7fb, 0 0 0 2px rgba(70, 127, 207, 0.25);
}
</style>
@endsection

@section('content')
<div class="container">

    <form id="main-form" action="{{ route('project-deactivation', ['id' => $project->id]) }}" method="post">
        @csrf

        <div class="card mx-auto" style="width: 400px; margin-top: 100px;">
            <div class="card-header">
                <h3 class="card-title">Konfirmasi Deaktifasi Proyek</h3>
            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <!-- create table with row and col class -->
                    <div class="row">
                        <div class="col-3">Proyek</div>
                        <div class="col-1">:</div>
                        <div class="col-8">
                            <div class="container--anticipate-long-text">
                                <span class="content--anticipate-long-text">
                                    <a href="{{ route('project-detail', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">Client</div>
                        <div class="col-1">:</div>
                        <!-- TODO: link to client detail -->
                        <div class="col-8">
                            <div class="container--anticipate-long-text">
                                <span class="content--anticipate-long-text">
                                    {{ $project->client->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="mb-7 pl-4">
                    <label class="custom-control custom-checkbox">
                        <input id="project-client-confirmation-check" type="checkbox" class="custom-control-input confirmation-check" name="ignoreme-2" value="ignoreme">
                        <span class="custom-control-label">Proyek dan client benar</span>
                    </label>
                </div>

                <div class="card mb-7">
                    <div class="card-status bg-green"></div>
                    <div class="card-body">
                        <h4 class="mb-3">{{ $project_age }} <small>Hari Umur Proyek</small></h4>

                        <div class="row">
                            <div class="col-auto">
                                <div class="text-muted-dark">Berakhir pada (hari ini):</div>
                            </div>
                            <div class="col-auto">
                                <div class="text-muted-dark">{{ date('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Proyek</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input id="status-success" type="radio" name="status" value="{{ \App\Project::IS_DONE_SUCCESS }}" class="selectgroup-input">
                            <span class="selectgroup-button">Sukses</span>
                        </label>
                        <label class="selectgroup-item">
                            <input id="status-fail" type="radio" name="status" value="{{ \App\Project::IS_DONE_FAIL }}" class="selectgroup-input">
                            <span class="selectgroup-button">Gagal</span>
                        </label>
                    </div>
                </div>

                <div class="p-4">
                    <p>Ketik <code>Proyek Telah Selesai</code> di bawah</p>
                    <input id="validation" class="form-control" type="text" name="validation" placeholder="ketik disini...">
                </div>

                <div class="alert alert-warning p-4 mt-5">
                    <small class="status-animated">
                        <i class="fa fa-warning mr-2"></i>
                        Tindakan ini tidak bisa di-undo
                    </small>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ route('project-detail', ['id' => $project->id]) }}" class="btn btn-link">Batal</a>
                    <button id="primary-button" class="btn btn-primary ml-auto disabled">Tandai Proyek Selesai</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('js')
<script>
require(['jquery'], function($){
    $(document).ready(function(){
        $('input#validation').keyup(function(){
            let val = $(this).val();

            if (val == 'Proyek Telah Selesai') {
                $(this).trigger('blur');
            } else {
                $(this).trigger('change');
            }
        });

        $('#main-form :input').change(function(){
            let condition1 = ( $('input#validation').val() == 'Proyek Telah Selesai' );
            let condition2 = $('#project-client-confirmation-check').prop('checked');
            let condition3 = ( $('#status-success').prop('checked') || $('#status-fail').prop('checked') );

            if (condition1 && condition2 && condition3) {
                $('#primary-button').removeClass('disabled');
            } else {
                $('#primary-button').addClass('disabled');
            }
        });
    });
});
</script>
@endsection
