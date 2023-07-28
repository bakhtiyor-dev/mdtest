<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingSetting\BulkDestroyRatingSetting;
use App\Http\Requests\Admin\RatingSetting\DestroyRatingSetting;
use App\Http\Requests\Admin\RatingSetting\IndexRatingSetting;
use App\Http\Requests\Admin\RatingSetting\StoreRatingSetting;
use App\Http\Requests\Admin\RatingSetting\UpdateRatingSetting;
use App\Models\RatingSetting;
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

class RatingSettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRatingSetting $request
     * @return array|Factory|View
     */
    public function index(IndexRatingSetting $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(RatingSetting::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'settings'],

            // set columns to searchIn
            ['id', 'title', 'settings'],

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

        return view('admin.rating-setting.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.rating-setting.create');

        return view('admin.rating-setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRatingSetting $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRatingSetting $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the RatingSetting
        $ratingSetting = RatingSetting::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/rating-settings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/rating-settings')->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param RatingSetting $ratingSetting
     * @return void
     * @throws AuthorizationException
     */
    public function show(RatingSetting $ratingSetting)
    {
        $this->authorize('admin.rating-setting.show', $ratingSetting);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RatingSetting $ratingSetting
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(RatingSetting $ratingSetting)
    {
        $this->authorize('admin.rating-setting.edit', $ratingSetting);


        return view('admin.rating-setting.edit', [
            'ratingSetting' => $ratingSetting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRatingSetting $request
     * @param RatingSetting $ratingSetting
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRatingSetting $request, RatingSetting $ratingSetting)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values RatingSetting
        $ratingSetting->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/rating-settings'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/rating-settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRatingSetting $request
     * @param RatingSetting $ratingSetting
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyRatingSetting $request, RatingSetting $ratingSetting)
    {
        $ratingSetting->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRatingSetting $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(BulkDestroyRatingSetting $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    RatingSetting::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
