<div class="card">
    {{-- <div class="table-responsive"> --}}
        <!-- removed class: text-nowrap -->
        <table class="table table-hover table-outline table-vcenter card-table {{ $class ?? '' }}">
            {{ $slot }}
        </table>
    {{-- </div> --}}
</div>
