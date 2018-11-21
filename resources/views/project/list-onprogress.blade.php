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
                <th class="text-center"><i class="fe fe-settings"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="8">
                    <div class="loader mx-auto"></div>
                </td>
            </tr>
            </tbody>
        @endcomponent
    </div>

    <script>
    require(['datatables', 'jquery', 'moment'], function(datatable, $, moment) {
        $('.datatable').DataTable({
            serverSide: true,
            ajax: '{{ route('onprogress-project-list-ajax') }}',
            // why? It because I want to remove sort icon for col 0
            order: [],
            columnDefs: [
                {
                    render: function(data, type, row) {
                        if (data) {
                            return `
                                <div class="avatar d-block" style="background-image: url( ${ require.toUrl('storage/clientImage/' + data) } )"></div>
                            `;
                        }

                        return `
                            <div class="avatar avatar-placeholder d-block"></div>
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
                        // doesn't have trello board or connection error
                        if (! row['progress']) {
                            return `NULL`;
                        }
                        if (row['progress']['status'] != 200) {
                            return `<small> ${ row['progress']['message'] } </small>`;
                        }
                        if (row['progress']['status'] == 200) {
                            // rename variable to make shorter
                            let progress = row['progress']['data'];

                            let progress_color = null;

                            if ( Math.floor(progress['progress_percent']) <= 100) {
                                progress_color = 'bg-success';
                            }
                            if ( Math.floor(progress['progress_percent']) <= 80) {
                                progress_color = 'bg-primary';
                            }
                            if ( Math.floor(progress['progress_percent']) <= 50) {
                                progress_color = 'bg-warning';
                            }
                            if ( Math.floor(progress['progress_percent']) <= 30) {
                                progress_color = 'bg-danger';
                            }

                            return `
                                <div class="clearfix">
                                    <div class="float-left">
                                        <strong>${ Math.floor(progress['progress_percent']) }%</strong>
                                    </div>
                                    <div class="float-right">
                                        <small class="text-muted">${ progress['number_of_task_complete'] } dari ${ progress['number_of_task'] } task</small>
                                    </div>
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar ${ progress_color }" role="progressbar" style="width: ${ Math.floor( progress['progress_percent'] ) }%"
                                    aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            `;
                        }
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 4,
                },
                {
                    render: function(data, type, row) {
                        // doesn't have trello board or connection error
                        if (! row['progress']) {
                            return '<small class="text-muted"><i>Tidak memiliki trello</i></small>';
                        }
                        if (row['progress']['status'] != 200) {
                            return `<small> ${ row['progress']['message'] } </small>`;
                        }
                        if (row['progress']['status'] == 200) {
                            // rename variable to make shorter
                            let progress = row['progress']['data'];

                            return `
                                <div class="small text-muted">Progress Terbaru</div>
                                <div>${ progress['last_progress_relative_time'] } jam yang lalu</div>
                            `;
                        }

                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 5,
                },
                {
                    render: function(data, type, row) {
                        let html = `
                            <div class="item-action dropdown">
                                <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ url('/project/detail') }}/${row['id']}" target="_blank" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                        `;

                        /**
                         * order of IF is important
                         */
                        if (row['trello_board_id']) {
                            // if current project has trello board
                            html += `<a href="{{ url('/progress/') }}/${row['id']}" target="_blank" class="dropdown-item"><i class="dropdown-icon fa fa-trello"></i> Progress Tracker</a>`;
                        }
                        if (row['payment_method'] == {{ \App\Project::PAYMENT_BY_TERMIN }}) {
                            // if current project payment method is using termin (installment)
                            html += `<a href="{{ url('/termin/list/') }}/${row['id']}" target="_blank" class="dropdown-item"><i class="dropdown-icon fe fe-dollar-sign"></i> Termin Pembayaran </a>`;
                        }
                        if (row['trello_board_id']) {
                            // if current project has trello board
                            html += `<div class="dropdown-divider"></div>`;
                            html += `<a href="https://trello.com/b/${row['trello_board_id']}" target="_blank" class="dropdown-item"><i class="dropdown-icon fa fa-trello"></i> Buka Trello</a>`;
                        }

                        html += `
                                </div>
                            </div>
                        `;

                        return html;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 7,
                },
            ],
            columns: [
                { data: 'client.photo' },
                { data: 'client.name' },
                { data: 'project_type.icon' },
                { data: 'name' },
                { data: 'progress' },
                { data: 'progress' },
                { data: 'endtime' },

                { data: null },
            ]
        });
    });
    </script>
@endsection
