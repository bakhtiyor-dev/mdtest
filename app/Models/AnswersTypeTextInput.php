<?php

namespace App\Models;

use App\Exports\TextInputTestsExport;
use App\Imports\TextInputTestsImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AnswersTypeTextInput extends AbstractAnswers
{
    use HasFactory;

    protected $table = 'answers_type_text_input';

    public static function check($test)
    {
        $test->is_correct = !strcmp(
            Str::lower(trim($test->given_answer)),
            Str::lower(self::find($test->answers->id)->correct_answer)
        );

        return $test;
    }

    public function hideCorrectAnswer()
    {
        $this->makeHidden('correct_answer');
    }

    public function shuffleAnswers()
    {
        //disabling shuffling for this type of answers
    }

    public static function getImportable()
    {
        return new TextInputTestsImport();
    }

    public static function getExportable()
    {
        return new TextInputTestsExport();
    }


}
