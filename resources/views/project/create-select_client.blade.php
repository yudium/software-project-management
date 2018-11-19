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
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-secondary btn-circle disabled">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-secondary btn-circle disabled">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row row-cards row-deck" style="margin-top: 1.5rem; margin-bottom: 1.5rem">
                <div class="col-6">
                    <h2 class="page-title">
                        Pilih Client
                    </h2>
                </div>
                <div class="col-6">
                    <h2 class="page-title">
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
                                    <tr>
                                        <td class="text-center">
                                            <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                                                <span class="avatar-status bg-green"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>Elizabeth Martin</div>
                                            <div class="small text-muted">
                                                Email: example@gmail.com
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            Kurang Baik
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-outline-info btn-sm">Pilih</a>
                                        </td>
                                    </tr>
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
                                    <tr>
                                        <td class="text-center">
                                            <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                                                <span class="avatar-status bg-green"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>Elizabeth Martin</div>
                                            <div class="small text-muted">
                                                Email: example@gmail.com
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            Baik
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-outline-info btn-sm">Pilih</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                window.scroll(0, 65.133 + 55.5 + 1);
            </script>

            <!--
            THANKS TO:
            (Progress bar wizard) https://codepen.io/brettmichaelorr/pen/RaRZLe
            -->
        </div>

    </div>
</div>

@endsection
@section('js')
<script>
require(['datatables', 'jquery'], function(datatable, $) {
    $('.datatable-client').DataTable({
        serverSide: true,
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
                        <a href="{{ route('create-project-step2') }}?client_id=${row['id']}" class="btn btn-outline-info btn-sm">Pilih</a>
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
                        <a href="{{ route('create-project-step2') }}?client_id=${row['id']}" class="btn btn-outline-info btn-sm">Pilih</a>
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
