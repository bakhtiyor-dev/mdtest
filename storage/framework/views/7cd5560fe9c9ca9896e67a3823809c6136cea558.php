<body class="vertical-layout vertical-menu-modern 2-columns" data-menu="vertical-menu-modern" data-col="2-columns">

<?php echo $__env->make('client.panels.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    
    <?php echo $__env->make('client.panels.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="content-wrapper">
        <div class="content-body">
            <div id="app">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            
        </div>
    </div>

</div>
<!-- End: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


<?php echo $__env->make('client/panels/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('client/panels/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\OpenServer\domains\myproject\resources\views/client/layouts/verticalLayoutMaster.blade.php ENDPATH**/ ?>