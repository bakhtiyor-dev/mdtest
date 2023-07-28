<?php

namespace App\Imports;

use App\Models\AnswersTypeRightOrder;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class RightOrderTestsImport extends TestsImportable implements OnEachRow
{
    /**
     * @param Row $row
     * @return void|null
     */
    public function onRow(Row $row)
    {
        //Skip heading
        if ($row->getIndex() == 1)
            return null;

        //Serialize data to collection and remove null
        $row = $row->toCollection()->whereNotNull();

        //assigning first column to question and removing it
        $question = trim($row->shift());

        //skipping if tests table contains current question
        if (Test::where('body', $question)->exists())
            return null;

        $answers = $this->serializeAnswers($row);

        $correct_order = $answers->pluck('id');

        //creating new answers record in answers_type_right_order table and passing id to associate with tests table
        $answers_id = AnswersTypeRightOrder::create([
            'answers' => $answers,
            'correct_order' => $correct_order
        ])->id;

        //creating new test record in tests table
        Test::create([
            'body' => $question,
            'answers_type' => 'App\Models\AnswersTypeRightOrder',
            'answers_id' => $answers_id,
            'category_id' => $this->category_id,
        ]);

    }
}