<?php $__env->startSection('content'); ?>


<div id="content" class="container h-100">
    <div class="row  h-100 justify-content-center align-items-center">
        <div class="col-8 bg-white border border-white p-5 m-5 rounded">
            <div class="row">
                <div class="col-6">
                    <img class="text-center mt-5 mx-auto d-block border-0 img-thumbnail" style="border-radius:100%"
                        src="./images/logo.png" alt="">
                    <h3 class="mt-2 text-center mb-5">Smart Hospitals</h3>
                </div>
                <div class="col-6 mt-2">
                    <form method="post" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                        <h3 class="text-center mb-5">System Login</h3>
                        <div class="form-group">

                            <input id="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> border-danger <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" style="height: 3.2rem;border-radius:1.25rem"
                                type="email" placeholder="Username" name="email" autocomplete="email" autofocus>
                                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                <span class="text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                        </div>

                        <div class="form-group">
                            <input id="password" placeholder="Password" style="height: 3.2rem;border-radius:1.25rem"
                                class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> border-danger <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="password" name="password" autocomplete="current-password">
                                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                <span class="text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            <?php if(Route::has('password.request')): ?>
                                   <br> <a class="text-decoration-none" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                <?php endif; ?>
                        </div>

                        <div class="ml-1 mb-1 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="remember">Remember Me</label>
                          </div>
                        <input class="mt-2 form-control btn border-0 btn-success" style="height: 3.2rem;" value="Login"
                            type="submit" name="">
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hospital-managment-system\resources\views/auth/login.blade.php ENDPATH**/ ?>