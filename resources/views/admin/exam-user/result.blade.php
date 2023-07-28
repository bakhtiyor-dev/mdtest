@extends('brackets/admin-ui::admin.layout.default')

@section('title', "Результат")

@section('body')
<div class="container-fluid">
    <a href="{{url()->previous()}}" class="btn btn-primary mb-2">
        <i class="icon icon-arrow-left-circle"></i>
        Назад
    </a>

    <button class="btn btn-primary float-right" onclick="printable('print-area')">
        <i class="fa fa-print"></i>
    </button>
    <div id="print-area">
        @include('shared-partials.result-card')
    </div>
</div>
@endsection