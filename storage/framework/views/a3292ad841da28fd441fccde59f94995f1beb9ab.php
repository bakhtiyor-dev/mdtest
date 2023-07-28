<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	
    <title><?php echo $__env->yieldContent('title', 'Kapitalbank'); ?> - <?php echo e(trans('brackets/admin-ui::admin.page_title_suffix')); ?></title>

    <link rel="shortcut icon" href="<?php echo e(url('images/plane.png')); ?>" type="image/png">

	<?php echo $__env->make('brackets/admin-ui::admin.partials.main-styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('styles'); ?>

</head>

<body class="app header-fixed sidebar-fixed sidebar-lg-show">
    <?php echo $__env->yieldContent('header'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->yieldContent('footer'); ?>

    <?php echo $__env->make('brackets/admin-ui::admin.partials.wysiwyg-svgs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('brackets/admin-ui::admin.partials.main-bottom-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('bottom-scripts'); ?>
</body>

</html><?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/vendor/brackets/admin-ui/admin/layout/master.blade.php ENDPATH**/ ?>