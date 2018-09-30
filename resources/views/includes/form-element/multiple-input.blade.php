{{-- we encourage user to include `[]` in <input> name. it prevent us from
     using old() function, so we stripped for that purpose --}}
@php ($name_stripped = str_replace(array('[', ']'), array('', ''), $name))

<div id="{{ $id }}" class="form-group">
    @isset($label)
    <label class="form-label" for="project_link">{{ $label }}</label>
    @endisset

    {{-- for initial state, the number of field is given by $number.
         But in case of validation fails, we must keep the number of field
         correspond to previous input --}}
    @if (old($name_stripped))
        @foreach (old($name_stripped) as $old_value)
        <div class="input-group mb-2 multi-input-copy-target">
            <input name="{{ $name }}" class="form-control" type="text" value="{{ $old_value }}">
            <span class="input-group-append">
                <!-- I need CSS's height auto because this button behave weirdly.
                    It is height is set to 100% and display normally when this code
                    still in Tabler source code environment. Then goes weirdly
                    after I put the code inside this laravel -->
                <button style="height: auto" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
            </span>
        </div>
        @endforeach
    @else
        @for ($i = 0; $i < $number; $i++)
        <div class="input-group mb-2 multi-input-copy-target">
            <input name="{{ $name }}" class="form-control" type="text" value="{{ old($name) }}">
            <span class="input-group-append">
                <!-- I need CSS's height auto because this button behave weirdly.
                    It is height is set to 100% and display normally when this code
                    still in Tabler source code environment. Then goes weirdly
                    after I put the code inside this laravel -->
                <button style="height: auto" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
            </span>
        </div>
        @endfor
    @endif
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
