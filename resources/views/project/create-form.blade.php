@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

@section('css')
<style>
.multi-input-control {
    background: #f8f8f8;
    border: none;
}
.multi-input-copy-target .fe {
    color: #a19090
}
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

        @include('pagetitle', ['title' => 'Form Tambah Proyek'])

        <form method="post" action="{{ route('store-project-step3') }}">
            @csrf

            {{-- if the new project is from Potential Project data then we have
                to store the id below --}}
            @isset($potential_project)
            <input name="potential_project_id" type="hidden" value="{{ $potential_project->id }}">
            @endisset

            <div class="row row-cards">
                <div class="col-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            @include('includes.cards.client', [
                                'ganti_button' => false,
                                'client' => $client,
                            ])
                            <input name="client_id" type="hidden" value="{{ $client->id }}">
                        </div>
                        <div class="col-12">
                            @component('card', ['title' => 'Person In Charge'])

                                @if (count($errors->get('PIC.*')))
                                    @component('includes.alert-danger')
                                        @foreach ($errors->get('PIC.*') as $messages)
                                            @foreach ($messages as $message)
                                                {{ $message }}<br>
                                            @endforeach
                                        @endforeach
                                    @endcomponent
                                @endif

                                @component('includes.alert-info')
                                    Fitur autocomplete menyediakan nama PIC yang terekam di DB
                                @endcomponent
                                <datalist id="PIC_list">
                                    @foreach ($PICs as $PIC)
                                    <option>{{ $PIC->name }}</option>
                                    @endforeach
                                </datalist>
                                @component('includes.form-element.multiple-input-custom', [
                                    'id' => 'multi-pic',
                                    'name' => 'PIC[]',
                                    'number' => 2,
                                ])
                                <div class="input-group mb-2 multi-input-copy-target">
                                    <input type="text" name="PIC[]" class="awesomplete form-control mb-2" list="PIC_list" autocomplete="off">
                                    <span class="input-group-append">
                                        <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                        <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                    </span>
                                </div>
                                @endcomponent
                            @endcomponent
                        </div>
{{--
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="tag">Tag</label>
                                <input class="form-control" type="text" name="tag" value="{{ old('tag') }}">
                            </div>
                        </div>
--}}
                    </div>
                </div>

                <div class="col-4">
                    @component('card', ['title' => 'Data Proyek'])
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tipe Proyek</label>
                                    <div class="form-control-plaintext">
                                        <i class="{{ $project_type->icon }} mr-3"></i>
                                        {{ $project_type->name }}
                                    </div>
                                    {{-- dont worry, covered by $request->old() in controller in case of validation fails --}}
                                    <input name="project_type_id" type="hidden" value="{{ $project_type->id }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nama proyek <span class="form-required">*</span></label>
                                    {{-- potential project has project name so use this, if current new project is from potential project --}}
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $potential_project->project_name ?? old('name') }}">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="name">Kuantitas</label>
                                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" value="{{ old('quantity') }}">
                                    @if ($errors->has('quantity'))
                                        @foreach ($errors->get('quantity') as $message)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label class="form-label" for="price">Harga</label>
                                <div class="input-group">
                                    <span id="basic-addon1" class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </span>
                                    <input id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" value="{{ old('price') }}">
                                    @if ($errors->has('price'))
                                        @foreach ($errors->get('price') as $message)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                @if ($errors->has('DP_time'))
                                    @component('includes.alert-danger')
                                    @foreach ($errors->get('DP_time') as $message)
                                        {{ $message }}
                                    @endforeach
                                    @endcomponent
                                @endif
                                @include('includes.form-element.datepicker', [
                                    'label' => 'Tanggal Bayar DP',
                                    'id' => 'DP-time',
                                    'name' => 'DP_time',
                                ])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">ID Board Trello</label>
                            <div class="row gutters-xs">
                                <div class="col">
                                    <input class="form-control {{ $errors->has('trello_board_id') ? 'is-invalid' : '' }}" name="trello_board_id" type="text" value="{{ old('trello_board_id') }}">
                                    @if ($errors->has('trello_board_id'))
                                        @foreach ($errors->get('trello_board_id') as $message)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <span class="col-auto">
                                    <a href="https://trello.com" target="_blank" class="btn btn-secondary">Buka Trello</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="note">Catatan</label>
                            <textarea class="form-control {{ $errors->has('additional_note') ? 'is-invalid' : '' }}" name="additional_note" rows="5">{{ old('additional_note') }}</textarea>
                            @if ($errors->has('additional_note'))
                                @foreach ($errors->get('additional_note') as $message)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endforeach
                            @endif
                        </div>
                    @endcomponent
                </div>
                <div class="col-4">
                    <div class="row row-cards">
                        <div class="col-12 mb-5">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                        <div class="col-12">
                            @component('card', ['title' => 'Waktu Proyek'])
                            <div class="row">
                                <div class="col">
                                @if ($errors->has('starttime'))
                                    @component('includes.alert-danger')
                                    @foreach ($errors->get('starttime') as $message)
                                        {{ $message }}
                                    @endforeach
                                    @endcomponent
                                @endif
                                @include('includes.form-element.datepicker', [
                                    'label' => 'Mulai',
                                    'id' => 'starttime',
                                    'name' => 'starttime',
                                ])
                                </div>
                                <div class="col">
                                @if ($errors->has('endtime'))
                                    @component('includes.alert-danger')
                                    @foreach ($errors->get('endtime') as $message)
                                        {{ $message }}
                                    @endforeach
                                    @endcomponent
                                @endif
                                @include('includes.form-element.datepicker', [
                                    'label' => 'Berakhir',
                                    'id' => 'endtime',
                                    'name' => 'endtime',
                                ])
                                </div>
                            </div>
                            @endcomponent
                        </div>
                        <div class="col-12">
                            @component('card', ['title' => 'Link Proyek'])
                            @if (count($errors->get('backup_source_code_project_link.*')))
                                @component('includes.alert-danger')
                                    @foreach ($errors->get('backup_source_code_project_link.*') as $messages)
                                        @foreach ($messages as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    @endforeach
                                @endcomponent
                            @endif
                            @include('includes.form-element.multiple-input', [
                                'id' => 'multi-backuplink',
                                'label' => 'Link backup source code',
                                'name' => 'backup_source_code_project_link[]',
                                'number' => 1,
                            ])
                            @if (count($errors->get('project_link.*')))
                                @component('includes.alert-danger')
                                    @foreach ($errors->get('project_link.*') as $messages)
                                        @foreach ($messages as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    @endforeach
                                @endcomponent
                            @endif
                            @include('includes.form-element.multiple-input', [
                                'id' => 'multi-projectlink',
                                'label' => 'Link proyek',
                                'name' => 'project_link[]',
                                'number' => 1,
                            ])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    require(['jquery', 'global_functions'], function($, g){
        $(document).ready(function(){
            // TODO; move this clean mask to input-money.blade.php
            $('form').submit(function(){
                $('#price').val(g.cleanValMask($('#price').val()));
            });
        });
    });
</script>
@endsection
