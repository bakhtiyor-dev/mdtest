

<?php $__env->startSection('title', "Результат"); ?>

<?php $__env->startSection('body'); ?>
<div class="container-fluid">
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary mb-2">
        <i class="icon icon-arrow-left-circle"></i>
        Назад
    </a>

    <button class="btn btn-primary float-right" onclick="printable('print-area')">
        <i class="fa fa-print"></i>
    </button>
    <div id="print-area">
        <?php echo $__env->make('shared-partials.result-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/admin/exam-user/result.blade.php ENDPATH**/ ?>