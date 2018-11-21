@extends('template.master')
@section('title', 'Daftar Bank')

@section('content')
    <div class="container">
        @component('pagetitle')
            Daftar Bank
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center">Nama Bank</th>
                <th>No. Rekening</th>
                <th>Atas Nama</th>
                <th class="text-center"><i class="icon-settings"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="4">
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
            ajax: '{{ route('bank-list-ajax') }}',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return `
                            <a href='{{ url('/bank/delete') }}/${ row['id'] }' class=''><i class="fe fe-trash-2"></i> Hapus</a>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 3,
                },
            ],
            columns: [
                { data: 'name' },
                { data: 'account_number' },
                { data: 'owner' },
                { data: null },
            ]
        });
    });
    </script>
@endsection
