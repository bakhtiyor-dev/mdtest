<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamUserAttempt\BulkDestroyExamUserAttempt;
use App\Http\Requests\Admin\ExamUserAttempt\DestroyExamUserAttempt;
use App\Http\Requests\Admin\ExamUserAttempt\IndexExamUserAttempt;
use App\Models\Exam;
use App\Models\ExamUserAttempt;
use App\Models\User;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExamUserAttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexExamUserAttempt $request
     * @return array|Factory|View
     */
    public function index(IndexExamUserAttempt $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamUserAttempt::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'user', 'exam', 'started_at', 'finished_at', 'result', 'attempt_number'],

            // set columns to searchIn
            ['user'],

            function ($query) use ($request) {
                $query->filter($request->all());
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.exam-user-attempt.index', [
            'data' => $data,
            'attemptsCount' => ExamUserAttempt::count(),
            'exams' => DB::table('exams')->get(['id', 'title']),
            'users' => DB::table('users')->get(['id', 'fullname'])
        ]);
    }

    public function show(Exam $exam, User $user)
    {
        $attempts = $exam->attempts($user);
        return view('admin.exam-user.attempts', compact('exam', 'attempts', 'user'));
    }

    public function result(ExamUserAttempt $attempt)
    {
        return view('admin.exam-user.result', compact('attempt'));
    }

    public function export(Request $request)
    {
        $items = pluck_bulk_items(
            $request->get('items')
        );

        $query = ExamUserAttempt::whereIn('id', $items);

        return (new ReportsExport($query))->download('report.xlsx');
    }

    public function print(Request $request)
    {
        $items = pluck_bulk_items(
            json_decode($request->get('items'), true)
        );

        $report = ExamUserAttempt::find($items);

        return view('admin.exam-user-attempt.report-print', ['data' => $report]);

    }

    public function destroy(DestroyExamUserAttempt $request, ExamUserAttempt $attempt)
    {
        $attempt->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyExam $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyExamUserAttempt $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ExamUserAttempt::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
