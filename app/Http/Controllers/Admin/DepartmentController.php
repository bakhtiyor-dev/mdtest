<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\BulkDestroyDepartment;
use App\Http\Requests\Admin\Department\DestroyDepartment;
use App\Http\Requests\Admin\Department\IndexDepartment;
use App\Http\Requests\Admin\Department\StoreDepartment;
use App\Http\Requests\Admin\Department\UpdateDepartment;
use App\Models\Department;
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

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDepartment $request
     * @return array|Factory|View
     */
    public function index(IndexDepartment $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Department::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'title'],

            // set columns to searchIn
            ['id', 'title'],

            function ($query) {
                $query->withCount('exams');
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

        return view('admin.department.index', [
            'data' => $data,
            'departmentsCount' => Department::count()
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
        $this->authorize('admin.department.create');

        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDepartment $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Department
        $department = Department::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/departments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/departments');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(Department $department)
    {
        $this->authorize('admin.department.edit', $department);

        return view('admin.department.edit', [
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartment $request
     * @param Department $department
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDepartment $request, Department $department)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Department
        $department->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/departments'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/departments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDepartment $request
     * @param Department $department
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyDepartment $request, Department $department)
    {
        $department->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDepartment $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyDepartment $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Department::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
