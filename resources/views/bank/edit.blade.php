@extends('template.master')
@section('title', 'Form Ubah Bank')

@section('content')
    <div class="container">

        <form style="width: 350px" class="card mx-auto" action="{{ route('update-bank', ['id' => $bank->id]) }}" method="post">
            @csrf

            <div class="card-body">
                <div class="card-title">Ubah Bank</div>

                <div class="form-group">
                    <label class="form-label" for="name">Bank Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Masukan bank name" value="{{ $bank->name }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="account_number">No. Rekening</label>
                    <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Masukan no. rekening" value="{{ $bank->account_number }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">Atas Nama</label>
                    <input type="text" name="owner" class="form-control" id="owner" placeholder="Masukkan nama pemilik rekening" value="{{ $bank->owner }}" required>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </div>
        </form>

    </div>
@endsection
