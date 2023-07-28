<div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header text-center"><strong><?php echo e(trans('brackets/admin-ui::admin.profile_dropdown.account')); ?></strong></div>
    <a href="<?php echo e(url('admin/profile')); ?>" class="dropdown-item"><i class="fa fa-user"></i>  <?php echo e(trans('brackets/admin-auth::admin.profile_dropdown.profile')); ?></a>
    <a href="<?php echo e(url('admin/password')); ?>" class="dropdown-item"><i class="fa fa-key"></i>  <?php echo e(trans('brackets/admin-auth::admin.profile_dropdown.password')); ?></a>
    
    <a href="<?php echo e(url('admin/logout')); ?>" class="dropdown-item"><i class="fa fa-lock"></i> <?php echo e(trans('brackets/admin-auth::admin.profile_dropdown.logout')); ?></a>
</div><?php /**PATH C:\OpenServer\domains\myproject\resources\views/admin/layout/profile-dropdown.blade.php ENDPATH**/ ?>