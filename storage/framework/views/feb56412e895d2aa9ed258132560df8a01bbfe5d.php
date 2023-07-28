

<?php $__env->startSection('title', 'Тестирование'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container" style="max-width: 1500px">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            Внимание перезагрузка или закрытие данной страницы приведёт к завершению попытки!</p>
                        <hr>
                        <p class="text-bold-600">
                            <i class="fas fa-ab"></i> Экзамен: <?php echo e($exam->title); ?>

                        </p>

                        <p class="text-bold-600">
                            <i class="fas fa-ab"></i> Общее количество вопросов: <?php echo e($exam->tests_count); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="app">
            <div v-cloak>

                <tests :_tests="<?php echo e($exam->tests->toJson()); ?>"
                       :seconds="<?php echo e($exam->time); ?> * 60"
                       :exam="<?php echo e($exam->toJson()); ?>"
                       url="<?php echo e(route('exam.finish',[$exam,$attempt])); ?>">

                    <template v-slot:default="slotProps">
                        <form action="<?php echo e(route('exam.finish',[$exam,$attempt])); ?>" id="form" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="tests" :value="JSON.stringify(slotProps.tests)">
                        </form>
                    </template>

                </tests>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client/layouts/fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/client/attempts/start.blade.php ENDPATH**/ ?>