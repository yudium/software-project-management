@extends('template.master')
@section('css')
<style>
        .btn-as-text {
            color: #495057;
            border: none;
            box-shadow: none;
            background: transparent;
            cursor: pointer;
        }
        
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        
        .multi-input-control {
            background: #f8f8f8;
            border: none;
        }
        .multi-input-copy-target .fe {
            color: #a19090
        }
        </style>
@endsection
@section('content')
<div class="container">
        @include('pagetitle', ['title' => 'Form Ubah Client'])

        <form method="post" action="{{ route('clientUpdate', ['id' => $client->id]) }}">
        @csrf
        <div class="row row-cards">
                <div class="col-4">
                    <div class="row row-cards">
                        <div class="col-12">
                                <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Nama Client</h3>
                                        </div>
                                <div class="card-body d-flex flex-column">
                                        <div class="d-flex align-items-center pt-2 mt-auto">
                                            <div class="avatar avatar-md mr-3" style="background-image: url(/storage/clientImage/{{$client->photo}})"></div>
                                            <div>
                                            <input type="text" name="name" value="{{$client->name}}" class="form-control">
                                                <div class="d-block text-muted">
                                                    <span class="badge badge-success">{{ ucfirst($client->type->name) }}</span>
                                                    <span class="badge badge-info">{{ ucfirst($client->status_text) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <input name="client_id" type="hidden" value="{{ $client->id }}">
                        </div>
                        <div class="col-12">
                                <div class="card">
                                        <div class="card-body">
                                <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" name="alamat" type="text"> {{$client->address->address}}</textarea>
                                        @if ($errors->has('alamat'))
                                        @foreach ($errors->get('alamat') as $message)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @endforeach
                                    @endif
                                    </div>  

                                    <div class="form-group">
                                            <label class="form-label">Status hubungan bisnis</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input name="statusHub" value="Dekat" class="selectgroup-input"  type="radio"
                                                        name="statusHub" {{$client->business_relationship_status=='Dekat'?'selected':''}}>
                                                    <span class="selectgroup-button">Dekat</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input name="statusHub" value="Normal" class="selectgroup-input" type="radio" name="statusHub" {{$client->business_relationship_status=='Normal'?'selected':''}}>
                                                    <span class="selectgroup-button">Normal</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input name="statusHub" value="Buruk" class="selectgroup-input" type="radio" name="statusHub">
                                                    <span class="selectgroup-button" {{$client->business_relationship_status=='Buruk'?'selected':''}}>Buruk</span>
                                                </label>
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
                <div class="col-4">
                        @component('card', ['title' => 'Nomor Telepon'])
        
                        @if (count($errors->get('telepon.*')))
                            @component('includes.alert-danger')
                                @foreach ($errors->get('telepon.*') as $messages)
                                    @foreach ($messages as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                @endforeach
                            @endcomponent
                        @endif

                        <datalist id="telepon">
                        @foreach ($client->phone as $phone)
                            <option> {{$phone->phone}}</option>
                            @endforeach
                        </datalist>
                        @component('includes.form-element.multiple-input-custom', [
                            'id' => 'multi-telepon',
                            'name' => 'telepon[]',
                            'number' => 1,
                        ])
                        @foreach ($client->phone as $phone)
                        <div class="input-group mb-2">
                                <input type="text" name="telepon[]" class="awesomplete form-control mb-2" list="telepon" autocomplete="off"  value="{{ $phone->phone }}">
                                <span class="input-group-append">
                                    <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                    <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                </span>
                            </div>
                            @endforeach
                           @endcomponent
                        @endcomponent

                        @component('card', ['title' => 'Web Address'])
        
                        @if (count($errors->get('webAddress.*')))
                            @component('includes.alert-danger')
                                @foreach ($errors->get('webAddress.*') as $messages)
                                    @foreach ($messages as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                @endforeach
                            @endcomponent
                        @endif

                        <datalist id="webAddress">
                        @foreach ($client->webAddress as $webAddress)
                            <option> {{$webAddress->web_addresses}}</option>
                            @endforeach
                        </datalist>
                        @component('includes.form-element.multiple-input-custom', [
                            'id' => 'multi-webAddress',
                            'name' => 'webAddress[]',
                            'number' => 1,
                        ])
                        @foreach ($client->webAddress as $webAddress)
                        <div class="input-group mb-2">
                                <input type="text" name="webAddress[]" class="awesomplete form-control mb-2" list="webAddress" autocomplete="off"  value="{{ $webAddress->web_addresses }}">
                                <span class="input-group-append">
                                    <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                    <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                </span>
                            </div>
                            @endforeach
                           @endcomponent
                        @endcomponent

                     
                </div>
                <div class="col-4">
                        @component('card', ['title' => 'Email'])
        
                        @if (count($errors->get('email.*')))
                            @component('includes.alert-danger')
                                @foreach ($errors->get('email.*') as $messages)
                                    @foreach ($messages as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                @endforeach
                            @endcomponent
                        @endif

                        <datalist id="email">
                        @foreach ($client->email as $email)
                            <option> {{$email->email}}</option>
                            @endforeach
                        </datalist>
                        @component('includes.form-element.multiple-input-custom', [
                            'id' => 'multi-email',
                            'name' => 'email[]',
                            'number' => 1,
                        ])
                        @foreach ($client->email as $email)
                        <div class="input-group mb-2">
                                <input type="text" name="email[]" class="awesomplete form-control mb-2" list="email" autocomplete="off"  value="{{ $email->email }}">
                                <span class="input-group-append">
                                    <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                    <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                </span>
                            </div>
                            @endforeach
                           @endcomponent
                        @endcomponent

                        @component('card', ['title' => 'Bank Account'])
        
                        @if (count($errors->get('bankAccount.*')))
                            @component('includes.alert-danger')
                                @foreach ($errors->get('bankAccount.*') as $messages)
                                    @foreach ($messages as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                @endforeach
                            @endcomponent
                        @endif

                        <datalist id="bankAccount">
                        @foreach ($client->bankAccount as $bankAccount)
                            <option> {{$bankAccount->bank_account}}</option>
                            @endforeach
                        </datalist>
                        @component('includes.form-element.multiple-input-custom', [
                            'id' => 'multi-bankAccount',
                            'name' => 'bankAccount[]',
                            'number' => 1,
                        ])
                        @foreach ($client->bankAccount as $bankAccount)
                        <div class="input-group mb-2">
                                <input type="text" name="bankAccount[]" class="awesomplete form-control mb-2" list="bankAccount" autocomplete="off"  value="{{ $bankAccount->bank_account }}">
                                <span class="input-group-append">
                                    <!-- I don't know why the button X below has wrong size so I add height to style attribute -->
                                    <button style="height: 38px" type="button" class="btn btn-secondary"><i class="fe fe-x"></i></button>
                                </span>
                            </div>
                            @endforeach
                           @endcomponent
                        @endcomponent

                </div>
                {{-- <div class="col-4">
                       

                </div>
                <div class="col-4">
                        

                </div> --}}
        </div>
        </form>
</div>
@endsection
@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);
</script>
@endsection