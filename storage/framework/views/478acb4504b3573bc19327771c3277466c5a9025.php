

<?php $__env->startSection('title', 'Распечатка'); ?>

<?php $__env->startSection('content'); ?>

    <div class="clearfix mb-2">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary float-left">
            <i class="fa fa-arrow-left"></i>
            Назад
        </a>
        <h4 class="float-left ml-4">Всего: <?php echo e($tests->count()); ?> тестов</h4>
        <button class="btn btn-primary float-right" onclick="printable('print-area')">
            <i class="fa fa-print"></i>
        </button>

    </div>

    <div id="print-area">
        <div class="clearfix">
            <img src="<?php echo e(asset('images/kapitalbank-logo.png')); ?>" class="float-right" style="height: 30px">
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <?php ($test->shuffleAnswers()); ?>

            <?php echo $__env->make('shared-partials.test', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h4 class="text-center text-muted">По вашим данным ничего не найдено!</h4>
        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/admin/test/components/print.blade.php ENDPATH**/ ?>