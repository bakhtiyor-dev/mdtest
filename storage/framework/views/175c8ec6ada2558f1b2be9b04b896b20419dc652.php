<div class="d-flex justify-content-between pl-2">

    <div class="d-flex">
        <input type="checkbox" class="form-check-input" disabled
        <?php if(isset($test->is_answered)): ?>
            <?php if(in_array($answer->id, $test->selected_ids)): ?>
                checked
            <?php endif; ?>
        <?php endif; ?>>
        <?php echo $answer->answer; ?>

    </div>

    <div>
        <?php if(isset($test->is_answered)): ?>
            <?php if(in_array($answer->id, $test->selected_ids)): ?>
                <?php if($test->is_correct): ?>
                    <i class="fa fa-check-circle text-success"></i>
                <?php else: ?>
                    <i class="fa fa-times-circle text-danger"></i>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>

<hr><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/shared-partials/multiple-choice-card.blade.php ENDPATH**/ ?>