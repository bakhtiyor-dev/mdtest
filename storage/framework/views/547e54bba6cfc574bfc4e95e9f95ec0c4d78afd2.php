

<?php $__env->startSection('title', trans('admin.test.actions.create')); ?>

<?php $__env->startSection('body'); ?>

    <div class="container-xl">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary mb-2">
            <i class="icon icon-arrow-left-circle mr-1"></i>
            Назад
        </a>
        <div class="card">

            <test-form
                    :action="'<?php echo e(url('admin/tests')); ?>'"
                    v-cloak
                    inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> <?php echo e(trans('admin.test.actions.create')); ?>

                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('admin.test.components.form-elements', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            <?php echo e(trans('brackets/admin-ui::admin.btn.save')); ?>

                        </button>
                    </div>

                </form>

            </test-form>

        </div>

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/test/create.blade.php ENDPATH**/ ?>