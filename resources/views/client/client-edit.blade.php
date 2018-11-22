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

        <form method="post" action="{{ route('update-project', ['id' => $project->id]) }}">
        @csrf
        </form>
</div>
@endsection
@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);
</script>
@endsection