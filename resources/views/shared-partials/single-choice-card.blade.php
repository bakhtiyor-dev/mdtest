<div class="d-flex justify-content-between pl-2">
    <div class="d-flex">
        <input type="radio" class="form-check-input" disabled
               @isset($test->is_answered)
                    @if($answer->id === $test->selected_id)
                        checked
                    @endif
                @endisset>
        {!! $answer->answer !!}
    </div>
    <div>
        @isset($test->is_answered)
            @if($answer->id === $test->selected_id)
                @if($test->is_correct)
                    <i class="fa fa-check-circle text-success"></i>
                @else
                    <i class="fa fa-times-circle text-danger"></i>
                @endif
            @endif
        @endisset

    </div>
</div>

<hr>