
@extends('template.master')
@section('title','Client')
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
    
    .multiple-row-js {
        background: #f8f8f8;
        border: none;
        text-align: center;
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
    
    .custom-file-input, .custom-file-label {
        display: none;
    }
    .custom-file {
        position: relative;
        width: 128.217px;
    }
    .custom-file .custom-file-button {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        padding-left: 40px;
    }
    .custom-file .photo-preview {
        position: absolute;
        top: 1px;
        left: 1px;
        z-index: 2;
        border-bottom: 4px solid red;
        box-sizing: initial;
        border-radius: 0;
    }
    
    .focus-long-field:focus {
        position: absolute;
        top: 0;
        z-index: 10;
    }
    .focus-long-field-right-to-left:focus {
        position: absolute;
        right: 0;   /* */
        top: 0;
        z-index: 10;
    }
    
    textarea.form-control {
        height: 38px;
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
            <a href="#step-2" type="button" class="btn btn-secondary btn-circle disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-primary btn-circle disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>

<div class="container">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></p>
    @endif
    <div class="page-header">
        <h1 class="page-title">


            Form Orang Dalam Client
        </h1>
    </div>
    <form method="post" action="{{ route('createClientInsider') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="did" value="{{ $idClient}}">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">

                        <script type="text/template" id="insiderTemplate">
                        <div class="row gutters-xs multiple-row-copy-target" id="multiple-row-copy@{{ idInsider}}" >
                            <div class="col-2">
                                <input class="form-control" name="nama[@{{idInsider}}]" placeholder="Nama" type="text">
                            </div>
                            <div class="col-1">
                                <input class="form-control focus-long-field" name="jabatan[@{{idInsider}}]" placeholder="Jabatan"
                                    type="text" data-focus-width="200px">
                            </div>
                            <div class="col-1">
                                <input class="form-control focus-long-field" name="alamat[@{{idInsider}}]" placeholder="Alamat"
                                    type="text" data-focus-width="400px">
                            </div>
                            <div class="col-2">
                                <div class="input-group mb-2 multiple-field-copy-target">
                                    <input class="form-control" name="telepon[@{{idInsider}}][]" type="text" placeholder="Telepon">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-secondary removeTelepon"><i class="fe fe-x"></i></button>
                                    </span>
                                </div>
                                <input class="form-control multiple-field-js mb-2" name="telepon[@{{idInsider}}][]" type="text"
                                    placeholder="Add item..">
                            </div>
                            <div class="col-2">
                                <div class="input-group mb-2 multiple-field-copy-target">
                                    <input class="form-control" type="text" name="email[@{{idInsider}}][]" placeholder="Email">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-secondary removeEmail"><i class="fe fe-x" ></i></button>
                                    </span>
                                </div>
                                <input class="form-control multiple-field-js mb-2" name="email[@{{idInsider}}][]" type="text"
                                    placeholder="Add item..">
                            </div>
                            <div class="col-2">
                                <div class="form-group" style="width: 128.217px; height: 2.375rem !important; margin: 0 auto">
                                    <div class="custom-file">
                                        <input class="custom-file-input fotoProfile" name="fotoProfile[@{{idInsider}}]" id="fotoProfile" type="file" >
                                        <label class="custom-file-label">Choose file</label>
                                        <div class="preview-foto">
                                        <span class="photo-preview avatar"  style="background-image: url(./demo/faces/female/25.jpg)"></span></div>
                                        <button type="button" class="btn btn-secondary custom-file-button" data-file-element=".custom-file-input">Unggah
                                            foto</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <textarea class="form-control focus-long-field-right-to-left" name="keterangan[@{{idInsider}}]"
                                        placeholder="Content.." data-focus-width="500" data-focus-height="200">Keterangan...</textarea>
                                </div>
                            </div>
                        </div>
                    </script>
                    <div id='insider-copy'></div>
                        <input class="form-control multiple-row-js mt-3 mb-2" name="example-text-input" type="text"
                            placeholder="Tambah baris..">
                    </div>
                </div>
                <!--
                    <div class="card-footer">
                        This is standard card footer
                    </div>
                -->
            </div>

            <div class="clearfix">
                <div class="right">
                    <button class="btn btn-primary" style="width: 205.5px">Simpan</button>
                </div>
                <div class="right mr-3">
                    <a href="{{ route('clientList') }}" class="btn btn-outline-primary" style="width: 205.5px">Lewati</a>
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
    $(document).ready(function(){
        $(".form-group").on("click", ".multiple-field-js", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multiple-field-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.children("input")
                .val("")
                .focus();
        });

        let clone = (function(){
            let cloneIndex = 0
            let template = $('#insiderTemplate').text()

            return function(){
                return template.replace(/@{{idInsider}}/g, ++cloneIndex);
            }
        })();

        let insider = $("#insider-copy")

        $(document).on("click", '.multiple-row-js', function(){
            insider.append(clone()); 
          });
          
        insider.append(clone())

        $("body").on("click", ".removeEmail, .removeTelepon", function () {
            // var id = $(this).attr('id').split('-')[1];
            $(this).parent().parent().remove();

        });

        

        $("form").on("change", '.fotoProfile', function (e) {
            e.preventDefault();
            var imgPath = $(this)[0].value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });

        /*$(".form-group").on("click", ".multiple-row-js", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multiple-row-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.find("input").first()
                .val("")
                .focus();
        });*/
    
        $(".form-group").on("focus", ".focus-long-field, .focus-long-field-right-to-left", function(){
            let el = $(this);
            el.css('width', el.data('focus-width'));
            if (el.attr('data-focus-height')) {
                el.css('height', el.data('focus-height'));
            }
        });

        $(".form-group").on("blur", ".focus-long-field, .focus-long-field-right-to-left", function(){
            let el = $(this);
            // reset css after focus
            el.removeAttr('style');
        });

        $("form").on("click", ".custom-file-button", function(){
            console.log('test');
            let el = $(this);
            let fileElClassName = el.data('file-element');
            $(this).closest(".form-group").find(fileElClassName).trigger("click");
        });
    })
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $(input).closest("div.form-group").find('div.preview-foto').html('<img class="photo-preview avatar" src="'+e.target.result+'" height="50" width="50"> ');
        }
    }
}
</script>
@endsection