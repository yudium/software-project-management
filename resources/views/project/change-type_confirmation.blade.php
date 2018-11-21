@extends('template.master')
@section('title', 'Project')

@section('content')
    <div class="container">

        <div class="page-title text-center">{{ $project->name }}</div>

        {{-- there is no input that send by form since all input is passed via route parameter --}}
        <form
            action="{{ route('update-type-of-a-project', ['id' => $project->id, 'new_type_id' => $new_project_type->id]) }}"
            method="post">
            @csrf

            <div class="row mx-auto mt-5" style="width: 800px">
                <div class="col-5"><h4 class="text-center text-muted">Tipe Lama</h4></div>
                <div class="col-2"><!-- spacing --></div>
                <div class="col-5"><h4 class="text-center text-muted">Tipe Baru</h4></div>
                <div class="col-5">
                    <div class="card p-3">
                        <div class="card-status bg-blue"></div>
                        <div class="row">
                            <div class="col-4">
                                <i class="{{ $old_project_type->icon }} text-muted"></i>
                            </div>
                            <div class="col-8">
                                {{ $old_project_type->name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <div style="line-height: 70px">
                        <i style="font-size: 40px" class="fe fe-arrow-right"></i>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card p-3">
                        <div class="card-status bg-red"></div>
                        <div class="row">
                            <div class="col-4">
                                <i class="{{ $new_project_type->icon }} text-muted"></i>
                            </div>
                            <div class="col-8">
                                {{ $new_project_type->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card p-3">
                        <div class="btn-list ml-auto">
                            <a href="{{ route('project-detail', ['id' => $project->id]) }}" class="btn btn-link">Batalkan</a>
                            <button class="btn btn-primary">Ya, Ubah Tipe Proyek</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
