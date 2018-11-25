@extends('template.master')
@section('title', 'Tambah Proyek Potensial: Pilih Tipe Proyek')

@section('css')
<style>

/* TODO: cek buat apa */
.button-step .btn {
width: 140px;
display: inline-block;
}
.button-step .btn-as-text {
width: 60px;
}

.page-title { margin: auto }

.clearfix::after {
content: "";
clear: both;
display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.check-circle-container {
    position: relative;
}
.check-circle {
    display: hidden;
    position: absolute;
    top: -7px;
    right: -3px;
    font-size: 17px;
    color: green;
    font-weight: bold;
    text-shadow: 0px 1px #fff;
}
</style>
@endsection

@section('content')

    @include('stepwizard', [
        'steps' => [
            ['text' => 'step1', 'url' => '#step1'],
            ['text' => 'step2', 'url' => '#step2', 'active' => true],
            ['text' => 'step3', 'url' => '#step3'],
        ]
    ])

    <div class="container">

        <div class="page-header">
            <h1 class="page-title">
                Pilih Jenis Proyek
            </h1>
        </div>

        <!-- TODO: change to Platform (not type) and add tag -->

        <div class="row row-cards">
            <div class="col col-3 mx-auto">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <tbody>
                                @foreach ($project_types as $project_type)
                                <tr>
                                    <td width="10%" class="text-center"><i class="{{ $project_type->icon }} text-muted"></i></td>
                                    <td width="80%">{{ $project_type->name }}</td>
                                    <td width="10%" class="text-center">
                                        <span class="check-circle-container">
                                            <a href="#" data-project-type-id="{{ $project_type->id }}" class="btn btn-outline-info btn-sm">Pilih</a>
                                            <i class="fe fe-check-circle check-circle"></i>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards">
            <div class="col col-3 mx-auto">
                <a id="next_button" href="{{ route('create-potential-project-step3') . '?client_id=' . $client_id }}" class="btn btn-primary disabled">Berikutnya</a>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    require(['jquery'], function($) {
        $(document).ready(function(){
            $(".check-circle").hide();
            $(".check-circle-container a").click(function(e){
                e.preventDefault();
                $(".check-circle").hide();
                $(this).closest(".check-circle-container").find(".check-circle").show();

                let project_type_id = $(this).data('project-type-id');
                $("#next_button").attr('href', $("#next_button").attr('href').replace(/&project_type_id=\d+/, ''));
                $("#next_button").attr('href', $("#next_button").attr('href') + '&project_type_id=' + project_type_id);

                $("#next_button").removeClass('disabled');
            });
        });
    });
</script>
@endsection
