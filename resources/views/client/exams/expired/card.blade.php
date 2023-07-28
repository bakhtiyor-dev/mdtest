<div class="card">
    <div class="card-header d-block">
        <h4>Экзамен:</h4>
        <strong> {{ $exam->title }}</strong>
        <hr>
    </div>

    <div class="p-1 pb-0">

        <p class="text-bold-600">
            <i class="fas fa-building"></i>
            Подразделение: {{$exam->organisation->title}}
        </p>

        <p class="text-bold-600">
            <i class="fas fa-cubes"></i>
            Отдел: {{$exam->department->title}}
        </p>

        <p class="text-bold-600">
            <i class="fas fa-calculator"></i>
            Кол-во вопросов: {{$exam->tests_count}}
        </p>

        <p class="text-bold-600">
            <i class="fas fa-stopwatch"></i>
            Время: {{$exam->time}} минут
        </p>

        <p class="text-danger">
            <i class="fas fa-calendar-times"></i>
            Закрыто в:
            <strong> {{$exam->end_date}}</strong>
        </p>

    </div>

    <div class="card-footer">
        <a class="btn btn-outline-primary float-right"  href="{{route('exam.attempts',$exam->id)}}">
            <i class="fas fa-eye"></i>
            Посмотреть
        </a>
    </div>

</div>