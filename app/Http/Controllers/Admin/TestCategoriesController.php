<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestCategory\BulkDestroyTestCategory;
use App\Http\Requests\Admin\TestCategory\DestroyTestCategory;
use App\Http\Requests\Admin\TestCategory\IndexTestCategory;
use App\Http\Requests\Admin\TestCategory\StoreTestCategory;
use App\Http\Requests\Admin\TestCategory\UpdateTestCategory;
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

class TestCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTestCategory $request
     * @return array|Factory|View
     */
    public function index(IndexTestCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TestCategory::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'title'],

            // set columns to searchIn
            ['id', 'title'],

            function ($query) {
                $query->withCount('tests');
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

        return view('admin.test-category.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.test-category.create');

        return view('admin.test-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTestCategory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTestCategory $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the TestCategory
        $testCategory = TestCategory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/test-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/test-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param TestCategory $testCategory
     * @return void
     * @throws AuthorizationException
     */
    public function show(TestCategory $testCategory)
    {
        $this->authorize('admin.test-category.show', $testCategory);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TestCategory $testCategory
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(TestCategory $testCategory)
    {
        $this->authorize('admin.test-category.edit', $testCategory);


        return view('admin.test-category.edit', [
            'testCategory' => $testCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTestCategory $request
     * @param TestCategory $testCategory
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTestCategory $request, TestCategory $testCategory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values TestCategory
        $testCategory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/test-categories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/test-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTestCategory $request
     * @param TestCategory $testCategory
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyTestCategory $request, TestCategory $testCategory)
    {
        $testCategory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTestCategory $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyTestCategory $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TestCategory::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
