<?php

namespace App\Exports;

use App\Enums\AnswerType;

class RightOrderTestsExport extends TestsExport
{
    public function headings(): array
    {
        return [
            'ID',
            'Категория',
            'Тип',
            'Вопрос',
            'Варианты... (варианты расположены в правильном порядке)'
        ];
    }

    public function map($test): array
    {
        $answersInstance = $test->answers;

        $answers = collect($answersInstance->answers)
            ->mapWithKeys(fn($item) => [$item->id => strip_tags($item->answer)]);

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
