@extends('client/layouts/contentLayoutMaster')

@section('title', 'Попытки')

@section('content')

    <div>
        <a href="{{$exam->isExpired() ? route('exams.expired') : route('exams.available')}}"
           class="btn btn-primary mb-2">
            <i class="fas fa-arrow-left"></i>
            Назад
        </a>

        <div class="card col-lg-8">

            <div class="p-1 border-bottom">
                <strong>Название экзамена:</strong>
                {{ $exam->title }}
            </div>

            <div class="card-body">
                <p>
                    <i class="fas fa-building"></i>
                    Подразделение: {{$exam->organisation->title}}
                </p>

                <p>
                    <i class="fas fa-cubes"></i>
                    Отдел: {{$exam->department->title}}
                </p>

                <p>
                    <i class="fas fa-calendar"></i>
                    Дата начала: {{$exam->start_date}}
                </p>

                <p>
                    <i class="fas fa-calendar-times"></i>
                    Дата закрытия: {{$exam->end_date}}
                </p>

                <p>
                    <i class="fas fa-stopwatch"></i>
                    Время: {{$exam->time}} минут
                </p>

                <p>
                    <i class="fas fa-calculator"></i>
                    Кол-во вопросов: {{$exam->tests_count}}
                </p>

                <p>
                    <i class="fas fa-undo"></i>
                    Осталось попыток: {{$exam->availableAttemptsCount(auth()->user())}}
                </p>

            </div>
        </div>

        <div class="card col-lg-8">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                <h5>№ Номер попытки:</h5>
                            </th>
                            <th>
                                <h5>Результат:</h5>
                            </th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($attempts->isNotEmpty())
                            @foreach($attempts as $attemptNumber => $attempt)
                                <tr>
                                    <td>Попытка {{$attemptNumber}}</td>
                                    @isset($attempt)
                                        @can('show',$attempt)
                                            <td>{{$attempt->result}}%</td>
                                            <td>
                                                <a href="{{route('attempt.show',$attempt)}}"
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa fa-eye"></i> Посмотреть
                                                </a>
                                            </td>
                                        @endcan
                                    @else
                                        <td>-</td>

                                        <td>
                                            @can('take',$exam)
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                        data-target="#modal{{$attemptNumber}}">
                                                    <i class="fas fa-stopwatch"></i>
                                                    Начать
                                                </button>

                                                <div class="modal fade" id="modal{{$attemptNumber}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <h1 class="text-danger">
                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                    Внимание!
                                                                </h1>
                                                                <h4> После начала начнется подсчет времени.</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{route('exam.start',[$exam,$attemptNumber])}}"
                                                                   class="btn btn-primary float-right"><i
                                                                            class="fas fa-stopwatch"></i>
                                                                    Начать
                                                                </a>
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                        data-dismiss="modal">Отмена
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </td>

                                    @endisset
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

{{--@section('scripts')--}}
{{--    <script>--}}
{{--        function start(attemptNumber) {--}}
{{--            window.open("/exams/{{$exam->id}}/${attemptNumber}/start", "_blank", "type=fullWindow,fullscreen,scrollbars=yes,toolbar=no,resizable=no,top=0,left=0,width=5000,height=4000,fullscreen=yes");--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}