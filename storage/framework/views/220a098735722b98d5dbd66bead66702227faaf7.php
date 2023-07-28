<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <link rel="shortcut icon" href="<?php echo e(url('images/logo.png')); ?>" type="image/png">

        
        <?php echo $__env->make('client/panels/styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </head>

    <body class="vertical-layout vertical-menu-modern 1-column" data-menu="vertical-menu-modern" data-col="1-column">

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-body">

                    
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
            </div>
        </div>
        <!-- End: Content-->

        
        <?php echo $__env->make('client/panels/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>
</html>
<?php /**PATH C:\OpenServer\domains\myproject\resources\views/client/layouts/fullLayoutMaster.blade.php ENDPATH**/ ?>