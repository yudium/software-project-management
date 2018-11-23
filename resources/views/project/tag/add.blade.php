@extends('template.master')
@section('title', 'Tambah Tag Proyek')

@section('css')
<style>
.col-form {
    margin: 0 auto;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.form-control.selectize-control {
    /**
     * the form-control class has fixed. I want the selectize control height to
     * to be auto so if the input value is wrapped. The rest html can adjust.
     */
    height: auto ! important;
}
</style>
@endsection

@section('content')

    @include('stepwizard', [
        'steps' => [
            ['text' => 'step1', 'url' => '#step1'],
            ['text' => 'step2', 'url' => '#step2'],
            ['text' => 'step3', 'url' => '#step3'],
            ['text' => 'step4', 'url' => '#step3', 'active' => true],
        ]
    ])

    <div class="container">

        <div class="page-header">
            <h1 class="page-title mx-auto">
                Tambah Tag
            </h1>
        </div>

        <div class="col-4 col-form">

            @component('includes.alert-success')
                Proyek tersimpan
            @endcomponent

            <div class="card">
                <div class="card-body">
                <form method="POST" action="{{ route('store-project-step4', ['id' => $project->id]) }}">
                    <fieldset class="form-fieldset">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="name">Tag <span class="form-required">*</span></label>
                            <input id="tags" class="form-control" type="text" name="tags" required>
                        </div>

                        <div class="d-flex">
                            <a href="{{ route('project-detail', ['id' => $project->id]) }}" class="btn btn-link">Lewati</a>
                            <button class="btn btn-primary ml-auto">Simpan</button>
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    require(['jquery', 'selectize'], function($, selectize) {
        $(document).ready(function(){
            $('#tags').selectize({
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                },
                valueField: 'value',
                labelField: 'value',
                searchField: ['value'],
                options: [

                    @foreach ($available_tags as $tag)
                        { value: '{{ $tag->name }}' },
                    @endforeach

                ],
            });
        });
    });
</script>
@endsection
