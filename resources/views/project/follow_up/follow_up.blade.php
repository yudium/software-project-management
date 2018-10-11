@extends('template.master')
@section('title', 'Proyek Potensial: Follow Up')

@section('css')
<style>
.col-form {
    margin: 0 auto;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

</style>
@endsection

@section('content')
<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Follow Up
        </h1>
    </div>

    <form id="main-form" method="POST" action="{{ route('FollowUpPotentialProjectPost', ['id' => $potential_project->id ]) }}">
        @csrf

        <div class="col-12 col-form">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama proyek</label>
                            <div class="form-control-plaintext">{{ $potential_project->project_name }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Jenis Proyek</label>
                            <div class="form-control-plaintext">{{ $potential_project->project_type->name }}</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <fieldset class="form-fieldset">
                            <div class="form-group">
                                <div class="form-label">Follow Up?</div>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input id="follow-up-status-is-deal" class="custom-control-input" name="follow_up_status" value="{{ \App\FollowUpHistory::HAS_FOLLOWED_UP }}" type="radio">
                                        <span class="custom-control-label">Sudah</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input id="follow-up-status-is-not-deal" class="custom-control-input" name="follow_up_status" value="{{ \App\FollowUpHistory::HASNT_FOLLOWED_UP }}" type="radio">
                                        <span class="custom-control-label">Belum</span>
                                    </label>
                                </div>
                                <div id="follow-up-message">
                                    <small><i>Reload halaman jika ingin merubah "Sudah" ke "Belum"</i></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Catatan Follow Up</label>
                                <textarea class="form-control follow-up-note" name="follow_up_note" rows="6" placeholder="..."></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-4">
                        <fieldset id="fieldset-deal" class="form-fieldset text-muted">
                            <div class="form-group">
                                <div class="form-label">Deal?</div>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input deal-status" name="deal_status" value="{{ \App\FollowUpDealHistory::IS_DEAL }}" type="radio" disabled="">
                                        <span class="custom-control-label">Ya Deal</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input deal-status" name="deal_status" value="{{ \App\FollowUpDealHistory::ISNT_DEAL }}" type="radio" disabled="">
                                        <span class="custom-control-label">Tidak Deal</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input deal-status" name="deal_status" value="{{ \App\FollowUpDealHistory::IS_UNCERTAIN }}" type="radio" disabled="">
                                        <span class="custom-control-label">Belum Pasti</span>
                                    </label>
                                </div>
                                <div style="height: 22px"><!-- only for spacing with #follow-up-message --></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control deal-note" name="deal_note" rows="6" placeholder="..." disabled=""></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-8"><button class="btn btn-primary btn-block">Simpan</button></div>
                </div>
                </div>
            </div>
        </div> 
    </form>
</div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    require(['jquery'], function($, moment) {
        $(document).ready(function(){
            $('#fieldset-deal :input').prop('disabled', true);
                $('#follow-up-message').css('visibility', 'hidden');

            $('#follow-up-status-is-deal').click(function(){
                $('#fieldset-deal').removeClass('text-muted');
                $('#fieldset-deal :input').prop('disabled', false);
                $('#follow-up-status-is-deal, #follow-up-status-is-not-deal').prop('disabled', true);
                $('#follow-up-message').css('visibility', 'visible');
            });
            $('#follow-up-status-is-not-deal').click(function(){
                $('#fieldset-deal :input').val('');
                $('#fieldset-deal :input').prop('disabled', true);
            });

            $('#main-form').submit(function(){
                $('#follow-up-status-is-deal, #follow-up-status-is-not-deal').prop('disabled', false);
            });
        });
    });
</script>
@endsection
