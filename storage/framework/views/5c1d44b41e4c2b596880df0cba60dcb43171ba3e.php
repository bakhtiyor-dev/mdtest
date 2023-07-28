

<?php $__env->startSection('title', trans('admin.exam.actions.edit', ['name' => $exam->id])); ?>

<?php $__env->startSection('body'); ?>

    <div class="container-xl">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary mb-2">
            <i class="icon icon-arrow-left-circle mr-1"></i>
            Назад
        </a>
        <div class="card">
            <exam-form
                    :action="'<?php echo e($exam->resource_url); ?>'"
                    :data="<?php echo e($exam->toJson()); ?>"
                    :locales="<?php echo e(json_encode($locales)); ?>"
                    :send-empty-locales="false"
                    v-cloak
                    inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> <?php echo e(trans('admin.exam.actions.edit', ['name' => $exam->id])); ?>

                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('admin.exam.components.form-elements', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            <?php echo e(trans('brackets/admin-ui::admin.btn.save')); ?>

                        </button>
                    </div>

                </form>

            </exam-form>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/exam/edit.blade.php ENDPATH**/ ?>