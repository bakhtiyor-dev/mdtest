

<?php $__env->startSection('title', trans('admin.exam.actions.index')); ?>

<?php $__env->startSection('body'); ?>
    <exam-listing
            :data="<?php echo e($data->toJson()); ?>"
            :url="'<?php echo e(url('admin/exams')); ?>'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <h4>
                                <i class="fa fa-calendar"></i> <?php echo e(trans('admin.exam.actions.index')); ?>

                            </h4>
                            <h5>Общее количество экзаменов: <?php echo e($examsCount); ?></h5>
                        </div>

                        <div>
                            <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                               href="<?php echo e(url('admin/exams/create')); ?>" role="button"><i
                                        class="fa fa-plus"></i>&nbsp; <?php echo e(trans('admin.exam.actions.create')); ?></a>
                        </div>

                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row">
                                    <div class="col col-lg-4 form-group">
                                        <label>Поиск:</label>
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

                                    <div class="col-lg-3">
                                        <label>Подразделение:</label>
                                        <v-select :options="<?php echo e($organisations->toJson()); ?>"
                                                  label="title"
                                                  :reduce="function(organisation){ return organisation.id}"
                                                  @input="filter('organisation',$event)">
                                        </v-select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Отдел:</label>
                                        <v-select :options="<?php echo e($departments->toJson()); ?>"
                                                  label="title"
                                                  :reduce="function(department){return department.id} "
                                                  @input="filter('department',$event)">
                                        </v-select>
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-auto form-group ">
                                        <label>Показать по:</label>
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

                                    <th is='sortable' :column="'id'"><?php echo e(trans('admin.exam.columns.id')); ?></th>
                                    <th is='sortable' :column="'description'">Название</th>
                                    <th>Отдел</th>
                                    <th>Подразделение</th>
                                    <th is='sortable'
                                        :column="'start_date'"><?php echo e(trans('admin.exam.columns.start_date')); ?></th>
                                    <th is='sortable'
                                        :column="'end_date'"><?php echo e(trans('admin.exam.columns.end_date')); ?></th>
                                    <th is='sortable'
                                        :column="'attempts_count'"><?php echo e(trans('admin.exam.columns.attempts_count')); ?></th>
                                    <th is='sortable' :column="'time'"><?php echo e(trans('admin.exam.columns.time')); ?></th>
                                    <th width="40">Кол-во подключенных пользователей</th>
                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="12">
                                            <span class="align-middle font-weight-light text-dark"><?php echo e(trans('brackets/admin-ui::admin.listing.selected_items')); ?> {{ clickedBulkItemsCount }}.  <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAll('/admin/exams')"
                                                        v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                            class="fa"
                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> <?php echo e(trans('brackets/admin-ui::admin.listing.check_all_items')); ?> {{ pagination.state.total }}</a> <span
                                                        class="text-primary">|</span> <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAllUncheck()"><?php echo e(trans('brackets/admin-ui::admin.listing.uncheck_all_items')); ?></a>  </span>

                                        <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                        @click="bulkDelete('/admin/exams/bulk-destroy')"><?php echo e(trans('brackets/admin-ui::admin.btn.delete')); ?></button>
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
                                    <td>{{ item.title }}</td>
                                    <td>{{ item.department.title }}</td>
                                    <td>{{ item.organisation.title }}</td>
                                    <td>{{ item.start_date | datetime }}</td>
                                    <td>{{ item.end_date | datetime }}</td>
                                    <td>{{ item.attempts_count }}</td>
                                    <td>{{ item.time }}</td>
                                    <td>
                                        <i class="fa fa-users"></i>
                                        {{ item.users_count }}
                                    </td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info text-white"
                                                   :href="'/admin/exam-users/exam/'+item.id"
                                                   title="Прикрепленные пользователи"
                                                   role="button">
                                                    <i class="fa fa-users"></i>
                                                    Пользователи экзамена
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info"
                                                   :href="item.resource_url + '/edit'"
                                                   title="<?php echo e(trans('brackets/admin-ui::admin.btn.edit')); ?>"
                                                   role="button">
                                                    <i class="fa fa-edit"></i>

                                                </a>
                                            </div>
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
                                <a class="btn btn-primary btn-spinner" href="<?php echo e(url('admin/exams/create')); ?>"
                                   role="button"><i
                                            class="fa fa-plus"></i>&nbsp; <?php echo e(trans('admin.exam.actions.create')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </exam-listing>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/exam/index.blade.php ENDPATH**/ ?>