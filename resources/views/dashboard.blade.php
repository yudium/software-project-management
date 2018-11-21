@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

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
    <div class="page-header">
        <h1 class="page-title">
            Dashboard
        </h1>
    </div>

    <div class="row row-cards">
        <div class="col-lg-3">
            <div class="card p-3 px-4">
                <div>
                    Proyek
                </div>
                <div class="py-4 m-0 text-center h1 text-green">{{ $project_total_count }}</div>
                <div class="d-flex">
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 px-4">
                <div>
                    Client
                </div>
                <div class="py-4 m-0 text-center h1 text-blue">{{ $client_count }}</div>
                <div class="d-flex">
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 px-4">
                <div>
                    Prospect
                </div>
                <div class="py-4 m-0 text-center h1 text-warning">{{ $prospect_count }}</div>
                <div class="d-flex">
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 px-4">
                <div>
                    Penghasilan
                </div>
                <div class="py-4 m-0 text-center h1 text-red">@money( $total_income )</div>
                <div class="d-flex">
                    <small class="text-muted">Seluruh proyek berhasil (kasar)</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Proyek Berjalan</h2>
                </div>
                <table class="table card-table text-wrap">
                <tbody>

                    @if ($project_onprogress->count() == 0)
                        <tr>
                            <td colspan="2" class="text-center text-muted"><i>Tidak ada data</i></td>
                        </tr>
                    @endif

                    @foreach ($project_onprogress as $project)
                    <tr>
                        <td>
                            <div>{{ $project->name }}</div>
                            <div class="small text-muted">
                                Client: {{ $project->client->name }}
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="small text-muted">
                                Deadline
                            </div>
                            <div class="small">
                                @if ( \Carbon::now()->greaterThan(\Carbon::parse( $project->endtime )) )
                                    <span class="text-danger font-weight-bold">
                                        Terlewati
                                    </span>
                                @else
                                    <span class="text-success font-weight-bold">
                                        {{ 1 + \Carbon::now()->diffInDays( \Carbon::parse( $project->endtime ) ) }} hari lagi
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Termin</h4>
                </div>
                <table class="table card-table" style="table-layout: fixed">
                    <tbody>

                        @if ($termins->count() == 0)
                        <tr>
                            <td class="text-center">Tidak ada data</td>
                        </tr>
                        @endif

                        @foreach ($termins as $termin)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-warning mr-3 text-dark">
                                        {{ Carbon::now()->diffInDays(Carbon::parse($termin->current_termin_detail->due_date)) + 1 }}
                                    </span>
                                    <div class="container--anticipate-long-text">
                                        <h4 class="m-0">
                                            <a href="javascript:void(0)"><small>hari lagi penagihan</small></a>
                                        </h4>
                                        <!-- TODO: more clear implementation ellipsis. I don't know why this is work. -->
                                        <span class="content--anticipate-long-text">
                                            <small>
                                                Proyek: <a href="{{ route('project-detail', ['id' => $termin->project->id]) }}">{{ $termin->project->name }}</a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-blue mr-3">
                                <i class="fe fe-briefcase"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><a href="javascript:void(0)">{{ $project_onprogress_count }} <small>Proyek Berjalan</small></a></h4>
                                <small class="text-muted">dari {{ $project_total_count }} total proyek</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                        <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-azure mr-3">
                                <i class="fe fe-book"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><a href="javascript:void(0)">{{ $project_draft_count }} <small>Proyek Draft</small></a></h4>
                                <small class="text-muted">menunggu untuk dikonfirmasi</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-danger mr-3">
                                <i class="fe fe-bookmark"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><a href="javascript:void(0)">{{ $potential_project_count }} <small>Proyek Potensial</small></a></h4>
                                <small class="text-muted">menunggu untuk di-follow up</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-success mr-3">
                                <i class="fe fe-award"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><a href="javascript:void(0)">{{ $project_success_count }} <small>Proyek Sukses</small></a></h4>
                                <small class="text-muted">dari {{ $project_total_count }} total proyek</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-dark mr-3">
                                <i class="fa fa-frown-o"></i>
                            </span>
                            <div>
                                <h4 class="m-0"><a href="javascript:void(0)">{{ $project_fail_count }} <small>Proyek Gagal</small></a></h4>
                                <small class="text-muted">dari {{ $project_total_count }} total proyek</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
