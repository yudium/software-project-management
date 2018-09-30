<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <input type="text" name="{{ $name }}" class="form-control" id="{{ $id }}" style="{{ $css OR '' }}" value="{{ old($name) }}">
</div>

<script>
require(['pickadate_date', 'jquery'], function(pickadate_date, $){
    $('#{{ $id }}').pickadate();
});
</script>
