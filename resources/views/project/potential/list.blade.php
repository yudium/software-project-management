@extends('template.master')
@section('title', 'Proyek Potensial: Daftar')

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
            Daftar Proyek Potensial
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center w-1"></th>
                <th>Client</th>
                <th class="text-center w-1">Jenis</th>
                <th>Proyek</th>
                <th>Tanggal Input</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="6">
                    <div class="loader mx-auto"></div>
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
            ajax: '{{ route('potential-project-list-ajax') }}',
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
                        {{-- TODO: cari pengganti cara ini. Kurang sreg --}}
                        return `
                            <a href="{{ url('/project/potential/follow-up/') }}/${row['id']}" class="btn btn-primary btn-sm mr-2">Follow Up</a>
                            <a href="{{ url('/project/potential/history') }}/${row['id']}"  class="btn btn-secondary btn-sm">Lihat Riwayat</a>
                            <a class="icon ml-5" href="{{ url('/project/potential/delete/confirmation/') }}/${row['id']}">
                                <i class="fe fe-trash-2"></i>
                            </a>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 5,
                },
            ],
            columns: [
                { data: 'client.photo' },
                { data: 'client.name' },
                { data: 'project_type.icon' },
                { data: 'project_name' },
                { data: 'created_at' },

                { data: null },
            ]
        });
    });
    </script>
@endsection
