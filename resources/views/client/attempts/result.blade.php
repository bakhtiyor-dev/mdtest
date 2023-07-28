@extends('client/layouts/contentLayoutMaster')

@section('title', 'Результат')

@section('content')

    <a href="{{isset($exam) ? route('exam.attempts',$exam) : url()->previous()}}"
       class="btn btn-primary mb-2">
        <i class="fas fa-arrow-left"></i>
        Назад
    </a>

    <button class="btn btn-outline-secondary float-right" onclick="printable('print-area')">
        <i class="fas fa-print"></i>
    </button>

    <div id="print-area">
        @include('shared-partials.result-card')
    </div>

    <a class="btn btn-primary float-right" href="/">
        <i class="fas fa-home"></i>
        Вернуться к главной
    </a>

@endsection

