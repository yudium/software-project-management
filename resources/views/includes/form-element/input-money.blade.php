{{-- TODO: support error --}}

<div class="form-group">
    @isset($label)
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endisset

    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">Rp.</span>
        </span>
        <input id="{{ $id ?? '' }}" name="{{ $name }}" class="{{ $class ?? '' }} {{ $errors->has($name) ? 'is-invalid' : '' }}" placeholder="{{ $placeholder ?? '' }}" type="text" value="{{ $value ?? '' }}" @echoIf('readonly', $readonly ?? false) @echoIf('required', $required ?? false) }}>

        @if ($errors->has($name))
            @foreach ($errors->get($name) as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        @endif
    </div>
</div>
<script type="text/javascript">
require(['jquery', 'input-mask'], function($) {
    $(document).ready(function(){
        $('input[name="{{ $name  }}"]').mask('000.000.000.000.000', {'reverse': true});

        // I have problem with jQuery submit event
        //
        //      $(el).closest('form').submit(handler)
        //
        // because that script in this file not working if laravel view that
        // include this laravel partial view also using jQuery submit event.
        //
        // Maybe because?
        //
        //  - the <script> is placed inside <form> not in bottom part of html?
        //  - other reason?
        //
        // NOTE: maybe form is not the form where input-money field belongs to.
        //       hope it is not problem.
        //
        // Thanks: https://stackoverflow.com/questions/11172811/jquery-on-submit-doesnt-work
        $(document).on('submit', 'form', function(){
            $('input[name="{{ $name  }}"]').unmask();
        });

    });
});
</script>
