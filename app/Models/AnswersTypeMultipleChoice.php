<?php

namespace App\Models;

use App\Exports\MultipleChoiceTestsExport;
use App\Imports\MultipleChoiceTestsImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswersTypeMultipleChoice extends AbstractAnswers
{
    use HasFactory;

    protected $table = 'answers_type_multiple_choice';

    protected $casts = [
        'answers' => 'object',
        'correct_answer_ids' => 'array'
    ];

    public static function check($test)
    {
        $correct_answer_ids = self::find($test->answers->id)->correct_answer_ids;
        $selected_ids = $test->selected_ids;

        sort($correct_answer_ids);
        sort($selected_ids);

        $test->is_correct = ($correct_answer_ids == $selected_ids);

        return $test;
    }

    public function hideCorrectAnswer()
    {
        $this->makeHidden('correct_answer_ids');
    }

    public static function getImportable()
    {
        return new MultipleChoiceTestsImport();
    }

    public static function getExportable()
    {
        return new MultipleChoiceTestsExport();
    }
}
