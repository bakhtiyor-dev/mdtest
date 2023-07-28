<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Exam\BulkDestroyExam;
use App\Http\Requests\Admin\Exam\DestroyExam;
use App\Http\Requests\Admin\Exam\IndexExam;
use App\Http\Requests\Admin\Exam\StoreExam;
use App\Http\Requests\Admin\Exam\UpdateExam;
use App\Models\Exam;
use App\Models\Organisation;
use App\Models\RatingSetting;
use App\Models\Department;
use App\Models\TestCategory;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExamController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexExam $request
     * @return array|Factory|View
     */
    public function index(IndexExam $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Exam::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'start_date', 'end_date', 'attempts_count', 'time', 'department_id', 'organisation_id'],

            // set columns to searchIn
            ['id', 'title', 'start_date', 'end_date', 'attempts_count', 'time'],

            function ($query) use ($request) {
                $query->with(['department', 'organisation'])->withCount('users');

                if ($request->filled('department'))
                    $query->where('department_id', $request->department);

                if ($request->filled('organisation'))
                    $query->where('organisation_id', $request->organisation);
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

        return view('admin.exam.index', [
            'data' => $data,
            'examsCount' => Exam::count(),
            'departments' => Department::all(),
            'organisations' => Organisation::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.exam.create');

        return view('admin.exam.create', [
            'ratingSettings' => RatingSetting::all(),
            'departments' => Department::all(['id', 'title']),
            'testCategories' => TestCategory::withCount(['tests' => fn($query) => $query->available()])->get(),
            'organisations' => Organisation::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExam $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreExam $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Exam
        $exam = Exam::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/exams'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exams');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Exam $exam
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(Exam $exam)
    {
        $this->authorize('admin.exam.edit', $exam);

        return view('admin.exam.edit', [
            'exam' => $exam,
            'ratingSettings' => RatingSetting::all(),
            'departments' => Department::all(['id', 'title']),
            'testCategories' => TestCategory::withCount(['tests' => fn($query) => $query->available()])->get(),
            'organisations' => Organisation::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExam $request
     * @param Exam $exam
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateExam $request, Exam $exam)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Exam
        $exam->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/exams'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/exams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExam $request
     * @param Exam $exam
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyExam $request, Exam $exam)
    {
        $exam->delete();

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
    public function bulkDestroy(BulkDestroyExam $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Exam::whereIn('id', $bulkChunk)->delete();
                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
