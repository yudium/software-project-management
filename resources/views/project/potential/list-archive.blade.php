@extends('template.master')
@section('title', 'Arsip Proyek Potensial: Daftar')

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
            Arsip Daftar Proyek Potensial
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th>Client</th>
                <th class="text-center w-1">Jenis</th>
                <th>Proyek</th>
                <th>Status Deal</th>
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
                    16/08/2019
                </td>
                <td class="text-right">
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
@endsection

@section('js')
    <script>
    require(['datatables', 'jquery'], function(datatable, $) {
        $('.datatable').DataTable({
            serverSide: true,
            ajax: '{{ route('potential-project-list-archive-ajax') }}',
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
                        // last deal history contains 'deal status' on this potential project
                        let last_deal_history = data[data.length - 1];
                        let text = (last_deal_history.status == '{{ \App\FollowUpDealHistory::IS_DEAL }}') ? 'Ya' : 'Tidak';
                        return text;
                    },
                    className: 'text-center',
                    targets: 4,
                },
                {
                    render: function(data, type, row) {
                        // project_id will be *not* null if it already converted to real project data based on potential project
                        let project_id = row['project_id'];
                        // last deal history contains 'deal status' on this potential project
                        let last_deal_history = row['deal_histories'][row['deal_histories'].length - 1];

                        if (project_id) {
                            // show 'Lihat Proyek' button
                            return `
                                <a href="{{ url('/project/detail/') }}/${row['project_id']}" class="btn btn-secondary btn-sm mr-2">Lihat Proyek</a>
                                <a href="{{ url('/project/potential/history') }}/${row['id']}"  class="btn btn-secondary btn-sm">Lihat Riwayat</a>
                                <a class="icon ml-5" href="javascript:void(0)">
                                    <i class="fe fe-edit"></i>
                                </a>
                            `;
                        }
                        if (! project_id && last_deal_history.status == '{{ \App\FollowUpDealHistory::IS_DEAL }}') {
                            // show 'Buat Proyek' button
                            return `
                                <a href="{{ url('/project/create/potential/') }}/${row['id']}" class="btn btn-primary btn-sm mr-2">Buat Proyek</a>
                                <a href="{{ url('/project/potential/history') }}/${row['id']}"  class="btn btn-secondary btn-sm">Lihat Riwayat</a>
                                <a class="icon ml-5" href="javascript:void(0)">
                                    <i class="fe fe-edit"></i>
                                </a>
                            `;
                        }
                        if (! project_id && last_deal_history.status == '{{ \App\FollowUpDealHistory::ISNT_DEAL }}') {
                            // show 'Buat Proyek' button
                            return `
                                <a href="{{ url('/project/potential/history') }}/${row['id']}"  class="btn btn-secondary btn-sm">Lihat Riwayat</a>
                                <a class="icon ml-5" href="javascript:void(0)">
                                    <i class="fe fe-edit"></i>
                                </a>
                            `;
                        }
                    },
                    className: 'text-right',
                    orderable: false,
                    targets: 5,
                },
            ],
            columns: [
                { data: 'client.photo' },
                { data: 'client.name' },

                { data: 'project_type.icon' },

                { data: 'project_name' },

                { data: 'deal_histories' },

                { data: null },
            ]
        });
    });
    </script>
@endsection
