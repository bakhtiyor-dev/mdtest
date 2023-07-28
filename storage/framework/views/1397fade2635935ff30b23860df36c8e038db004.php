

<?php $__env->startSection('title', trans('admin.test.actions.index')); ?>

<?php $__env->startSection('body'); ?>


    <test-listing
            :data="<?php echo e($data->toJson()); ?>"
            :url="'<?php echo e(url('admin/tests')); ?>'"
            :export-action="'<?php echo e(route('admin/tests/export')); ?>'"
            inline-template>

        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-3">
                                <h4>
                                    <i class="fa fa-list-alt"></i> <?php echo e(trans('admin.test.actions.index')); ?>

                                </h4>
                                <h5>Общее количество тестов: <?php echo e($testsCount); ?></h5>
                            </div>

                            <div class="col-lg">
                                <form action="<?php echo e(route('admin/tests/print')); ?>" method="POST"
                                      class="pull-right m-b-0 ml-2">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="items" :value="JSON.stringify(bulkItems)">
                                    <button class="btn btn-sm btn-primary pr-3 pl-3" type="submit"
                                            :disabled="clickedBulkItemsCount === 0">
                                        <i class="fa fa-print"></i>
                                        Печать
                                    </button>
                                </form>

                                <button class="btn btn-primary btn-sm pull-right m-b-0 ml-2"
                                        @click.prevent="exportTests" :disabled="clickedBulkItemsCount === 0">
                                    <i class="fa fa-file-excel-o"></i>&nbsp; <?php echo e(trans('admin.test.actions.export')); ?>

                                </button>

                                <button class="btn btn-primary btn-sm pull-right m-b-0 ml-2"
                                        @click.prevent="$modal.show('import')">
                                    <i class="fa fa-download"></i>&nbsp;
                                    Импортировать
                                </button>

                                <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                                   href="<?php echo e(url('admin/tests/create')); ?>" role="button"><i
                                            class="fa fa-plus"></i>&nbsp; <?php echo e(trans('admin.test.actions.create')); ?></a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-4 form-group">
                                        <label>Поиск по вопросу:</label>

                                        <div class="input-group">
                                            <input class="form-control"
                                                   placeholder="Введите вопрос теста"
                                                   v-model="search"
                                                   @keyup.enter="filter('search', $event.target.value)"/>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary"
                                                        @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; <?php echo e(trans('brackets/admin-ui::admin.btn.search')); ?></button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Фильтр по типам вопросов</label>
                                        <v-select :options="answerTypes"
                                                  label="title"
                                                  :reduce="function(type){ return type.type}"
                                                  @input="filter('answers_type',$event)">
                                        </v-select>
                                    </div>

                                    <div class="col-lg-4">

                                        <label>Фильтр по категориям</label>

                                        <v-select :options="<?php echo e($testCategories->toJson()); ?>"
                                                  label="title"
                                                  :reduce="function (category) { return category.id}"
                                                  @input="filter('category',$event)">
                                        </v-select>
                                    </div>

                                    <div class="col-lg-2">
                                        <label>Статус</label>
                                        <v-select :options="statuses"
                                                  label="title"
                                                  :reduce="function(status){ return status.value}"
                                                  @input="filter('status',$event)">
                                        </v-select>
                                    </div>

                                    <div class="col-sm-auto form-group ">
                                        <label>Показать по</label>
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

                                    <th is='sortable' :column="'id'"><?php echo e(trans('admin.test.columns.id')); ?></th>
                                    <th is='sortable' :column="'body'">Вопрос</th>
                                    <th is='sortable'
                                        :column="'answers_type'"><?php echo e(trans('admin.test.columns.answers_type')); ?></th>
                                    <th is='sortable' :column="'department_id'">Категория</th>
                                    <th is='sortable' :column="'status'">Статус</th>
                                    <th></th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="7">
                                            <span class="align-middle font-weight-light text-dark"><?php echo e(trans('brackets/admin-ui::admin.listing.selected_items')); ?> {{ clickedBulkItemsCount }}.  <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAll('/admin/tests')"
                                                        v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                            class="fa"
                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> <?php echo e(trans('brackets/admin-ui::admin.listing.check_all_items')); ?> {{ pagination.state.total }}</a> <span
                                                        class="text-primary">|</span> <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAllUncheck()"><?php echo e(trans('brackets/admin-ui::admin.listing.uncheck_all_items')); ?></a>  </span>

                                        <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                        @click="bulkDelete('/admin/tests/bulk-destroy')"><?php echo e(trans('brackets/admin-ui::admin.btn.delete')); ?></button>
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
                                    <td>{{ item.body | html }}</td>
                                    <td>{{ item.answer_type }}</td>
                                    <td>{{ item.category.title }}</td>
                                    <td>
                                        <span v-if="item.status" class="text-success">Доступен</span>
                                        <span v-else class="text-danger">Недоступен</span>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info"
                                                   :href="item.resource_url + '/edit'"
                                                   title="<?php echo e(trans('brackets/admin-ui::admin.btn.edit')); ?>"
                                                   role="button"><i class="fa fa-edit"></i></a>
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
                                <a class="btn btn-primary btn-spinner" href="<?php echo e(url('admin/tests/create')); ?>"
                                   role="button"><i
                                            class="fa fa-plus"></i>&nbsp; <?php echo e(trans('admin.test.actions.create')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <import-modal :action="'<?php echo e(route('admin/tests/import')); ?>'"
                          :categories="<?php echo e($testCategories->toJson()); ?>">
            </import-modal>

        </div>

    </test-listing>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/test/index.blade.php ENDPATH**/ ?>