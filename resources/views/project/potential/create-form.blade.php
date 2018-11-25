@extends('template.master')
@section('title', 'Tambah Proyek Potensial: Form Utama')

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

</style>
@endsection

@section('content')

    @include('stepwizard', [
        'steps' => [
            ['text' => 'step1', 'url' => '#step1'],
            ['text' => 'step2', 'url' => '#step2'],
            ['text' => 'step3', 'url' => '#step3', 'active' => true],
        ]
    ])

    <div class="container">

        <div class="page-header">
            <h1 class="page-title mx-auto">
                Form Tambah Proyek Potensial
            </h1>
        </div>

        <div class="col-4 col-form">
            <div class="card">
                <div class="card-body">
                <form method="POST" action="">
                    <fieldset class="form-fieldset">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <input type="hidden" name="project_type_id" value="{{ $project_type->id }}">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama proyek <span class="form-required">*</span></label>
                            <input class="form-control" type="text" name="project_name" required>
                        </div>
                        <button class="btn btn-primary btn-block">Simpan</button>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);
</script>
@endsection
