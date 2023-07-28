<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\IndexReports;
use App\Models\ExamUser;
use App\Models\ExamUserAttempt;
use Brackets\AdminListing\Facades\AdminListing;

class ReportController extends Controller
{
    public function index(IndexReports $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamUserAttempts::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'user_id', 'exam_id', 'end_date', 'attempts_count', 'time'],

            // set columns to searchIn
            ['description', 'id', 'test_category_count'],

            function ($query) use ($request) {
                if ($request->missing('orderBy'))
                    $query->latest();
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

        return view('admin.reports.index', ['data' => $data]);
    }
}