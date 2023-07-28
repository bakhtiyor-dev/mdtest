

<?php $__env->startSection('title', 'Попытки'); ?>

<?php $__env->startSection('content'); ?>

    <div>
        <a href="<?php echo e($exam->isExpired() ? route('exams.expired') : route('exams.available')); ?>"
           class="btn btn-primary mb-2">
            <i class="fas fa-arrow-left"></i>
            Назад
        </a>

        <div class="card col-lg-8">

            <div class="p-1 border-bottom">
                <strong>Название экзамена:</strong>
                <?php echo e($exam->title); ?>

            </div>

            <div class="card-body">
                <p>
                    <i class="fas fa-building"></i>
                    Подразделение: <?php echo e($exam->organisation->title); ?>

                </p>

                <p>
                    <i class="fas fa-cubes"></i>
                    Отдел: <?php echo e($exam->department->title); ?>

                </p>

                <p>
                    <i class="fas fa-calendar"></i>
                    Дата начала: <?php echo e($exam->start_date); ?>

                </p>

                <p>
                    <i class="fas fa-calendar-times"></i>
                    Дата закрытия: <?php echo e($exam->end_date); ?>

                </p>

                <p>
                    <i class="fas fa-stopwatch"></i>
                    Время: <?php echo e($exam->time); ?> минут
                </p>

                <p>
                    <i class="fas fa-calculator"></i>
                    Кол-во вопросов: <?php echo e($exam->tests_count); ?>

                </p>

                <p>
                    <i class="fas fa-undo"></i>
                    Осталось попыток: <?php echo e($exam->availableAttemptsCount(auth()->user())); ?>

                </p>

            </div>
        </div>

        <div class="card col-lg-8">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                <h5>№ Номер попытки:</h5>
                            </th>
                            <th>
                                <h5>Результат:</h5>
                            </th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if($attempts->isNotEmpty()): ?>
                            <?php $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attemptNumber => $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>Попытка <?php echo e($attemptNumber); ?></td>
                                    <?php if(isset($attempt)): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show',$attempt)): ?>
                                            <td><?php echo e($attempt->result); ?>%</td>
                                            <td>
                                                <a href="<?php echo e(route('attempt.show',$attempt)); ?>"
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa fa-eye"></i> Посмотреть
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td>-</td>

                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('take',$exam)): ?>
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                        data-target="#modal<?php echo e($attemptNumber); ?>">
                                                    <i class="fas fa-stopwatch"></i>
                                                    Начать
                                                </button>

                                                <div class="modal fade" id="modal<?php echo e($attemptNumber); ?>" tabindex="-1"
                                                     role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <h1 class="text-danger">
                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                    Внимание!
                                                                </h1>
                                                                <h4> После начала начнется подсчет времени.</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="<?php echo e(route('exam.start',[$exam,$attemptNumber])); ?>"
                                                                   class="btn btn-primary float-right"><i
                                                                            class="fas fa-stopwatch"></i>
                                                                    Начать
                                                                </a>
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                        data-dismiss="modal">Отмена
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>

                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>








<?php echo $__env->make('client/layouts/contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/client/attempts/index.blade.php ENDPATH**/ ?>