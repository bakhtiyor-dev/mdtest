@extends('client.layouts.fullLayoutMaster')

@section('title', 'Распечатка')

@section('content')

    <div class="clearfix mb-2">
        <a href="{{url()->previous()}}" class="btn btn-primary float-left">
            <i class="fa fa-arrow-left"></i>
            Назад
        </a>
        <h4 class="float-left ml-4">Всего: {{$tests->count()}} тестов</h4>
        <button class="btn btn-primary float-right" onclick="printable('print-area')">
            <i class="fa fa-print"></i>
        </button>

    </div>

    <div id="print-area">
        <div class="clearfix">
            <img src="{{asset('images/kapitalbank-logo.png')}}" class="float-right" style="height: 30px">
        </div>
        @forelse($tests as $test)

            @php($test->shuffleAnswers())

            @include('shared-partials.test')

        @empty
            <h4 class="text-center text-muted">По вашим данным ничего не найдено!</h4>
        @endforelse

    </div>

@endsection
