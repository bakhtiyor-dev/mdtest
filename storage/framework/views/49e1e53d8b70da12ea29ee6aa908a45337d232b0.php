<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title"><?php echo e(trans('brackets/admin-ui::admin.sidebar.content')); ?></li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/')); ?>"><i
                            class="nav-icon fa fa-line-chart"></i>Аналитика</a></li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/exam-user-attempts')); ?>"><i
                            class="nav-icon fa fa-info-circle"></i>Отчёты</a></li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/organisations')); ?>">
                    <i class="nav-icon fa fa-building"></i>
                    <?php echo e(trans('admin.organisation.title')); ?>

                </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/departments')); ?>">
                    <i class="nav-icon fa fa-cubes"></i>
                    <?php echo e(trans('admin.department.title')); ?></a>
            </li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/users')); ?>"><i
                            class="nav-icon icon-people"></i> <?php echo e(trans('admin.user.title')); ?></a></li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/exams')); ?>"><i
                            class="nav-icon icon-event"></i> <?php echo e(trans('admin.exam.title')); ?></a></li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('admin/test-categories')); ?>">
                    <i class="nav-icon fa fa-list"></i> <?php echo e(trans('admin.test-category.title')); ?>

                </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/tests')); ?>"><i
                            class="nav-icon fa fa-list-alt"></i> <?php echo e(trans('admin.test.title')); ?></a></li>


           

            <li class="nav-title"><?php echo e(trans('brackets/admin-ui::admin.sidebar.settings')); ?></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('admin/rating-settings')); ?>">
                    <i class="nav-icon icon-settings"></i> <?php echo e(trans('admin.rating-setting.title')); ?></a></li>

        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

<?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/layout/sidebar.blade.php ENDPATH**/ ?>