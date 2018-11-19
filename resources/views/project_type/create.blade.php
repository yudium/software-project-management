@extends('template.master')
@section('title', 'Tambah Tipe Project: Form Utama')

@section('content')
    <div class="container">

        <form style="width: 350px" class="card mx-auto" action="{{ route('store-project-type') }}" method="post">
            @csrf

            <div class="card-body">
                <div class="card-title">Buat Tipe Project Baru</div>

                <div class="form-group">
                    <label class="form-label" for="icon">Icon</label>
                    <input type="text" name="icon" class="form-control" id="icon" placeholder="Masukan icon">
                    <p class="hint text-muted"><small>Silakan masukkan kode icon CSS dari <a href="{{ route('icon-list') }}" target="_blank">icon list</a></small></p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">Nama Tipe</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Masukan nama tipe">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </div>
        </form>

    </div>
@endsection
