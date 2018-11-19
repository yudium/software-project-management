{{-- This view handle invoice for project that payment method is Full Cash or Termin.
     So there is some code that handle the difference between them. Alternative option
     is create new laravel view that handle each of payment method.
--}}

@extends('template.master')
@section('title', 'Invoice Form')

@section('css')
<style>
div.separator {
    margin-top: 30px;
    margin-bottom: 10px;
    border-top: 1px dotted #dcdcdc;
}

.check-circle-container {
    position: relative;
}
.check-circle {
    display: hidden;
    position: absolute;
    top: -7px;
    right: -3px;
    font-size: 17px;
    color: green;
    font-weight: bold;
    text-shadow: 0px 1px #fff;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Invoice Form
        </h1>
    </div>

    <form method="post" action="{{ route('invoice-generate', ['project_id' => $project->id]) }}">
        @csrf

        <div class="row row-cards">
            <div class="col-3">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center pt-2 mt-auto">
                                    <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                                    <div>
                                        <a href="./profile.html" class="text-default">{{ $client->name }}</a>
                                        <div class="d-block text-muted">
                                            <span class="badge badge-success">{{ ucfirst($client->type->name) }}</span>
                                            <span class="badge badge-info">{{ ucfirst($client->status_text) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
                                    </div>
                                </div>

                                <div class="separator"></div>
                                <h5 class="mt-3">{{ $project->name }}</h5>
                                <p><i class="icon-box text-center mr-2"><i class="fa {{ $project->project_type->icon }}"></i></i> {{ $project->project_type->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-client">
                            <div class="card-header">
                                <h3 class="card-title">Form</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Jabatan</label>
                                    <input class="form-control" name="department" value="" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input class="form-control" name="company_name" value="" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tempat</label>
                                    <input class="form-control" name="company_address" value="" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Pihak Penerima Surat</label>
                                    <input class="form-control" name="letter_receiver" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sumber Pembayaran</label>
                                    <select name="bank" class="form-control custom-select" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ ucfirst($bank->name) }} -- {{ $bank->account_number }} -- {{ ucfirst($bank->owner) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- This part of form is only for project that has
                                 Termin --}}
                            @if ($project->payment_method == \App\Project::PAYMENT_BY_TERMIN)
                                @include('invoice.partials.form_termin');
                            @endif

                            <div class="card-footer text-right">
                                <div class="d-flex">
                                    <a href="javascript:void(0)" class="btn btn-link">Batal</a>
                                    <button
                                       id="primary-btn"
                                       type="submit"
                                       class="btn btn-primary ml-auto @echoIf('disabled', $project->payment_method == \App\Project::PAYMENT_BY_TERMIN)">
                                        Buat Invoice
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>

{{-- This part of form is only for project that has Termin --}}
@if ($project->payment_method == \App\Project::PAYMENT_BY_TERMIN)

    require(['jquery'], function($){
        $(document).ready(function(){
            $('.termin-check').change(function(){
                let checked = 0;

                $('.termin-check').each(function(index){
                    if ($(this).prop('checked')) {
                        checked++;
                    }
                });

                if (checked > 0) {
                    $('#primary-btn').removeClass('disabled');
                } else {
                    $('#primary-btn').addClass('disabled');
                }
            });
        });
    });

@endif

</script>
@endsection('js')
