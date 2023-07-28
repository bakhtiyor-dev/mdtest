<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamUser;
use App\Models\ExamUserAttempt;
use App\Services\ExamCheckerService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AttemptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Exam $exam)
    {
        $this->authorize('retrieve', $exam);

        return view('client.attempts.index', [
            'attempts' => $exam->attempts(auth()->user()),
            'exam' => $exam
        ]);
    }

    public function show(ExamUserAttempt $attempt)
    {
        $this->authorize('show', $attempt);

        return view('client.attempts.result', ['attempt' => $attempt]);
    }

    public function start(Exam $exam, $attemptNumber)
    {
        $this->authorize('retrieve', $exam);
        $this->authorize('take', $exam);

        if (!$exam->availableAttempts(auth()->user())->has($attemptNumber))
            abort(403);

        $exam_user = ExamUser::where([
            'user_id' => auth()->id(),
            'exam_id' => $exam->id
        ])->first();

        $attempt = ExamUserAttempt::create([
            'exam_user_id' => $exam_user->id,
            'user' => Arr::except(auth()->user()->toArray(), 'exams'),
            'exam' => $exam->load(['department', 'organisation', 'ratingSettings'])->toArray(),
            'tests' => $exam->tests->toArray(),
            'attempt_number' => $attemptNumber,
            'result' => 0,
            'started_at' => now()
        ]);

        return view('client.attempts.start', [
            'exam' => $exam,
            'attempt' => $attempt
        ]);
    }

    public function finish(Exam $exam, ExamUserAttempt $attempt, Request $request)
    {
        $request->validate(['tests' => 'required']);

        $this->authorize('retrieve', $exam);
        $this->authorize('finish', $exam);

        $attempt->update(['finished_at' => now()]);

        $checkedTests = ExamCheckerService::check(
            json_decode($request->get('tests')),
            $exam->enable_explanation
        );

        $attempt->tests = $checkedTests;
        $attempt->result = round($attempt->correct_answers_count / count($checkedTests) * 100);
        $attempt->save();

        return view('client.attempts.result', [
            'attempt' => $attempt,
            'exam' => $exam
        ]);
    }
}