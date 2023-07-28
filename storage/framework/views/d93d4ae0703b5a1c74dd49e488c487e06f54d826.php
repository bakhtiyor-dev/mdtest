

<?php $__env->startSection('title', 'Отчёты'); ?>

<?php $__env->startSection('body'); ?>

    <exam-user-attempt-listing
            :data="<?php echo e($data->toJson()); ?>"
            :url="'<?php echo e(url('admin/exam-user-attempts')); ?>'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header ">
                        <div class="pull-left">
                            <h4>
                                <i class="fa fa-info-circle"></i> Отчёты
                            </h4>

                            <h5>Общее кол-во попыток: <?php echo e($attemptsCount); ?></h5>
                        </div>

                        <form action="<?php echo e(url('/admin/exam-user-attempts/print')); ?>"
                              method="POST" class="pull-right">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="items" :value="JSON.stringify(bulkItems)">

                            <button class="btn btn-sm btn-primary"
                                    :disabled="clickedBulkItemsCount === 0"
                                    type="submit">
                                <i class="fa fa-print"></i>
                                Распечатать
                            </button>

                        </form>

                        <button class="btn btn-sm btn-primary pull-right mr-2"
                                :disabled="clickedBulkItemsCount === 0"
                                @click="exportData">
                            <i class="fa" :class="loadingExport ? 'fa-spinner' : 'fa-file-excel-o'"></i>
                            Экспортировать
                        </button>

                    </div>
                    <div class="card-body pt-0" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row mb-5">

                                    <div class="col-lg-3">
                                        <label>Фильтр по экзаменам:</label>
                                        <v-select :options="<?php echo e($exams->toJson()); ?>"
                                                  label="title"
                                                  :reduce="function(exam){return exam.id}"
                                                  @input="filter('exam',$event)">
                                        </v-select>
                                    </div>

                                    <div class="col-lg">
                                        <label>Фильтр по пользователям:</label>
                                        <v-select :options="<?php echo e($users->toJson()); ?>"
                                                  label="fullname"
                                                  :reduce="function(user){return user.id}"
                                                  @input="filter('user',$event)">
                                        </v-select>
                                    </div>

                                    <div class="col col-lg-4 col-xl-4 form-group">
                                        <label>Фильтр по результатам:</label>
                                        <vue-slider v-model="filters.result"
                                                    :tooltip="'always'"
                                                    :tooltip-placement="'bottom'"
                                                    :enable-cross="false"
                                                    :clickable="false"
                                                    @drag-end="filter('result',filters.result)">
                                        </vue-slider>
                                    </div>

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

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

                                    <th is='sortable' :column="'id'">ID</th>
                                    <th>Пользователь</th>
                                    <th>Экзамен</th>
                                    <th is='sortable' :column="'started_at'">Время начала</th>
                                    <th is='sortable' :column="'finished_at'">Время завершения</th>
                                    <th>Потраченное время (в минутах)</th>
                                    <th>Номер попытки</th>
                                    <th is='sortable' :column="'result'">Результат</th>

                                    <th></th>
                                </tr>

                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="11">
                                            <span class="align-middle font-weight-light text-dark"><?php echo e(trans('brackets/admin-ui::admin.listing.selected_items')); ?> {{ clickedBulkItemsCount }}.  <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAll('/admin/exam-user-attempts')"
                                                        v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                            class="fa"
                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> <?php echo e(trans('brackets/admin-ui::admin.listing.check_all_items')); ?> {{ pagination.state.total }}</a> <span
                                                        class="text-primary">|</span> <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAllUncheck()"><?php echo e(trans('brackets/admin-ui::admin.listing.uncheck_all_items')); ?></a>  </span>

                                        <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                        @click="bulkDelete('/admin/exam-user-attempts/bulk-destroy')"><?php echo e(trans('brackets/admin-ui::admin.btn.delete')); ?></button>
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
                                    <td>{{ item.user.fullname }}</td>
                                    <td>{{ item.exam.title}}</td>
                                    <td>{{ item.started_at | datetime }}</td>
                                    <td>{{ item.finished_at | datetime }}</td>
                                    <td>{{ item.spent_time }} мин.</td>
                                    <td>{{ item.attempt_number}}</td>

                                    <td>{{ item.result }}%
                                        <b :style="{color:item.rating ? item.color : ''}"
                                           v-text="item.rating ? item.comment : ''">
                                        </b>
                                    </td>

                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info"
                                                   :href="item.resource_url+'/view'"
                                                   title="Посмотреть"
                                                   role="button"><i class="fa fa-eye"></i></a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </exam-user-attempt-listing>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/admin/exam-user-attempt/index.blade.php ENDPATH**/ ?>