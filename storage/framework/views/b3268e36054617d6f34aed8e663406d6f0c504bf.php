<?php $__env->startSection('title', trans('admin.user.actions.index')); ?>

<?php $__env->startSection('body'); ?>

    <user-listing
            :data="<?php echo e($data->toJson()); ?>"
            :url="'<?php echo e(url('admin/users')); ?>'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <h4>
                                <i class="fa fa-users"></i> <?php echo e(trans('admin.user.actions.index')); ?>

                            </h4>
                            <h5>Общее количество пользователей: <?php echo e($usersCount); ?></h5>
                        </div>

                        <?php if(config('app.auth_ldap')): ?>
                            <button class="btn btn-primary btn-sm pull-right m-b-0" @click.prevent="sync">
                                <i class="fa" :class="loading ? 'fa-spinner' : 'fa-refresh'"></i>
                                Синхронизация с AD
                            </button>
                        <?php else: ?>
                            <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                               href="<?php echo e(url('admin/users/create')); ?>" role="button"><i
                                        class="fa fa-plus"></i>&nbsp; <?php echo e(trans('admin.user.actions.create')); ?></a>

                        <?php endif; ?>


                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block pt-0">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5  form-group">
                                        <label>Поиск по всем полям:</label>
                                        <div class="input-group">
                                            <input class="form-control"
                                                   placeholder="<?php echo e(trans('brackets/admin-ui::admin.placeholder.search')); ?>"
                                                   v-model="search"
                                                   @keyup.enter="filter('search', $event.target.value)"/>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary"
                                                        @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; <?php echo e(trans('brackets/admin-ui::admin.btn.search')); ?></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">

                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                <tr>
                                    <th class="bulk-checkbox">
                                        <input class="form-check-input" id="enabled" type="checkbox"
                                               v-model="isClickedAll" v-validate="''" data-vv-name="enabled"
                                               name="enabled_fake_element"
                                               @click="onBulkItemsClickedAllWithPagination()">
                                        <label class="form-check-label" for="enabled">
                                            #
                                        </label>
                                    </th>

                                    <th is='sortable' :column="'id'"><?php echo e(trans('admin.user.columns.id')); ?></th>
                                    <th is='sortable'
                                        :column="'fullname'"><?php echo e(trans('admin.user.columns.fullname')); ?></th>
                                    <th is='sortable' :column="'email'"><?php echo e(trans('admin.user.columns.email')); ?></th>
                                    <th is='sortable'
                                        :column="'position'"><?php echo e(trans('admin.user.columns.position')); ?></th>
                                    <th is='sortable'
                                        :column="'department'"><?php echo e(trans('admin.user.columns.department')); ?></th>
                                    <th is='sortable'
                                        :column="'organisation'"><?php echo e(trans('admin.user.columns.organisation')); ?></th>

                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="9">
                                            <span class="align-middle font-weight-light text-dark"><?php echo e(trans('brackets/admin-ui::admin.listing.selected_items')); ?> {{ clickedBulkItemsCount }}.  <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAll('/admin/users')"
                                                        v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                            class="fa"
                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> <?php echo e(trans('brackets/admin-ui::admin.listing.check_all_items')); ?> {{ pagination.state.total }}</a> <span
                                                        class="text-primary">|</span> <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAllUncheck()"><?php echo e(trans('brackets/admin-ui::admin.listing.uncheck_all_items')); ?></a>  </span>

                                        <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                        @click="bulkDelete('/admin/users/bulk-destroy')"><?php echo e(trans('brackets/admin-ui::admin.btn.delete')); ?></button>
                                            </span>

                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id"
                                    :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                    <td class="bulk-checkbox">
                                        <input class="form-check-input" :id="'enabled' + item.id" type="checkbox"
                                               v-model="bulkItems[item.id]" v-validate="''"
                                               :data-vv-name="'enabled' + item.id"
                                               :name="'enabled' + item.id + '_fake_element'"
                                               @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                        <label class="form-check-label" :for="'enabled' + item.id">
                                        </label>
                                    </td>

                                    <td>{{ item.id }}</td>
                                    <td>{{ item.fullname }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.position }}</td>
                                    <td>{{ item.department }}</td>
                                    <td>{{ item.organisation }}</td>

                                    <td>
                                        <div class="row no-gutters">

                                            <?php if(!config('app.auth_ldap')): ?>
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info"
                                                       :href="item.resource_url + '/edit'"
                                                       title="<?php echo e(trans('brackets/admin-ui::admin.btn.edit')); ?>"
                                                       role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                            <?php endif; ?>

                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        title="<?php echo e(trans('brackets/admin-ui::admin.btn.delete')); ?>"><i
                                                            class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption"><?php echo e(trans('brackets/admin-ui::admin.pagination.overview')); ?></span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3><?php echo e(trans('brackets/admin-ui::admin.index.no_items')); ?></h3>
                                <p><?php echo e(trans('brackets/admin-ui::admin.index.try_changing_items')); ?></p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </user-listing>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/user/index.blade.php ENDPATH**/ ?>