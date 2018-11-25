@extends('template.master')
@section('title', 'Hapus Setting')

@section('css')
<style>
/* to emphasize checkbox in this page only */
.custom-control-input ~ .custom-control-label::before {
    box-shadow: 0 0 0 1px #f5f7fb, 0 0 0 2px rgba(70, 127, 207, 0.25);
}
</style>
@endsection

@section('content')
<div class="container">

    <form action="">
        <div class="card mx-auto" style="width: 400px;">
            <div class="card-header">
                <h3 class="card-title">Konfirmasi Hapus Setting</h3>
            </div>
            <div class="card-body">
                <p>
                    <div class="text-center mb-6">
                        <div>
                            Anda akan menghapus setting:
                        </div>
                        <b>{{ $setting->name }}</b>
                    </div>

                    @component('includes.alert-warning')
                        Hati-hati. Mungkin berdampak pada bagian aplikasi yang membutuhkan setting ini
                    @endcomponent

                    <div class="form-group">
                        <label class="custom-control custom-control-inline custom-checkbox ml-7">
                            <input id="confirmation-check" type="checkbox" class="custom-control-input confirmation-check" name="ignoreme-2" value="ignoreme">
                            <span class="custom-control-label">Saya sangat yakin hapus ini</span>
                        </label>
                    </div>
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ route('setting-list') }}" class="btn btn-secondary">Batal</a>
                    <a id="primary-button" href="{{ route('delete-setting', ['name' => $setting->name]) }}" class="btn btn-danger ml-auto disabled">Hapus</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('js')
<script>
require(['jquery'], function($){
    $(document).ready(function(){
        // Toggle 'berikutnya' button between not-clickable and clickable
        $('#confirmation-check').change(function(){
            if ($(this).prop('checked') == true) {
                $('#primary-button').removeClass('disabled');
            } else {
                $('#primary-button').addClass('disabled');
            }
        });
    });
});
</script>
@endsection
