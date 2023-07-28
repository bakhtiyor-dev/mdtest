
<div class="row">
    <div class="col-sm-8">
        <div class="card border">
            <div class="bg-gray p-2 text-bold-700 d-flex justify-content-between">
                <div class="d-flex mr-1">
                    <p style="margin-right: 5px;"><?php echo e($loop->iteration); ?>.</p>
                    <p><?php echo $test->body; ?></p>
                </div>

                <div>
                    <?php if(isset($test->is_answered)): ?>
                        <?php if($test->is_correct): ?>
                            <i class="fa fa-check-circle text-success font-large-1"></i>
                        <?php else: ?>
                            <i class="fa fa-times-circle text-danger font-large-1"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <?php if($test->answers_type === \App\Enums\AnswerType::TEXT_INPUT): ?>
                    <?php echo $__env->make('shared-partials.text-input-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>

                    <?php $__currentLoopData = $test->answers->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php switch($test->answers_type):
                            case (\App\Enums\AnswerType::SINGLE_CHOICE): ?>
                            <?php echo $__env->make('shared-partials.single-choice-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php break; ?>

                            <?php case (\App\Enums\AnswerType::MULTIPLE_CHOICE): ?>
                            <?php echo $__env->make('shared-partials.multiple-choice-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php break; ?>

                            <?php case (\App\Enums\AnswerType::RIGHT_ORDER): ?>
                            <?php echo $__env->make('shared-partials.right-order-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php break; ?>

                        <?php endswitch; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if(isset($test->explanation)): ?>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body border">
                    <p class="text-info text-bold-600"><i class="fa fa-info-circle"></i> Пояснение</p>
                    <?php echo $test->explanation; ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/shared-partials/test.blade.php ENDPATH**/ ?>