<?php $__env->startSection('title', trans('admin.user.actions.edit', ['name' => $user->email])); ?>

<?php $__env->startSection('body'); ?>

    <div class="container-xl">
        <a href="<?php echo e(url('admin/users')); ?>" class="btn btn-primary mb-3">
            <i class="fa fa-arrow-left"></i>
            Назад
        </a>
        <div class="card">

            <user-form
                :action="'<?php echo e($user->resource_url); ?>'"
                :data="<?php echo e($user->toJson()); ?>"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> <?php echo e(trans('admin.user.actions.edit', ['name' => $user->fullname])); ?>

                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('admin.user.components.form-elements', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            <?php echo e(trans('brackets/admin-ui::admin.btn.save')); ?>

                        </button>
                    </div>
                    
                </form>

        </user-form>

        </div>
    
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/user/edit.blade.php ENDPATH**/ ?>