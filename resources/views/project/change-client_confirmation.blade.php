@extends('template.master')
@section('title', 'Project')

@section('content')
    <div class="container">

        <div class="page-title text-center">{{ $project->name }}</div>

        {{-- there is no input that send by form since all input is passed via route parameter --}}
        <form
            action="{{ route('update-project-client', ['id' => $project->id, 'new_client_id' => $new_client->id]) }}"
            method="post">
            @csrf

            <div class="row mx-auto mt-5" style="width: 800px">
                <div class="col-5"><h4 class="text-center text-muted">Client Lama</h4></div>
                <div class="col-2"><!-- spacing --></div>
                <div class="col-5"><h4 class="text-center text-muted">Client Baru</h4></div>
                <div class="col-5">
                    @include('includes.cards.client', [
                        'ganti_button' => false,
                        'client' => $old_client,
                    ])
                </div>
                <div class="col-2 text-center">
                    <div style="line-height: 150px">
                        <i style="font-size: 40px" class="fe fe-arrow-right"></i>
                    </div>
                </div>
                <div class="col-5">
                    @include('includes.cards.client', [
                        'ganti_button' => false,
                        'client' => $new_client,
                    ])
                </div>

                <div class="col-12">
                    <div class="card p-3">
                        <div class="btn-list ml-auto">
                            <a href="{{ route('project-detail', ['id' => $project->id]) }}" class="btn btn-link">Batalkan</a>
                            <button class="btn btn-primary">Ya, Ubah Client</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
