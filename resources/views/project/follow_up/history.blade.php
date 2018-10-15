@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

@section('css')
<style>
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.icon-box {
    width: 2.5rem;
    height: 1.5rem;
    display: inline-block;
    background: no-repeat center/100% 100%;
    vertical-align: bottom;
    font-style: normal;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 2px;
}

.note {
    position: relative;
    height: 37px;
}
.note > textarea {
    height: 37px;
    border: 1px solid #ddd;
background: #f8f8f8;
    resize: none;
color: #555;
}
.note > textarea:hover {
    position: absolute;
    z-index: 2;
    top: 0;
    left: 0;
    width: 250px;
    height: 100px;
    border: 1px solid #ccc;
    box-shadow: 0 0 8px #dcdcdc;
    background: #f8f8f8;
}
</style>
@endsection


@section('content')
<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Riwayat Follow Up
        </h1>
    </div>

    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="form-group">
                <div class="input-icon mb-3">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
            <tr>
                <th>Tanggal Input</th>
                <th class="text-center">Status Follow Up</th>
                <th>Catatan Follow Up</th>
                <th class="text-center">Status Deal</th>
                <th>Catatan Deal</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($potential_project->follow_up_histories as $follow_up_history)
            <tr>
                <td>{{ $follow_up_history->created_at }}</td>
                <td class="text-center">{{ $follow_up_history->status_text }}</td>
                <td>
                    @if ($follow_up_history->note)
                    <div class="note">
                        <textarea readonly="">{{ $follow_up_history->note }}</textarea>
                    </div>
                    @endif
                </td>
                <td class="text-center">{{ optional($follow_up_history->deal_history)->status_text }}</td>
                <td>
                    @if (optional($follow_up_history->deal_history)->note)
                    <div class="note">
                        <textarea readonly="">{{ optional($follow_up_history->deal_history)->note }}</textarea>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

</div>
@endsection
