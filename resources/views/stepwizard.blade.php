<style>
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
</style>

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        @foreach ($steps as $step)
            {{-- actually only different on class btn-primary or btn-secondary --}}
            @if (array_key_exists('active', $step))
                <div class="stepwizard-step">
                    <a href="{{ $step['url'] }}" type="button" class="btn btn-primary btn-circle">{{ $loop->iteration }}</a>
                    <p>{{ $step['text'] }}</p>
                </div>
            @else
                <div class="stepwizard-step">
                    <a href="{{ $step['url'] }}" type="button" class="btn btn-secondary btn-circle">{{ $loop->iteration }}</a>
                    <p>{{ $step['text'] }}</p>
                </div>
            @endif
        @endforeach
    </div>
</div>
