<?php

namespace App\Imports;

use App\Models\AnswersTypeMultipleChoice;
use App\Models\Test;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class MultipleChoiceTestsImport extends TestsImportable implements OnEachRow
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

        //shuffling and serializing answers to proper format to store in database
        $answers = $this->shuffleAndSerializeAnswers($row);

        //collecting correct answer ids according '#' sign in answers
        $correct_answer_ids = $answers->filter(fn($answer) => Str::startsWith($answer['answer'], '#'))->pluck('id');

        //removing '#' sign from answers
        $answers = $answers->map(fn($answer, $id) => Str::remove('#', $answer));

        //creating new answers record in answers_type_multiple_choice table and passing id to associate with tests table
        $answers_id = AnswersTypeMultipleChoice::create([
            'answers' => $answers,
            'correct_answer_ids' => $correct_answer_ids
        ])->id;

        //creating new test record in tests table
        Test::create([
            'body' => $question,
            'answers_type' => 'App\Models\AnswersTypeMultipleChoice',
            'answers_id' => $answers_id,
            'category_id' => $this->category_id,
        ]);

    }
}