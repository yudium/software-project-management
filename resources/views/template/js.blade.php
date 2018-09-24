<script src="{{ asset('/js/require.min.js') }}"></script>
<script src="{{ asset('/js/dashboard.js') }}"></script>
<script src="{{ asset('/plugins/charts-c3/plugin.js') }}"></script>
<script src="{{ asset('/plugins/maps-google/plugin.js') }}"></script>
<script src="{{ asset('/plugins/input-mask/plugin.js') }}"></script>
<script src="{{ asset('/plugins/datatables/plugin.js') }}"></script>
<script src="{{ asset('/js/vendors/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/vendors/jquery.nestable.js') }}"></script>
<script>
        // TODO: ubah ini
        requirejs.config({
            baseUrl: 'http://127.0.0.1:8000'
        });
</script>