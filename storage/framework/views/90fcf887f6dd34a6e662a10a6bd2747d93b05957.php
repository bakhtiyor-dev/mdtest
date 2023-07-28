<div class="d-flex justify-content-between pl-2">
    <div class="d-flex">
        <input type="radio" class="form-check-input" disabled
               <?php if(isset($test->is_answered)): ?>
                    <?php if($answer->id === $test->selected_id): ?>
                        checked
                    <?php endif; ?>
                <?php endif; ?>>
        <?php echo $answer->answer; ?>

    </div>
    <div>
        <?php if(isset($test->is_answered)): ?>
            <?php if($answer->id === $test->selected_id): ?>
                <?php if($test->is_correct): ?>
                    <i class="fa fa-check-circle text-success"></i>
                <?php else: ?>
                    <i class="fa fa-times-circle text-danger"></i>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>

<hr><?php /**PATH C:\OpenServer\domains\myproject\resources\views/shared-partials/single-choice-card.blade.php ENDPATH**/ ?>