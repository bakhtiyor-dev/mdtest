

<?php $__env->startSection('title', 'Доступные экзамены'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4">
                <?php echo $__env->make('client.exams.available.card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h4 class="text-muted">У вас отсутствует доступных экзаменов!</h4>
        <?php endif; ?>

    </div>
    <div class="clearfix">
        <div class="float-right">
            <?php echo $exams->links('pagination::bootstrap-4'); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('client/layouts/contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/client/exams/available/index.blade.php ENDPATH**/ ?>