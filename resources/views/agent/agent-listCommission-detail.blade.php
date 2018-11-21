@extends('template.master')
@section('title', 'Termin: Daftar')

@section('css')
<style>
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.icon-box {
    width: 2.5rem;
    height: 1.5rem;
    display: inline-block;
    background: no-repeat center/100% 100%;
    vertical-align: bottom;
    font-style: normal;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 2px;
}

.page-title {
    margin: 0 auto;
}

div.separator {
    margin-top: 30px;
    margin-bottom: 10px;
    border-top: 1px dotted #dcdcdc;
}

div.remaining-amount .badge {
    font-size: 13px;
}
</style>
@endsection

@section('content')
<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Daftar Detail Komisi
        </h1>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center pt-2 mt-auto">
                        <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                        <div>
                            <a href="./profile.html" class="text-default">{{ $agent->name }}</a>
                            <div class="d-block text-muted">
                                {{-- <span class="badge badge-success">{{ ucfirst($client->type->name) }}</span> --}}
                                <span class="badge badge-info">{{ ucfirst($agent->username) }}</span>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
                        </div>
                    </div>

                    <div class="separator"></div>
                    {{-- <h5 class="mt-3">{{ $project->name }}</h5>
                    <p><i class="icon-box text-center mr-2"><i class="fa {{ $project->project_type->icon }}"></i></i> {{ $project->project_type->name }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status lunas</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listCommissions as $listCommission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d M Y', strtotime($listCommission->commission->due_date)) }}</td>
                            <td>Rp.{{ $listCommission->commission->amount }}</td>
                            <td>
                                @if ($listCommission->commission->amount != $listCommission->commission->paid_amount)
                                    <span class="badge badge-danger">Belum</span>
                                    <div class="remaining-amount text-muted">
                                        <span class="badge badge-info">Sisa Rp.{{ $listCommission->commission->amount - $listCommission->commission->paid_amount }}</span>
                                    </div>
                                @else
                                    <span class="badge badge-success">Sudah</span>
                                @endif
                            </td>
                            <td class="text-right">
                            
                                    @if ($listCommission->commission->paid_amount < $listCommission->commission->amount)
                                    <a href='{{ route('agentPayment', ['commission_id' =>  $listCommission->commission->id]) }}' class="btn btn-outline-primary btn-sm mr-2">Bayar</a>
                                    @endif
                                <a href='{{ route('agentPaymentHistory', ['commission_id' => $listCommission->commission->id]) }}' class="btn btn-outline-secondary btn-sm mr-2">Riwayat Bayar</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
