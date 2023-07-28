@extends('client/layouts/fullLayoutMaster')

@section('title', 'Тестирование')

@section('content')
    <div class="container" style="max-width: 1500px">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            Внимание перезагрузка или закрытие данной страницы приведёт к завершению попытки!</p>
                        <hr>
                        <p class="text-bold-600">
                            <i class="fas fa-ab"></i> Экзамен: {{$exam->title}}
                        </p>

                        <p class="text-bold-600">
                            <i class="fas fa-ab"></i> Общее количество вопросов: {{$exam->tests_count}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="app">
            <div v-cloak>

                <tests :_tests="{{$exam->tests->toJson()}}"
                       :seconds="{{$exam->time}} * 60"
                       :exam="{{$exam->toJson()}}"
                       url="{{route('exam.finish',[$exam,$attempt])}}">

                    <template v-slot:default="slotProps">
                        <form action="{{route('exam.finish',[$exam,$attempt])}}" id="form" method="POST">
                            @csrf
                            <input type="hidden" name="tests" :value="JSON.stringify(slotProps.tests)">
                        </form>
                    </template>

                </tests>
            </div>
        </div>
    </div>
@endsection