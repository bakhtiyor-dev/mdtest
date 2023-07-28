<?php

namespace App\Models;

use App\Exports\SingleChoiceTestsExport;
use App\Imports\SingleChoiceTestsImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswersTypeSingleChoice extends AbstractAnswers
{
    use HasFactory;

    protected $table = 'answers_type_single_choice';

    protected $casts = [
        'answers' => 'object'
    ];

    public static function check($test)
    {
        $test->is_correct = self::find($test->answers->id)->correct_answer_id == $test->selected_id;
        return $test;
    }

    public function hideCorrectAnswer()
    {
        $this->makeHidden('correct_answer_id');
    }

    public static function getImportable()
    {
        return new SingleChoiceTestsImport();
    }

    public static function getExportable()
    {
        return new SingleChoiceTestsExport();
    }
}
