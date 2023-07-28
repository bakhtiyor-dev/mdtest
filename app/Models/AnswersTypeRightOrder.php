<?php

namespace App\Models;

use App\Exports\RightOrderTestsExport;
use App\Imports\RightOrderTestsImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswersTypeRightOrder extends AbstractAnswers
{
    use HasFactory;

    protected $table = 'answers_type_right_order';

    protected $casts = [
        'answers' => 'object',
        'correct_order' => 'array'
    ];

    public static function check($test)
    {
        $test->is_correct = self::find($test->answers->id)->correct_order == $test->selected_order;
        return $test;
    }

    public function hideCorrectAnswer()
    {
        $this->makeHidden('correct_order');
    }

    public static function getImportable()
    {
        return new RightOrderTestsImport();
    }

    public static function getExportable()
    {
        return new RightOrderTestsExport();
    }

}
