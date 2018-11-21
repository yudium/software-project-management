@extends('template.master')
@section('title', 'Project')

@section('css')
<style>
.btn-as-text {
    color: #495057;
    border: none;
    box-shadow: none;
    background: transparent;
    cursor: pointer;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
    margin-top: 40px;
}
.stepwizard p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.stepwizard-step .btn.disabled {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
        </style>
@endsection

@section('content')
    <div class="container">
        @include('pagetitle', ['title' => 'Ubah Client Proyek'])

        <div class="row row-cards row-deck" style="margin-top: 1.5rem; margin-bottom: 1.5rem">
            <div class="col-6">
                <h2 class="page-title text-muted text-center">
                    Pilih Client
                </h2>
            </div>
            <div class="col-6">
                <h2 class="page-title text-muted text-center">
                    Pilih Prospect
                </h2>
            </div>
        </div>


        <div class="row row-cards row-deck">
            <div class="col-6">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table datatable-client">
                            <thead>
                                <tr>
                                    <th class="text-center w-1"></th>
                                    <th>Client</th>
                                    <th>Hub. Bisnis</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="text-center" colspan="4">
                                    <div class="loader mx-auto"></div>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table datatable-prospect">
                            <thead>
                                <tr>
                                    <th class="text-center w-1"></th>
                                    <th>Prospect</th>
                                    <th>Hub. Bisnis</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="text-center" colspan="4">
                                    <div class="loader mx-auto"></div>
                                </td>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

window.scroll(0, 65.133 + 55.5 + 1);

require(['datatables', 'jquery'], function(datatable, $) {
    $('.datatable-client').DataTable({
        serverSide: true,
        // I use ajax from create-project page since it's same logic
        ajax: '{{ route('create-project-step1-client-ajax') }}',
        // because I want to remove sort icon for col 0
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
                            <span class="badge badge-secondary">${row['type']['name']}</span>
                        </div>
                    `;
                },
                targets: 1,
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="{{ url('/project/change-client/confirmation') . '/' . $project->id }}/${row['id']}" class="btn btn-outline-info btn-sm">Pilih</a>
                    `;
                },
                orderable: false,
                targets: 3,
            },
        ],
        columns: [
            { data: 'photo' },
            { data: 'name' },
            { data: 'business_relationship_status' },
            { data: null },
        ]
    });

    $('.datatable-prospect').DataTable({
        serverSide: true,
        // I use ajax from create-project page since it's same logic
        ajax: '{{ route('create-project-step1-prospect-ajax') }}',
        // because I want to remove sort icon for col 0
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
                            <span class="badge badge-secondary">${row['type']['name']}</span>
                        </div>
                    `;
                },
                targets: 1,
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="{{ url('/project/change-client/confirmation') . '/' . $project->id }}/${row['id']}" class="btn btn-outline-info btn-sm">Pilih</a>
                    `;
                },
                orderable: false,
                targets: 3,
            },
        ],
        columns: [
            { data: 'photo' },
            { data: 'name' },
            { data: 'business_relationship_status' },
            { data: null },
        ],
    });
});
</script>
@endsection
