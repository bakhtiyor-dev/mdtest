@extends('brackets/admin-ui::admin.layout.default')

@section('title', "Результаты")

@section('body')
    <div class="container-fluid">
        <a href="{{route('admin/exam-users/index',$exam)}}"
           class="btn btn-primary mb-2">
            <i class="icon icon-arrow-left-circle"></i>
            Назад
        </a>
        <div class="card col-8">
            <div class="card-header">
                <h4>Данные пользователя:</h4>
            </div>
            <div class="card-body">
                <p><strong> Учетное имя:</strong> {{$user->fullname}}</p>
                <p><strong> E-mail:</strong> {{$user->email}}</p>
                <p><strong> Должность:</strong> {{$user->position}}</p>
                <p><strong> Отдел:</strong> {{$user->department}}</p>
                <p><strong> Подразделение:</strong> {{$user->organisation}}</p>
            </div>
        </div>
        <div class="card col-8">
            <div class="card-header">
                <h4> Данные экзамена: </h4>
            </div>

            <div class="card-body">
                <strong class="text-monospace">ID экзамена: {{$exam->id}}</strong>
                <hr>
                <strong>Название экзамена:</strong>
                {{ $exam->title }}

                <hr>

                <p>
                    <i class="icon icon-calendar"></i>
                    Дата начала: {{$exam->start_date}}
                </p>

                <p>
                    <i class="icon icon-calendar"></i>
                    Дата закрытия: {{$exam->end_date}}
                </p>

                <p>
                    <i class="icon icon-clock"></i>
                    Время: {{$exam->time}} минут
                </p>

                <p>
                    <i class="icon icon-calculator"></i>
                    Кол-во вопросов: {{$exam->tests_count}}
                </p>

                <p>
                    <i class="fa fa-undo"></i>
                    Осталось попыток: {{$exam->availableAttemptsCount($user)}}
                </p>

            </div>
        </div>

        <div class="card col-8">
            <div class="card-header">
                <h4>Попытки пользователя:</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                <h6>№ Номер попытки</h6>
                            </th>
                            <th>
                                <h6>Результат</h6>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($attempts->isNotEmpty())
                            @foreach($attempts as $attemptNumber => $attempt)
                                @if($attempt)
                                    <tr>
                                        <td>Попытка {{$attemptNumber}}</td>
                                        <td>{{$attempt->result}}%</td>
                                        <td>
                                            <a href="{{route('admin/exam-users/attempt',$attempt)}}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                                Посмотреть
                                            </a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Попытка {{$attemptNumber}}</td>
                                        <td>-</td>
                                        <td class="text-muted">Попытка не пройдена</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection