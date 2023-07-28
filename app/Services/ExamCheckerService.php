<?php

namespace App\Services;

use App\Models\Test;

class ExamCheckerService
{
    public static function check(array $tests, bool $explanation_enabled)
    {
        $checked_tests = [];

        foreach ($tests as $test) {
            if (isset($test->is_answered)) {
                $checked_test = $test->answers_type::check($test);

                if ($explanation_enabled and !$checked_test->is_correct)
                    $checked_test->explanation = Test::find($checked_test->id)->explanation;

                $checked_tests[] = $checked_test;
            } else {
                $checked_tests[] = $test;
            }
        }

        return $checked_tests;
    }
}