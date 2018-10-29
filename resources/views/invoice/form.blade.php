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
                                    <input class="form-control" name="department" value="" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input class="form-control" name="company_name" value="" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tempat</label>
                                    <input class="form-control" name="company_address" value="" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Pihak Penerima Surat</label>
                                    <input class="form-control" name="letter_receiver" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sumber Pembayaran</label>
                                    <select name="bank" class="form-control custom-select">
                                        @foreach ($banks as $bank)
                                            <!-- TODO: seharusnya bukan nama bank saja -->
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                            <thead>
                                            <tr>
                                                <th>Pembayaran ke-</th>
                                                <th>Tanggal Tenggat</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th class="text-center">Pilih</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($project->termin->details as $termin_detail)
                                            @if ($termin_detail->paid_amount == $termin_detail->amount)
                                                @continue
                                            @endif
                                            <tr>
                                                <td class="text-center">#{{ $termin_detail->serial_number }}</td>
                                                <td>{{ $termin_detail->due_date }}</td>
                                                <td><b>Rp.@money($termin_detail->amount)</b></td>
                                                <td>
                                                    @if ($termin_detail->amount != $termin_detail->paid_amount)
                                                    Sisa <b>Rp.@money($termin_detail->amount - $termin_detail->paid_amount)</b>
                                                    @elseif ($termin_detail->paid_amount == 0)
                                                    <b>@money($termin_detail->amount)</b>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="termin_detail_id[]" value="{{ $termin_detail->id }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="d-flex">
                                    <a href="javascript:void(0)" class="btn btn-link">Batal</a>
                                    <button type="submit" class="btn btn-primary ml-auto">Buat Invoice</button>
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
