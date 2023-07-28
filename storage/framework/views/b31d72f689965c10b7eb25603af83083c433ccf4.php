

<?php $__env->startSection('title', 'Авторизация'); ?>

<?php $__env->startSection('page-style'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/authentication.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="row flexbox-container">
        <div class="col-xl-6 col-11 d-flex justify-content-center mx-auto p-0">
            <div class="card bg-authentication rounded-0 mb-0" style="margin-top: 100px;">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                        <div class="border-right p-2">
                            <img src="<?php echo e(asset('images/pages/login.svg')); ?>" class="img-fluid" alt="branding logo">
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 px-2 pb-4 pt-2">
                            <div class="card-header">
                                <img src="<?php echo e(asset('images/kapitalbank-logo.png')); ?>" style="height: 30px;"
                                     class="img-fluid mb-2">

                                <div class="card-title">
                                    <h4 class="mb-0">Вход в систему тестирования</h4>
                                </div>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <form method="POST" action="<?php echo e(route('login')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <label class="mb-1">Логином является "имя_пользователя@kapitalbank.uz"</label>

                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                            <input id="username" type="text"
                                                   class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   name="username" placeholder="Логин" value="<?php echo e(old('username')); ?>"
                                                   required autocomplete="username"
                                                   autofocus>

                                            <div class="form-control-position">
                                                <i class="fas fa-user-circle"></i>
                                            </div>
                                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                          <strong><?php echo e($message); ?></strong>
                                      </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </fieldset>

                                        <fieldset class="form-label-group position-relative has-icon-left">

                                            <input id="password" type="password"
                                                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   name="password" placeholder="Пароль" required>

                                            <div class="form-control-position">
                                                <i class="fas fa-key"></i>
                                            </div>
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </fieldset>

                                        <button type="submit" class="btn btn-outline-primary float-right btn-inline"><i
                                                    class="fas fa-sign-in-alt"></i> Вход
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts/fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/auth/login.blade.php ENDPATH**/ ?>