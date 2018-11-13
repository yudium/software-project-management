@extends('template.master')
@section('title', 'Client')
@section('css')
<style>
    .stepwizard {
                    display: table;
                    width: 100%;
                    position: relative;
                    margin-top: 40px;
                }
                .stepwizard p {
                    margin-top: 10px;
                }
                .stepwizard-row {
                    display: table-row;
                }
                .stepwizard-row:before {
                    top: 14px;
                    bottom: 0;
                    position: absolute;
                    content: " ";
                    width: 100%;
                    height: 1px;
                    background-color: #ccc;
                    z-order: 0;
                }
                .stepwizard-step {
                    display: table-cell;
                    text-align: center;
                    position: relative;
                }
                .stepwizard-step .btn.disabled {
                    opacity: 1 !important;
                    filter: alpha(opacity=100) !important;
                }
                
                .clearfix::after {
                    content: "";
                    clear: both;
                    display: table;
                }
                .clearfix .left, .clearfix .right {display: inline-block}
                .clearfix .left {float: left}
                .clearfix .right {float:right}
                
                .multiple-field-js {
                    background: #f8f8f8;
                    border: none;
                }
                .multiple-field-copy-target .fe {
                    color: #a19090
                }
                
                #photo-preview {
                    width: 8rem;
                    height: 8rem;
                    margin: 0 auto;
                    background: #cecece;
                    color: #a4a3a3; /* for icon */
                }
                
                #photo-preview .fe {
                    font-size: 128px;
                }
                </style>
@endsection
@section('content')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-secondary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-primary btn-circle disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-secondary btn-circle disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>


<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Form Tambah Client
        </h1>
    </div>
    <form method="post" action="{{ route('createClientForm') }}">
            @csrf
        <div class="row row-cards">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label class="form-label" for="name">Nama <span class="form-required">*</span></label>
                            <input class="form-control" type="text" name="nama">
                            
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis</label>
                            <input name="tipeClient" type="hidden" value="{{ $idType->id }}">
                            <div class="form-control-plaintext"><i class="{{ $idType->icon }} mr-3" value="{{ $idType->id }}"
                                    name="jenisClient"></i> {{ $idType->name }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status hubungan bisnis</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input name="statusHub" value="Dekat" class="selectgroup-input" checked="" type="radio"
                                        name="statusHub">
                                    <span class="selectgroup-button">Dekat</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input name="statusHub" value="Normal" class="selectgroup-input" type="radio" name="statusHub">
                                    <span class="selectgroup-button">Normal</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input name="statusHub" value="Buruk" class="selectgroup-input" type="radio" name="statusHub">
                                    <span class="selectgroup-button">Buruk</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" type="text"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kota</label>
                            @include('includes.form-element.multiple-input', [
                            'id' => 'multi-kota',
                            'name' => 'kota[]',
                            'number' => 1,
                            ])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Telepon</label>
                            @include('includes.form-element.multiple-input', [
                            'id' => 'multi-telepon',
                            'name' => 'telepon[]',
                            'number' => 1,
                            ])
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            @include('includes.form-element.multiple-input', [
                            'id' => 'multi-email',
                            'name' => 'email[]',
                            'number' => 1,
                            ])
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. Rekening</label>
                            @include('includes.form-element.multiple-input', [
                            'id' => 'multi-norek',
                            'name' => 'norek[]',
                            'number' => 1,
                            ])
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat web</label>
                            @include('includes.form-element.multiple-input', [
                            'id' => 'multi-web',
                            'name' => 'web[]',
                            'number' => 1,
                            ])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Unggah Foto</h6>
                                <div id="photo-preview" class="mb-4 mt-4">

                                    <i class="fe fe-user"></i>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="foto" type="file" id="fotoProfile">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
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
    require(['datatables', 'jquery'], function (c3, $) {
    $(document).ready(function () {
        $(".form-group").on("click", ".multiple-field-js", function () {
            let el = $(this);
            let clonedTarget = el.parent().children(".multiple-field-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.children("input")
                .val("")
                .focus();
        });

        
        $('#fotoProfile').change(function () {
            var imgPath = $(this)[0].value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });

        $('#btn-kota').on('click',function(){
            $('.btn-kota').parent.parent.remove()
        })

       
    })
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#photo-preview').html('<img src="'+e.target.result+'" height="128" width="128"> ');
        }
    }
}
</script>

@endsection