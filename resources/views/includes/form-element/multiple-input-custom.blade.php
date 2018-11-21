{{-- TODO: in case validation fails, keep last input --}}

<div id="{{ $id }}">
    @isset($label)
    <label class="form-label" for="project_link">{{ $label }}</label>
    @endisset

    {{-- predefined contain html that should included. Useful for edit page --}}
    @isset ($predefined)
        {{ $predefined }}
    @endisset

    @for ($i = 1; $i <= $number; $i++)
        <div class="multi-input-copy-target">
            {{-- User can use `--iteration--` format to display number of iteration --}}
            {!! str_replace('--iteration--', '<span class="iteration">'.$i.'</span>', $slot) !!}
        </div>
    @endfor
    <input class="form-control multi-input-control mb-2 {{ $class ?? '' }}" name="{{ $id }}" data-iteration="$number" type="text" placeholder="Add item..">
</div>

<script>
require(['jquery'], function($) {
    $(document).ready(function(){

        $("#{{ $id }}").on("click", ".multi-input-control", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multi-input-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            $(insertedEl).find("input")
                .val("")
                .focus();

            // in case of we need to display iteration
            $("#{{ $id }} span.iteration").each(function(index){
                $(this).text(index+1);
            });
        });

        $("#{{ $id }}").on("click", "button", function(){
            let el = $(this);
            let parent = el.closest(".input-group");
            parent.remove();
        });
    });
});
</script>
