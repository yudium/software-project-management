@extends('template.master')
@section('title', 'Tambah Bank: Form Utama')

@section('content')
    <div class="container">

        <form style="width: 350px" class="card mx-auto" action="{{ route('store-bank') }}" method="post">
            @csrf

            <div class="card-body">
                <div class="card-title">Tambah Bank</div>

                <div class="form-group">
                    <label class="form-label" for="name">Bank Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Masukan bank name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="account_number">No. Rekening</label>
                    <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Masukan no. rekening">
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">Atas Nama</label>
                    <input type="text" name="owner" class="form-control" id="owner" placeholder="Masukkan nama pemilik rekening">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </div>
        </form>

    </div>
@endsection
