<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamUser\BulkDestroyExamUser;
use App\Http\Requests\Admin\ExamUser\DestroyExamUser;
use App\Http\Requests\Admin\ExamUser\IndexExamUser;
use App\Http\Requests\Admin\ExamUser\StoreExamUser;
use App\Models\Exam;
use App\Models\ExamUser;
use App\Models\User;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExamUserController extends Controller
{
    public function index(Exam $exam, IndexExamUser $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamUser::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'user_id', 'exam_id', 'notified'],

            // set columns to searchIn
            ['id'],

            fn($query) => $query->with('user')->where('exam_id', $exam->id)
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.exam-user.index', [
            'data' => $data,
            'exam' => $exam
        ]);
    }

    public function create(Exam $exam, Request $request)
    {
        $this->authorize('admin.exam-user.create');

        $data = AdminListing::create(User::class)->processRequestAndGet(

            $request,

            ['id', 'fullname', 'email', 'position', 'department', 'organisation'],

            ['fullname', 'email', 'position', 'department', 'organisation'],

            function ($query) use ($exam, $request) {

                $query->filter($request->all());

                $query->whereDoesntHave('exams', function (Builder $query) use ($exam) {
                    $query->where('exam_id', $exam->id);
                });
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

        return view('admin.exam-user.create', [
            'exam' => $exam,
            'data' => $data,
            'positions' => User::positions(),
            'departments' => User::departments(),
            'organisations' => User::organisations()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExamUser $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(Request $request, Exam $exam)
    {
        $userIDs = pluck_bulk_items(json_decode($request->users, true));

        $exam->users()->attach($userIDs);

        if ($request->ajax()) {
            return ['redirect' => route('admin/exam-users/index', $exam), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin/exam-users/index', $exam);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExamUser $request
     * @param ExamUser $examUser
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyExamUser $request, ExamUser $examUser)
    {
        $exam = $examUser->exam;

        $examUser->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyExamUser $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyExamUser $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ExamUser::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
