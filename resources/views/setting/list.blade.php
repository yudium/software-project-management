@extends('template.master')
@section('title', 'Settings')

@section('content')
    <div class="container">
        @component('pagetitle')
            Settings
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center">Name</th>
                <th>Value</th>
                <th class="text-center"><i class="icon-settings"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">tunggu..</td>
                <td>tunggu..</td>
            </tr>
            </tbody>
        @endcomponent
    </div>

    <script>
    require(['datatables', 'jquery'], function(datatable, $) {
        $('.datatable').DataTable({
            serverSide: true,
            ajax: '{{ route('setting-list-ajax') }}',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return `
                            <a href='{{ url('/setting/edit') }}/${ row['name'] }' class='btn btn-secondary btn-sm mr-2'>Ubah</a>
                            <a href='{{ url('/setting/delete') }}/${ row['name'] }' class='btn btn-secondary btn-sm'>Hapus</a>
                        `;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 2,
                },
            ],
            columns: [
                { data: 'name' },
                { data: 'value' },
                { data: null },
            ]
        });
    });
    </script>
@endsection
