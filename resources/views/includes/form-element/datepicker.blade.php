<div class="form-group">
    <label class="form-label">{!! $label !!}</label>
    <input type="text" name="{{ $name }}" class="form-control {{ $class ?? '' }}" id="{{ $id }}" style="{{ $css ?? '' }}" value="{{ old($name) }}">
</div>

<script>
require(['pickadate_date', 'jquery'], function(pickadate_date, $){
    $(document).ready(function(){
        let input = $('#{{ $id }}');

        let obj = $(input).pickadate();

        {{-- useful for edit page --}}
        @if (isset($date_value) AND isset($format_value))
            // I should take picker object. Don't blame me with this syntax. Checkout the API
            let picker = obj.pickadate('picker');

            // select date
            {{-- NOTE:
                (1) it will confusing since I use blade notation double bracket ({{).
                (2) refer format_value to pickadate.js website --}}
            picker.set('select', '{{ $date_value }}', { format: '{{ $format_value }}' });
        @endif

        @if (isset($required) AND $required == true)
            $(input).closest('form').submit(function(){
                if ($(input).val().trim() == '') {
                    alert('{{ $label }} belum dipilih');
                    // abort submit
                    return false;
                }
            });
        @endif
    });
});
</script>
