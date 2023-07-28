<?php

namespace App\Exports;

use App\Enums\AnswerType;

class SingleChoiceTestsExport extends TestsExport
{
    public function headings(): array
    {
        return [
            'ID',
            'Категория',
            'Тип',
            'Вопрос',
            'Правильный вариант',
            'Другие варианты...'
        ];
    }

    public function map($test): array
    {
        $answersInstance = $test->answers;

        $answers = collect($answersInstance->answers);

        $correct_answer = $answers->where('id', $answersInstance->correct_answer_id)
            ->pluck('answer')
            ->first();

        $answers = $answers->filter(fn($item) => $item->id !== $answersInstance->correct_answer_id)
            ->pluck('answer')
            ->prepend($correct_answer)
            ->map(fn($item) => strip_tags($item))
            ->toArray();

        return array_merge([
            $test->id,
            $test->category->title,
            AnswerType::TYPES[$test->answers_type],
            strip_tags($test->body),
        ],
            $answers
        );
    }
}
