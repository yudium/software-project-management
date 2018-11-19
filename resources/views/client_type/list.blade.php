@extends('template.master')
@section('title', 'Daftar Client Type')

@section('content')
    <div class="container">
        @component('pagetitle')
            Daftar Client Type
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center">Icon</th>
                <th>Nama Tipe</th>
                <th class="text-center"><i class="icon-settings"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="3">
                    <div class="loader mx-auto"></div>
                </td>
            </tr>
            </tbody>
        @endcomponent
    </div>

    <script>
    require(['datatables', 'jquery'], function(datatable, $) {
        $('.datatable').DataTable({
            serverSide: true,
            ajax: '{{ route('client-type-list-ajax') }}',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return `
                            <i class="icon-box"><i class="${data}"></i></i>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 0,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <a href='{{ url('/client-type/delete') }}/${ row['id'] }'><i class="fe fe-trash-2"></i> Hapus</a>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 2,
                },
            ],
            columns: [
                { data: 'icon' },
                { data: 'name' },
                { data: null },
            ]
        });
    });
    </script>
@endsection
