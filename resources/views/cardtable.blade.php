{{-- This partial view is *ONLY* for datatable <table> --}}
{{-- NOTE: your datatable <table> should use class '.datatable' --}}
<div class="card">
    {{-- you should remove 'active' class after data is has loaded --}}
    <div class="dimmer active">
        <div class="loader"></div>
        <div class="dimmer-content">
            <table class="table table-hover table-outline table-vcenter card-table {{ $class ?? '' }}">
                {{ $slot }}
            </table>
        </div>
    </div>
</div>

<script>
    require(['datatables', 'jquery', 'moment'], function(datatable, $, moment) {
        $(document).ready(function(){
            $('.datatable').on('processing.dt', function (e, settings, processing) {
                if (processing) {
                    // start loading
                    $('.dimmer').addClass('active');
                } else {
                    // loading is done
                    $('.dimmer').removeClass('active');
                }
            });
        });
    });
</script>
