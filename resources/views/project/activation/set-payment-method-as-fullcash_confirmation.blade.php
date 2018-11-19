@extends('template.master')
@section('title', 'Atur Pembayaran Proyek')

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
</style>
@endsection

@section('content')
<div class="container">

    <div class="card mx-auto" style="width: 400px; margin-top: 100px;">
        <div class="card-header">
            <h3 class="card-title">Konfirmasi Pembayaran Proyek</h3>
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

            <div class="p-4">
                <p>Ketik <code>Full Cash</code> di bawah</p>
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
                <a href="" class="btn btn-link">Batal</a>
                <a href="{{ route('project-activation-step4', ['id' => $project->id, 'choice' => \App\Project::PAYMENT_BY_FULLCASH]) }}" id="primary-button" class="btn btn-primary ml-auto disabled">Ya, Full Cash dan Aktifkan Proyek</a>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
require(['jquery'], function($){
    $('input#validation').keyup(function(){
        let val = $(this).val();
        if (val == 'Full Cash') {
            $('#primary-button').removeClass('disabled');
        } else {
            $('#primary-button').addClass('disabled');
        }
    });
});
</script>
@endsection
