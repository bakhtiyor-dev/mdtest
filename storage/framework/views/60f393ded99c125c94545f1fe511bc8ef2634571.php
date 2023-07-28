

<?php $__env->startSection('title', "Отчет"); ?>

<?php $__env->startSection('body'); ?>
    <div class="clearfix">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary mb-2 float-left">
            <i class="fa fa-arrow-circle-left"></i>
            Назад
        </a>
        <button class="btn btn-primary float-right" onclick="printable('print-area')">
            <i class="fa fa-print"></i>
        </button>

    </div>
    <div class="card" id="print-area">
        <div class="card-header clearfix">
            <h5 class="float-left">Отчёт к <?php echo e(now()); ?></h5>
            <img src="<?php echo e(asset('images/kapitalbank-logo.png')); ?>" class="float-right" style="height: 25px;" alt="logo">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Экзамен</th>
                        <th>Время начала</th>
                        <th>Время окончания</th>
                        <th>Потраченное время(в минутах)</th>
                        <th>Номер попытки</th>
                        <th>Результат (%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($report->id); ?></td>
                            <td><?php echo e($report->user->fullname); ?></td>
                            <td><?php echo e($report->exam->title); ?></td>
                            <td><?php echo e($report->started_at); ?></td>
                            <td><?php echo e($report->finished_at); ?></td>
                            <td><?php echo e($report->spent_time); ?></td>
                            <td><?php echo e($report->attempt_number); ?></td>
                            <td><?php echo e($report->result); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/admin/exam-user-attempt/report-print.blade.php ENDPATH**/ ?>