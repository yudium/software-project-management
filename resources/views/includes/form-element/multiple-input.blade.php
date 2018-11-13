{{-- TODO: in case validation fails, keep last input --}}

<div id="{{ $id }}" class="form-group">
    @isset($label)
    <label class="form-label" for="project_link">{{ $label }}</label>
    @endisset

    @for ($i = 0; $i < $number; $i++)
        <div class="input-group mb-2 multi-input-copy-target">
            <input name="{{ $name }}" class="form-control" type="text" value="{{ old($name) }}">
            <span class="input-group-append">

                <button style="height: auto" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
            </span>
        </div>
    @endfor
    <input class="form-control multi-input-control" name="{{ $id }}" type="text" placeholder="Add item..">
</div>

<script>
require(['jquery'], function($) {
    $(document).ready(function(){
        $("#{{ $id }}").on("click", ".multi-input-control", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multi-input-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.children("input")
                .val("")
                .focus();
        });

        $("#{{ $id }}").on("click", "button", function(){
            let el = $(this);
            let parent = el.closest(".input-group");
            parent.remove();
        });
    });
});
</script>
