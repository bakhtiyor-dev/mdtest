<?php

namespace App\Imports;

use App\Models\AnswersTypeSingleChoice;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class SingleChoiceTestsImport extends TestsImportable implements OnEachRow
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
        $question = trim($row->shift());;

        //skipping if tests table contains current question
        if (Test::where('body', $question)->exists())
            return null;

        //shuffling and serializing answers to proper format to store in database
        $answers = $this->shuffleAndSerializeAnswers($row);

        //finding and assigning correct answers id
        $correct_answer_id = $answers->firstWhere('answer', $row->first())['id'];

        //creating new answers record in answers_type_single_choice table and passing id to associate with tests table
        $answers_id = AnswersTypeSingleChoice::create([
            'answers' => $answers,
            'correct_answer_id' => $correct_answer_id
        ])->id;

        //creating new test record in tests table
        Test::create([
            'body' => $question,
            'answers_type' => 'App\Models\AnswersTypeSingleChoice',
            'answers_id' => $answers_id,
            'category_id' => $this->category_id,
        ]);

    }
}