

<?php $__env->startSection('title', "Подключенные пользователи"); ?>

<?php $__env->startSection('body'); ?>

    <exam-user-listing
            :data="<?php echo e($data->toJson()); ?>"
            :url="'<?php echo e(route('admin/exam-users/index',$exam)); ?>'"
            inline-template>

        <div class="row">
            <div class="col">
                <a href="<?php echo e(url('/admin/exams')); ?>" class="btn btn-primary mb-2">
                    <i class="icon icon-arrow-left-circle"></i>
                    Экзамены
                </a>

                <div class="card">
                    <div class="card-header">
                        <h4 class="pull-left">
                            <i class="fa fa-users"></i> Подключенные пользователи экзамена
                        </h4>
                        <div class="pull-right">

                            <button class="btn btn-sm btn-primary mr-2"
                                    @click="bulkNotify(<?php echo e($exam->id); ?>)"
                                    :disabled="clickedBulkItemsCount === 0">
                                <i class="fa" :class="loading ? 'fa-spinner' : 'fa-send'"></i>
                                Отправить уведомление
                            </button>

                            <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                               href="<?php echo e(route('admin/exam-users/create',$exam)); ?>" role="button"><i
                                        class="fa fa-user-plus"></i>&nbsp; Подключить пользователей</a>
                        </div>

                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block pt-0">
                            <form @submit.prevent="">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex">
                                            <p class="mr-4">
                                                <b class="text-monospace">ID экзамена: <?php echo e($exam->id); ?></b>
                                            </p>
                                            <div>
                                                <b>Название экзамена:</b>
                                                <?php echo e($exam->title); ?>

                                            </div>
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
                                    <th>Учетное имя</th>
                                    <th>Электронная почта</th>
                                    <th>Должность</th>
                                    <th>Отдел</th>
                                    <th>Подразделение</th>
                                    <th>E-mail уведомление</th>
                                    <th></th>

                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="9">
                                            <span class="align-middle font-weight-light text-dark"><?php echo e(trans('brackets/admin-ui::admin.listing.selected_items')); ?> {{ clickedBulkItemsCount }}.  <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAll('<?php echo e(route('admin/exam-users/index',$exam)); ?>')"
                                                        v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                            class="fa"
                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> <?php echo e(trans('brackets/admin-ui::admin.listing.check_all_items')); ?> {{ pagination.state.total }}</a> <span
                                                        class="text-primary">|</span> <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAllUncheck()"><?php echo e(trans('brackets/admin-ui::admin.listing.uncheck_all_items')); ?></a>  </span>

                                        <span class="pull-right pr-2">

                                                <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                        @click="bulkDelete('/admin/exam-users/bulk-destroy')">Открепить с экзамена</button>
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

                                    <td>{{ item.user.fullname }}</td>
                                    <td>{{ item.user.email }}</td>
                                    <td>{{ item.user.position }}</td>
                                    <td>{{ item.user.department }}</td>
                                    <td>{{ item.user.organisation }}</td>
                                    <td>
                                        <span v-if="item.notified" class="badge badge-primary">
                                            <i class="fa fa-envelope"></i>
                                            Уведомление отправлено
                                        </span>

                                        <span v-else class="badge badge-secondary">
                                            <i class="fa fa-envelope"></i>
                                            Уведомление не отправлено
                                        </span>
                                    </td>
                                    <td>
                                        <div class="row no-gutters">
                                            <a :href="'/admin/exam-users/exam/<?php echo e($exam->id); ?>/users/'+item.user.id"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-info-circle"></i>
                                                Отчёт по экзамену
                                            </a>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Открепить"><i
                                                            class="fa fa-trash-o"></i> Открепить пользователя
                                                </button>
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
                                <i class="fa fa-user-times"></i>
                                <h3>Отсутствует подключенных пользователей</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </exam-user-listing>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/exam-user/index.blade.php ENDPATH**/ ?>