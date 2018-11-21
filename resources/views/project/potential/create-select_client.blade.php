@extends('template.master')
@section('title', 'Tambah Proyek Potensial')

@section('content')

    @include('stepwizard', [
        'steps' => [
            ['text' => 'step1', 'url' => '#step1', 'active' => true],
            ['text' => 'step2', 'url' => '#step2'],
            ['text' => 'step3', 'url' => '#step3'],
        ]
    ])

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
                                    <td class="text-center" colspan="4">
                                        <div class="loader mx-auto"></div>
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
                                    <td class="text-center" colspan="4">
                                        <div class="loader mx-auto"></div>
                                    </td>
                                </tr>
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
        ajax: '{{ route('create-project-step1-client-ajax') }}',
        // because I want to remove sort icon for col 0
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
                            <span class="badge badge-secondary">${row['type']['name']}</span>
                        </div>
                    `;
                },
                targets: 1,
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="{{ route('create-potential-project-step2') }}?client_id=${row['id']}" class="btn btn-outline-info btn-sm">Pilih</a>
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
                            <span class="badge badge-secondary">${row['type']['name']}</span>
                        </div>
                    `;
                },
                targets: 1,
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="{{ route('create-potential-project-step2') }}?client_id=${row['id']}" class="btn btn-outline-info btn-sm">Pilih</a>
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
