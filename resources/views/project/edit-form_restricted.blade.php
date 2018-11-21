{{-- NOTE: if project is not draft (that means is on progress state). Only allow
           edit field (1) Trello Board ID, (2) Backup and Project Link, (3) Note.

           So, I create this file for editing non-draft project.

           By the way, archive project is not allowed to edit.
--}}

@extends('template.master')
@section('title', 'Ubah Proyek: Form Utama')

@section('css')
<style>
.btn-as-text {
    color: #495057;
    border: none;
    box-shadow: none;
    background: transparent;
    cursor: pointer;
}

.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

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

    <div class="container">
        @include('pagetitle', ['title' => 'Form Ubah Proyek'])

        <form method="post" action="{{ route('update-restricted-project', ['id' => $project->id]) }}">
        @csrf

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
                </div>
            </div>

            <div class="col-4">
                @component('card', ['title' => 'Data Proyek'])
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Platform</label>
                                <div class="form-control-plaintext">
                                    <i class="{{ $project->project_type->icon }} mr-3"></i>
                                    {{ $project->project_type->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="name">Nama proyek <span class="form-required">*</span></label>
                                <div class="form-control-plaintext">
                                    {{ $project->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ID Board Trello</label>
                        <div class="row gutters-xs">
                            <div class="col">
                                <input class="form-control {{ $errors->has('trello_board_id') ? 'is-invalid' : '' }}" name="trello_board_id" type="text" value="{{ old('trello_board_id') ?? $project->trello_board_id }}">
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
                        <textarea class="form-control {{ $errors->has('additional_note') ? 'is-invalid' : '' }}" name="additional_note" rows="5">{{ old('additional_note') ?? $project->additional_note }}</textarea>
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

                        <!-- TODO: the script below is confusing. Make it more look simple and easy-to-understand -->
                        @component('includes.form-element.multiple-input-custom', [
                            'id' => 'multi-backuplink',
                            'label' => 'Link backup source code',
                            'name' => 'backup_source_code_project_link[]',
                            'number' => 1,
                        ])

                        @slot('predefined')
                            {{-- show backup link from [1] last input (that has validation fails) or [2] database --}}
                            @if (old('backup_source_code_project_link'))
                                @foreach (old('backup_source_code_project_link') as $backup_link)

                                    // old value can contain null from last
                                    // input form
                                    @if (! $backup_link)
                                        @continue
                                    @endif

                                    <div class="input-group mb-2">
                                        <input type="text" name="backup_source_code_project_link[]" class="awesomplete form-control mb-2" value="{{ $backup_link }}">
                                        <span class="input-group-append">
                                            <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                            <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($project->backup_source_code_project_links as $backup_link)
                                    <div class="input-group mb-2">
                                        <input type="text" name="backup_source_code_project_link[]" class="awesomplete form-control mb-2" autocomplete="off" value="{{ $backup_link->link_text }}">
                                        <span class="input-group-append">
                                            <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                            <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                        </span>
                                    </div>
                                @endforeach
                            @endif
                        @endslot

                        {{-- new input field for new backup link --}}
                        <div class="input-group mb-2 multi-input-copy-target">
                            <input type="text" name="backup_source_code_project_link[]" class="awesomplete form-control mb-2">
                            <span class="input-group-append">
                                <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                            </span>
                        </div>
                        @endcomponent

                        @if (count($errors->get('project_link.*')))
                            @component('includes.alert-danger')
                                @foreach ($errors->get('project_link.*') as $messages)
                                    @foreach ($messages as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                @endforeach
                            @endcomponent
                        @endif
                        @component('includes.form-element.multiple-input-custom', [
                            'id' => 'multi-projectlink',
                            'label' => 'Link proyek',
                            'name' => 'project_link[]',
                            'number' => 1,
                        ])

                        @slot('predefined')
                            {{-- show project link from [1] last input (that has validation fails) or [2] database --}}
                            @if (old('project_link'))
                                @foreach (old('project_link') as $project_link)

                                    // old value can contain null from last
                                    // input form
                                    @if (! $backup_link)
                                        @continue
                                    @endif

                                    <div class="input-group mb-2">
                                        <input type="text" name="project_link[]" class="awesomplete form-control mb-2" value="{{ $project_link }}">
                                        <span class="input-group-append">
                                            <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                            <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($project->project_links as $project_link)
                                    <div class="input-group mb-2">
                                        <input type="text" name="project_link[]" class="awesomplete form-control mb-2" autocomplete="off" value="{{ $project_link->link_text }}">
                                        <span class="input-group-append">
                                            <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                            <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                        </span>
                                    </div>
                                @endforeach
                            @endif
                        @endslot

                        {{-- new input field for new project link --}}
                        <div class="input-group mb-2 multi-input-copy-target">
                            <input type="text" name="project_link[]" class="awesomplete form-control mb-2">
                            <span class="input-group-append">
                                <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                            </span>
                        </div>
                        @endcomponent
                        {{-- TODO: check endcomponent for what? --}}
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
</script>
@endsection
