<div class="form-group">
    @isset($label)
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endisset

    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">Rp.</span>
        </span>
        <input id="{{ $id OR '' }}" name="{{ $name }}" class="{{ $class OR '' }}" placeholder="{{ $placeholder OR '' }}" type="text">
    </div>
</div>
<script>
require(['jquery', 'input-mask'], function($) {
    $(document).ready(function(){
        $('input[name="{{ $name  }}"]').mask('000.000.000.000.000', {'reverse': true});
        $('input[name="{{ $name  }}"]').closest('form').submit(function(){
            $('input[name="{{ $name  }}"]').unmask();
        });
    });
});
</script>
