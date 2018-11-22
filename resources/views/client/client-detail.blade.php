@extends('template.master')
@section('title', 'Detail Proyek')

@section('css')
<style>
// TODO: move clearfix css to global css
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

ol.link-list {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
ol.link-list:hover {
    overflow: visible;
    position: relative;
    z-index: 9;
    background-color: white;
}
ol.link-list span.anticipate-long-text {
    background-color: white;
}
</style>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Detail Client
            </h1>
        </div>

        <div class="row row-cards">
            <div class="col-4">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card card-client">
                            <div class="card-header">
                                <h3 class="card-title">Data Client</h3>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center pt-2 mt-auto">
                                    <div class="avatar avatar-md mr-3" style="background-image: url(/storage/clientImage/{{$client->photo}})"></div>
                                    <div>
                                        <a href="javascript:void(0)" class="text-default">{{ $client->name }}</a>
                                    <small class="d-block text-muted"></small>
                                 
                                    </div>
                                    <div class="ml-auto">
                                        <!-- TODO: link to client's detail page -->
                                        <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
                                    </div>
                                </div>
                                <div class="info mt-3">
                                    <div class="clearfix">
                                        <div class="left"></div>
                                        <div class="right">
                                            <span class="badge badge-success">{{ ucfirst($client->type->name) }}</span>
                                            <span class="badge badge-info">{{ ($client->status==0)?'Client':'Prospect' }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
     
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Detail Client</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                                <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="alamat">Alamat</label>
                                            <div class="form-control-plaintext">
                                                    @if($client->address)
                                                    {{$client->address->address}}
                                                    @else
                                                    <small class="text-muted">Belum diatur</small>
                                                @endif
                                            </div>
                                       
                                        </div>
                                    </div>        
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="telepon">Nomor Telepon</label>
                                    <div class="form-control-plaintext">
                                            @if($client->phone)
                                            @foreach ($client->phone as $phone)
                                            {{$phone->phone}}
                                            <br>
                                            @endforeach
                                            @else
                                            <small class="text-muted">Belum diatur</small>
                                        @endif
                                    </div>                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-6">
                                        <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="form-control-plaintext">
                                                        @if($client->email)
                                                        @foreach ($client->email as $email)
                                                        {{$email->email}}
                                                        <br>
                                                        @endforeach
                                                        @else
                                                        <small class="text-muted">Belum diatur</small>
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                                <label class="form-label" for="webAddress">Web Address</label>
                                                <div class="form-control-plaintext">
                                                        @if($client->webAddress)
                                                        @foreach ($client->webAddress as $webAddress)
                                                        {{$webAddress->web_addresses}}
                                                        <br>
                                                        @endforeach
                                                        @else
                                                        <small class="text-muted">Belum diatur</small>
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-6">
                                        <div class="form-group">
                                                <label class="form-label" for="bankAccount">Akun Bank</label>
                                                <div class="form-control-plaintext">
                                                        @if($client->bankAccount)
                                                        @foreach ($client->bankAccount as $bankAccount)
                                                        {{$bankAccount->bank_account}}
                                                        <br>
                                                        @endforeach
                                                        @else
                                                        <small class="text-muted">Belum diatur</small>
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="status">Status Hubungan Bisnis</label>
                                            <div class="form-control-plaintext">
                                                    @if($client->business_relationship_status)
                                                    <div class="status-animated">{{$client->business_relationship_status}}</div>
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
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Aksi</h4>
                            </div>
                            <div class="card-body">
                                    <a href="{{ route('clientEdit', ['client_id' => $client->id]) }}" class="btn btn-secondary btn-block btn-sm">Ubah Data Client</a>
                                    <a href="{{ route('clientList') }}" class="btn btn-secondary btn-block btn-sm">Daftar Client</a>
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    $(document).ready(function(){
        $(".form-group").on("click", ".multiple-field-js", function(){
            let el = $(this);
            let clonedTarget = el.parent().children(".multiple-field-copy-target").first().clone();
            let insertedEl = clonedTarget.insertBefore(el);
            insertedEl.children("input")
                .val("")
                .focus();
        });
    });
</script>
@endsection
