

<?php $__env->startSection('title', 'Результат'); ?>

<?php $__env->startSection('content'); ?>

    <a href="<?php echo e(isset($exam) ? route('exam.attempts',$exam) : url()->previous()); ?>"
       class="btn btn-primary mb-2">
        <i class="fas fa-arrow-left"></i>
        Назад
    </a>

    <button class="btn btn-outline-secondary float-right" onclick="printable('print-area')">
        <i class="fas fa-print"></i>
    </button>

    <div id="print-area">
        <?php echo $__env->make('shared-partials.result-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <a class="btn btn-primary float-right" href="/">
        <i class="fas fa-home"></i>
        Вернуться к главной
    </a>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('client/layouts/contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/client/attempts/result.blade.php ENDPATH**/ ?>