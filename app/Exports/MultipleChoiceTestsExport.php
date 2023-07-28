<?php

namespace App\Exports;

use App\Enums\AnswerType;
use Illuminate\Support\Str;

class MultipleChoiceTestsExport extends TestsExport
{
    public function headings(): array
    {
        return [
            'ID',
            'Категория',
            'Тип',
            'Вопрос',
            'Варианты... (варианты со знаком "#" в начале являются правильными)'
        ];
    }

    public function map($test): array
    {
        $answersInstance = $test->answers;

        $answers = collect($answersInstance->answers)
            ->mapWithKeys(fn($item) => [$item->id => strip_tags($item->answer)]);

        collect($answersInstance->correct_answer_ids)->each(function ($id) use ($answers) {
            $answers[$id] = Str::start($answers[$id], '#');
        });

        return array_merge([
            $test->id,
            $test->category->title,
            AnswerType::TYPES[$test->answers_type],
            strip_tags($test->body),
        ],
            $answers->toArray()
        );
    }
}
