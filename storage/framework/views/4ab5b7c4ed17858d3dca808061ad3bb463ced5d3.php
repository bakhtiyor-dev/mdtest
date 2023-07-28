<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                    <img src="<?php echo e(asset('images/kapitalbank-logo.png')); ?>" class="img-fluid" alt="logo">
                </a>
            </li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item mb-1 <?php echo e(Route::is('exams.available')?'active':''); ?>">
                <a href="<?php echo e(route('exams.available')); ?>">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-title">Доступные экзамены</span>
                </a>
            </li>

            <li class="nav-item <?php echo e(Route::is('exams.expired')?'active':''); ?>">
                <a href="<?php echo e(route('exams.expired')); ?>">
                    <i class="fas fa-calendar-times"></i>
                    <span class="menu-title">Прошедшие экзамены</span>
                </a>
            </li>

        </ul>
    </div>
</div>
<?php /**PATH C:\OpenServer\domains\myproject\resources\views/client/panels/sidebar.blade.php ENDPATH**/ ?>