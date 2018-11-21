@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

@section('content')
    <div class="container">

        <form style="width: 350px" class="card mx-auto" action="{{ route('store-setting') }}" method="post">
            @csrf

            <div class="card-body">
                <div class="card-title">Buat Setting Baru</div>

                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Masukan name" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="value">Value</label>
                    <input type="text" name="value" class="form-control" id="value" placeholder="Masukan value" required>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </div>
        </form>

    </div>
@endsection
