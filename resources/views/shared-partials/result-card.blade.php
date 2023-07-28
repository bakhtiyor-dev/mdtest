<div class="card">
    <div class="card-body">
        <div class="clearfix">

            <div class="float-left">
                <h4>Пользователь: {{$attempt->user->fullname}}</h4>
                <h4>
                    Экзамен: {{$attempt->exam->title}}
                </h4>

                <hr>

                <h5>
                    <span class="text-bold-600">
                    Результат:
                    </span>
                    <span style="color: {{$attempt->rating->color}};">{{$attempt->result}}% - {{$attempt->rating->comment}}</span>
                </h5>

                <h5>
                    <span class="text-bold-600">
                    Попытка №
                    </span>
                    {{$attempt->attempt_number}}
                </h5>
                <hr>
                <h5>Данные пользователя:</h5>

                <p>
                    <span class="text-bold-600">
                    E-mail:
                    </span>
                    {{$attempt->user->email}}
                </p>

                <p>
                    <span class="text-bold-600">
                    Должность:
                    </span>
                    {{$attempt->user->position}}
                </p>

                <p>
                    <span class="text-bold-600">
                    Отдел:
                    </span>
                        {{$attempt->user->department}}
                </p>

                <p class="mb-0">
                    <span class="text-bold-600">
                    Подразделение:
                    </span>
                    {{$attempt->user->organisation}}
                </p>

            </div>

            <div class="float-right">
                <img src="{{asset('images/kapitalbank-logo.png')}}" class="img-fluid" style="height: 30px" alt="image">
            </div>
        </div>

        <hr>

        <p class="text-bold-600">
            <i class="fa fa-calculator"></i>
            Общее кол-во вопросов: {{count($attempt->tests)}}
        </p>

        <p class="text-bold-600">
            <i class="fa fa-calendar-check-o"></i>
            Время начала: {{$attempt->started_at}}
        </p>

        <p class="text-bold-600">
            <i class="fa fa-calendar-minus-o"></i>
            Время окончания: {{$attempt->finished_at}}
        </p>

        <p class="text-bold-600">
            <i class="fa fa-clock-o"></i>
            Потраченное время: {{$attempt->spent_time}} минут
        </p>

        <p class="text-success text-bold-600">
            <i class="fa fa-check-circle"></i>
            Кол-во правильных ответов:
            {{$attempt->correct_answers_count}}</p>

        <p class="text-danger text-bold-600">
            <i class="fa fa-times-circle"></i>
            Кол-во неправильных ответов:
            {{$attempt->wrong_answers_count}}</p>

        <p class="text-warning text-bold-600">
            <i class="fa fa-minus-circle"></i>
            Кол-во неотвеченных вопросов:
            {{$attempt->unanswered_tests_count}}</p>
        <hr>

        @foreach($attempt->tests as $test)
            @include('shared-partials.test')
        @endforeach
    </div>
</div>