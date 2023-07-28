<?php

namespace App\Exports;

use App\Enums\AnswerType;

class TextInputTestsExport extends TestsExport
{
    public function headings(): array
    {
        return [
            'ID',
            'Категория',
            'Тип',
            'Вопрос',
            'Ответ'
        ];
    }

    public function map($test): array
    {
        return [
            $test->id,
            $test->category->title,
            AnswerType::TYPES[$test->answers_type],
            strip_tags($test->body),
            $test->answers->correct_answer
        ];
    }
}
