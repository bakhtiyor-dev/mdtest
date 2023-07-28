
<div class="row">
    <div class="col-sm-8">
        <div class="card border">
            <div class="bg-gray p-2 text-bold-700 d-flex justify-content-between">
                <div class="d-flex mr-1">
                    <p style="margin-right: 5px;">{{$loop->iteration}}.</p>
                    <p>{!! $test->body !!}</p>
                </div>

                <div>
                    @isset($test->is_answered)
                        @if($test->is_correct)
                            <i class="fa fa-check-circle text-success font-large-1"></i>
                        @else
                            <i class="fa fa-times-circle text-danger font-large-1"></i>
                        @endif
                    @endisset
                </div>
            </div>

            <div class="card-body">
                @if($test->answers_type === \App\Enums\AnswerType::TEXT_INPUT)
                    @include('shared-partials.text-input-card')
                @else

                    @foreach($test->answers->answers as $answer)

                        @switch($test->answers_type)
                            @case(\App\Enums\AnswerType::SINGLE_CHOICE)
                            @include('shared-partials.single-choice-card')
                            @break

                            @case(\App\Enums\AnswerType::MULTIPLE_CHOICE)
                            @include('shared-partials.multiple-choice-card')
                            @break

                            @case(\App\Enums\AnswerType::RIGHT_ORDER)
                            @include('shared-partials.right-order-card')
                            @break

                        @endswitch

                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @isset($test->explanation)
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body border">
                    <p class="text-info text-bold-600"><i class="fa fa-info-circle"></i> Пояснение</p>
                    {!! $test->explanation !!}
                </div>
            </div>
        </div>
    @endisset
</div>