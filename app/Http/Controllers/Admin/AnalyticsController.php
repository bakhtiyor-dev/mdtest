<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamUserAttempt;
use App\Models\Test;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $data['departments_count'] = Department::count('id');
        $data['users_count'] = User::count('id');
        $data['exams_count'] = Exam::count('id');
        $data['tests_count'] = Test::count('id');
        $data['finished_attempts_count'] = ExamUserAttempt::finished()->filter($request->all())->count('id');

        $grading = [
            [0, 59],
            [60, 69],
            [70, 89],
            [90, 100]
        ];

        $data['grouped_attempts'] = [];

        foreach ($grading as $grade) {
            $data['grouped_attempts'][0][] = implode('-', $grade) . '%';
            $data['grouped_attempts'][1][] = ExamUserAttempt::finished()
                ->filter($request->all())
                ->whereBetween('result', $grade)
                ->count('id');
        }

        $data['grouped_tests'] = Test::filter($request->only('category'))
            ->selectRaw('count(id) as amount, answers_type')
            ->groupBy('answers_type')
            ->get()
            ->toArray();

        if (request()->ajax())
            return [
                'data' => $data
            ];

        return view('admin.analytics.index', [
            'data' => $data,
            'exams' => DB::table('exams')->get(['id', 'title']),
            'testCategories' => DB::table('test_categories')->get(['id', 'title'])
        ]);
    }
}