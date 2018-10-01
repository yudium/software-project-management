@extends('template.master')
@section('title', 'Proyek Aktif: Daftar')

@section('css')
<style>
/* TODO: ganti clearfix dengan ml-auto/mr-auto */
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
</style>
@endsection

@section('content')
    <div class="container">
        @component('pagetitle')
            Daftar Proyek Aktif
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th>Client</th>
                <th class="text-center w-1">Jenis</th>
                <th>Proyek</th>
                <th>Progress</th>
                <th></th>
                <th>Deadline</th>
                <th class="text-center"><i class="icon-settings"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">
                    <div class="avatar d-block" style="background-image: url({{ asset('demo/faces/female/26.jpg') }})">
                    <span class="avatar-status bg-green"></span>
                    </div>
                </td>
                <td>
                    <div>Elizabeth Martin</div>
                    <div class="small text-muted">
                    Registered: Mar 19, 2018
                    </div>
                </td>
                <td class="text-center">
                    <i class="icon-box"><i class="fa fa-android"></i></i>
                </td>
                <td>
                    Pembangunan Aplikasi Parkir
                </td>
                <td>
                    <div class="clearfix">
                    <div class="float-left">
                        <strong>42%</strong>
                    </div>
                    <div class="float-right">
                        <small class="text-muted">24 dari 78 fitur</small>
                    </div>
                    </div>
                    <div class="progress progress-xs">
                    <div class="progress-bar bg-yellow" role="progressbar" style="width: 42%"
                    aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td>
                <td>
                    <div class="small text-muted">Progress Terbaru</div>
                    <div>4 minutes ago</div>
                </td>
                <td>
                    7 Juni 2018
                </td>
                <td class="text-center">
                    <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="project-detail.html"" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        <a href="termin-pembayaran_daftar.html" class="dropdown-item"><i class="dropdown-icon fe fe-dollar-sign"></i> Termin Pembayaran </a>
                        <a href="project-detail_progress-tracker.html" target="_blank" class="dropdown-item"><i class="dropdown-icon fa fa-trello"></i> Progress Tracker</a>
                        <div class="dropdown-divider"></div>
                        <a href="https://trello.com" target="_blank" class="dropdown-item"><i class="dropdown-icon fa fa-trello"></i> Buka Trello</a>
                    </div>
                    </div>
                </td>
            </tr>
            </tbody>
        @endcomponent
    </div>

    <script>
    require(['datatables', 'jquery'], function(datatable, $) {
        $('.datatable').DataTable({
            serverSide: true,
            ajax: '{{ url('project/list/onprogress/ajax') }}',
            // why? It because I want to remove sort icon for col 0
            order: [],
            columnDefs: [
                {
                    render: function(data, type, row) {
                        // TODO: ubah path asset pake row['client.photo']
                        // reference: https://www.datatables.net/examples/advanced_init/column_render.html
                        return `
                            <div class="avatar d-block" style="background-image: url({{ asset('demo/faces/female/26.jpg') }})">
                            <span class="avatar-status bg-green"></span>
                            </div>
                        `;
                    },
                    orderable: false,
                    targets: 0,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <div>${data}</div>
                            <div class="small text-muted">
                            Bekerja sama sejak: ${row['created_at']}
                            </div>
                        `;
                    },
                    targets: 1,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <i class="icon-box"><i class="${data}"></i></i>
                        `;
                    },
                    className: 'text-center',
                    targets: 2,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <div class="clearfix">
                            <div class="float-left">
                                <strong>42%</strong>
                            </div>
                            <div class="float-right">
                                <small class="text-muted">24 dari 78 fitur</small>
                            </div>
                            </div>
                            <div class="progress progress-xs">
                            <div class="progress-bar bg-yellow" role="progressbar" style="width: 42%"
                            aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 4,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <div class="small text-muted">Progress Terbaru</div>
                            <div>4 minutes ago</div>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 5,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <div class="item-action dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="project-detail.html"" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                                <a href="termin-pembayaran_daftar.html" class="dropdown-item"><i class="dropdown-icon fe fe-dollar-sign"></i> Termin Pembayaran </a>
                                <a href="project-detail_progress-tracker.html" target="_blank" class="dropdown-item"><i class="dropdown-icon fa fa-trello"></i> Progress Tracker</a>
                                <div class="dropdown-divider"></div>
                                <a href="https://trello.com" target="_blank" class="dropdown-item"><i class="dropdown-icon fa fa-trello"></i> Buka Trello</a>
                            </div>
                            </div>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 7,
                },
            ],
            columns: [
                { data: 'client.photo' },
                { data: 'client.name' },

                // TODO: ubah seharusnya icon
                { data: 'project_type.icon' },

                { data: 'name' },

                // TODO: ubah jadi progress
                { data: 'prices' },
                // TODO: ubah jadi progress terbaru
                { data: 'starttime' },

                { data: 'endtime' },
                { data: null },
            ]
        });
    });
    </script>
@endsection
