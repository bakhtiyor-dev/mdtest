@extends('brackets/admin-ui::admin.layout.default')

@section('title', "Отчет")

@section('body')
    <div class="clearfix">
        <a href="{{url()->previous()}}" class="btn btn-primary mb-2 float-left">
            <i class="fa fa-arrow-circle-left"></i>
            Назад
        </a>
        <button class="btn btn-primary float-right" onclick="printable('print-area')">
            <i class="fa fa-print"></i>
        </button>

    </div>
    <div class="card" id="print-area">
        <div class="card-header clearfix">
            <h5 class="float-left">Отчёт к {{now()}}</h5>
            <img src="{{asset('images/kapitalbank-logo.png')}}" class="float-right" style="height: 25px;" alt="logo">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Экзамен</th>
                        <th>Время начала</th>
                        <th>Время окончания</th>
                        <th>Потраченное время(в минутах)</th>
                        <th>Номер попытки</th>
                        <th>Результат (%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $report)
                        <tr>
                            <td>{{$report->id}}</td>
                            <td>{{$report->user->fullname}}</td>
                            <td>{{$report->exam->title}}</td>
                            <td>{{$report->started_at}}</td>
                            <td>{{$report->finished_at}}</td>
                            <td>{{$report->spent_time}}</td>
                            <td>{{$report->attempt_number}}</td>
                            <td>{{$report->result}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
