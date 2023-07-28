<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\BulkDestroyTest;
use App\Http\Requests\Admin\Test\DestroyTest;
use App\Http\Requests\Admin\Test\ExportTest;
use App\Http\Requests\Admin\Test\ImportTest;
use App\Http\Requests\Admin\Test\IndexTest;
use App\Http\Requests\Admin\Test\StoreTest;
use App\Http\Requests\Admin\Test\UpdateTest;
use App\Models\Test;
use App\Models\TestCategory;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexTest $request
     * @return array|Factory|View
     */
    public function index(IndexTest $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Test::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'body', 'answers_type', 'category_id', 'status'],

            // set columns to searchIn
            ['body', 'id'],

            function ($query) use ($request) {

                $query->with(['category']);

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

        return view('admin.test.index', [
            'data' => $data,
            'testsCount' => Test::count(),
            'testCategories' => TestCategory::all(['id', 'title'])
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
        $this->authorize('admin.test.create');

        return view('admin.test.create', [
            'categories' => TestCategory::all(['id', 'title']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTest $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTest $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        $sanitized['answers_type'] = $request->getAnswersType();

        $sanitized['answers_id'] = $sanitized['answers_type']::create($request->getAnswersData())->id;

        // Store the Test
        $test = Test::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/tests'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/tests');
    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return void
     * @throws AuthorizationException
     */
    public function show(Test $test)
    {
        $this->authorize('admin.test.show', $test);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Test $test
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(Test $test)
    {
        $this->authorize('admin.test.edit', $test);

        $test->load(['category', 'answers']);

        $test->makeVisible('explanation');

        return view('admin.test.edit', [
            'test' => $test,
            'categories' => TestCategory::all(['id', 'title'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTest $request
     * @param Test $test
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTest $request, Test $test)
    {
        $sanitized = $request->getSanitized();

        $answersType = $request->getAnswersType();

        $sanitized['answers_type'] = $answersType;

        if ($answersType == $test->answers_type) {
            $test->answers->update($request->getAnswersData());
        } else {

            if ($test->answers)
                $test->answers->delete();

            $sanitized['answers_id'] = $answersType::create($request->getAnswersData())->id;
        }

        // Update changed values Test
        $test->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/tests'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/tests')->with('message', 'message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTest $request
     * @param Test $test
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyTest $request, Test $test)
    {
        $test->answers()->delete();

        $test->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTest $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyTest $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {

                    DB::table('tests')
                        ->whereIn('id', $bulkChunk)
                        ->get(['answers_type', 'answers_id'])
                        ->groupBy('answers_type')
                        ->map(fn($item) => $item->pluck('answers_id'))
                        ->each(fn($ids, $model) => $model::whereIn('id', $ids->toArray())->delete());

                    Test::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }


    public function export(ExportTest $request)
    {
        $testIds = pluck_bulk_items($request->json('items'));

        $tests = Test::find($testIds);

        $haveUniqueAnswerType = $tests->uniqueStrict('answers_type')->count() === 1;

        if (!$haveUniqueAnswerType)
            return response(['message' => 'Пожалуйста выберите тесты только с одинаковым типом вопросов.'], 500);

        $exportable = $tests->first()->answers_type::getExportable();

        $exportable->setCollection($tests->load('category'));

        return ($exportable)->download("tests.xlsx");
    }

    /**
     * @param ImportTest $request
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|Response
     */
    public function import(ImportTest $request)
    {
        $sanitized = $request->getSanitized();

        $importable = $sanitized['test_type']::getImportable();

        $importable->setCategory($sanitized['category_id']);

        Excel::import($importable, $request->file('file'));

        return response(['message' => 'Импортирование прошло успешно! Обновите для просмотра изменений.']);
    }

    public function print(Request $request)
    {
        $request->validate(['items' => 'required']);

        $testIds = pluck_bulk_items(json_decode($request->get('items'), true));

        $tests = Test::whereIn('id', $testIds)->get(['id', 'body', 'answers_type', 'answers_id']);

        return view('admin.test.components.print', ['tests' => $tests]);

    }


}
