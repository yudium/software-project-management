@extends('template.master')
@section('title', 'Aktifasi Proyek: Konfirmasi')

@section('css')
<style>
.container--center-vertically {
    position: relative;
    display: block;
    height: 100%;
}

/* I think the top value is for this page only */
.content--center-vertically {
    position: absolute;
    top: 40%;
}

/* to emphasize checkbox in this page only */
.custom-control-input ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #f5f7fb, 0 0 0 2px rgba(70, 127, 207, 0.25);
}
</style>
@endsection

@section('content')
<div class="container">

    <div class="row mx-auto">
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <h4 class="text-center">
                Pastikan Data Proyek Benar
            </h4>
            <hr>
        </div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <div class="container--center-vertically">
                <div class="content--center-vertically">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input confirmation-check" name="ignoreme-1" value="ignoreme">
                        <span class="custom-control-label">Paham tidak bisa ubah data</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <small>
                        Anda tidak bisa mengubah data lagi setelah aktifasi.<br>
                        Kecuali:
                        <ol>
                            <li>Trello board id</li>
                            <li>Link backup dan proyek</li>
                            <li>Catatan</li>
                        </ol>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <div class="container--center-vertically">
                <div class="content--center-vertically">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input confirmation-check" name="ignoreme-2" value="ignoreme">
                        <span class="custom-control-label">Data proyek sudah benar</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $project->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Tipe Proyek</label>
                                <div class="form-control-plaintext">
                                    <i class="{{ $project->project_type->icon }} mr-3"></i>
                                    {{ $project->project_type->name }}
                                </div>
                                {{-- dont worry, covered by $request->old() in controller in case of validation fails --}}
                                <input name="project_type_id" type="hidden" value="{{ $project->project_type->id }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="form-control-plaintext">
                                    @if ($project->status == \App\Project::IS_DRAFT)
                                        <span class="badge badge-secondary">Draft</span>
                                    @endif
                                    @if ($project->status == \App\Project::IS_ONPROGRESS)
                                        <span class="badge badge-primary">Berjalan</span>
                                    @endif
                                    @if ($project->status == \App\Project::IS_DONE_FAIL)
                                        <span class="badge badge-danger">Selesai [gagal]</span>
                                    @endif
                                    @if ($project->status == \App\Project::IS_DONE_SUCCESS)
                                        <span class="badge badge-success">Selesai [sukses]</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">ID Board Trello</label>
                                <div class="form-control-plaintext">
                                    @if ($project->trello_board_id)
                                        <a href="http://trello.com/b/{{ $project->trello_board_id }}" target="_blank">
                                            {{ $project->trello_board_id }}
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Dimulai pada</label>
                                <div class="form-control-plaintext">
                                    @if ($project->starttime)
                                        {{ date('d M Y', strtotime($project->starttime)) }}
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Berakhir pada</label>
                                <div class="form-control-plaintext">
                                    @if ($project->endtime)
                                        {{ date('d M Y', strtotime($project->endtime)) }}
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Bayar DP</label>
                                <div class="form-control-plaintext">
                                    @if ($project->DP_time)
                                        {{ date('d M Y', strtotime($project->DP_time)) }}
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="price">Kuantitas</label>
                                <div class="form-control-plaintext">
                                    @if ($project->quantity)
                                        {{ $project->quantity }}
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="price">Nilai</label>
                                <div class="form-control-plaintext">
                                    @if ($project->price)
                                        Rp.@money($project->price)
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <div class="container--center-vertically">
                <div class="content--center-vertically">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input confirmation-check" name="ignoreme-3" value="ignoreme">
                        <span class="custom-control-label">PIC sudah benar</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Person In Charge</h4>
                </div>
                <table class="table card-table">
                <tbody>
                    @echoIf ('<td><small><i>Belum diatur</i></small></td>', $project->PICs->count() == 0)

                    @foreach ($project->PICs as $PIC)
                    <tr>
                        <td width="1">#{{ $loop->iteration }}</td>
                        <td>{{ $PIC->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <h4 class="text-center mt-6">
                Pastikan Client Benar
            </h4>
            <hr>
        </div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <div class="container--center-vertically">
                <div class="content--center-vertically">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input confirmation-check" name="ignoreme-4" value="ignoreme">
                        <span class="custom-control-label">Client sudah benar</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-4">
            @include('includes.cards.client', [
                'ganti_button' => false,
                'client' => $client,
            ])
        </div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4"><!-- spacing --></div>
        <div class="col-4">
            <div class="mt-8">
                <a id="berikutnya-btn" href="{{ route('project-activation-step2', ['id' => $project->id]) }}" class="btn btn-primary btn-block disabled">Berikutnya</a>
                <a href="" class="btn btn-secondary btn-block">Batalkan</a>
            </div>
        </div>
        <div class="col-4"></div>
    </div>

</div>
@endsection

@section('js')
<script>
require(['jquery'], function($){
    $(document).ready(function(){
        // Toggle 'berikutnya' button between not-clickable and clickable
        $('.confirmation-check').change(function(){
            // get information about: is all checked?
            let all_checked = true;
            $('.confirmation-check').each(function(index){
                if ($(this).prop('checked') == false) {
                    all_checked = false;
                }
            });

            // do action from checked information
            if (all_checked) {
                $('#berikutnya-btn').removeClass('disabled');
            } else {
                $('#berikutnya-btn').addClass('disabled');
            }
        });
    });
});
</script>
@endsection
