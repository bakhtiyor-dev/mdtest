<div class="card">
    <div class="card-body">
        <div class="clearfix">

            <div class="float-left">
                <h4>Пользователь: <?php echo e($attempt->user->fullname); ?></h4>
                <h4>
                    Экзамен: <?php echo e($attempt->exam->title); ?>

                </h4>

                <hr>

                <h5>
                    <span class="text-bold-600">
                    Результат:
                    </span>
                    <span style="color: <?php echo e($attempt->rating->color); ?>;"><?php echo e($attempt->result); ?>% - <?php echo e($attempt->rating->comment); ?></span>
                </h5>

                <h5>
                    <span class="text-bold-600">
                    Попытка №
                    </span>
                    <?php echo e($attempt->attempt_number); ?>

                </h5>
                <hr>
                <h5>Данные пользователя:</h5>

                <p>
                    <span class="text-bold-600">
                    E-mail:
                    </span>
                    <?php echo e($attempt->user->email); ?>

                </p>

                <p>
                    <span class="text-bold-600">
                    Должность:
                    </span>
                    <?php echo e($attempt->user->position); ?>

                </p>

                <p>
                    <span class="text-bold-600">
                    Отдел:
                    </span>
                        <?php echo e($attempt->user->department); ?>

                </p>

                <p class="mb-0">
                    <span class="text-bold-600">
                    Подразделение:
                    </span>
                    <?php echo e($attempt->user->organisation); ?>

                </p>

            </div>

            <div class="float-right">
                <img src="<?php echo e(asset('images/kapitalbank-logo.png')); ?>" class="img-fluid" style="height: 30px" alt="image">
            </div>
        </div>

        <hr>

        <p class="text-bold-600">
            <i class="fa fa-calculator"></i>
            Общее кол-во вопросов: <?php echo e(count($attempt->tests)); ?>

        </p>

        <p class="text-bold-600">
            <i class="fa fa-calendar-check-o"></i>
            Время начала: <?php echo e($attempt->started_at); ?>

        </p>

        <p class="text-bold-600">
            <i class="fa fa-calendar-minus-o"></i>
            Время окончания: <?php echo e($attempt->finished_at); ?>

        </p>

        <p class="text-bold-600">
            <i class="fa fa-clock-o"></i>
            Потраченное время: <?php echo e($attempt->spent_time); ?> минут
        </p>

        <p class="text-success text-bold-600">
            <i class="fa fa-check-circle"></i>
            Кол-во правильных ответов:
            <?php echo e($attempt->correct_answers_count); ?></p>

        <p class="text-danger text-bold-600">
            <i class="fa fa-times-circle"></i>
            Кол-во неправильных ответов:
            <?php echo e($attempt->wrong_answers_count); ?></p>

        <p class="text-warning text-bold-600">
            <i class="fa fa-minus-circle"></i>
            Кол-во неотвеченных вопросов:
            <?php echo e($attempt->unanswered_tests_count); ?></p>
        <hr>

        <?php $__currentLoopData = $attempt->tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('shared-partials.test', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH C:\OpenServer\domains\myproject\resources\views/shared-partials/result-card.blade.php ENDPATH**/ ?>