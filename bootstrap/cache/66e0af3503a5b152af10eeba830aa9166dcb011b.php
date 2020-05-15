<?php $__env->startSection('title', 'Generate Pins'); ?>
<?php $__env->startSection('icon', 'fa-user-plus'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="  flex-column">
                    <div class="login-box">
                        <?php echo $__env->make('includes/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form action="/contribute" method="POST" id="form">

                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Number</label>
                                <input type="text" class="form-control form-control-lg" value="" id="email" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Pin</label>
                                <input type="text" class="form-control form-control-lg" value="" id="password" name="pin">
                            </div>
                            <button class="btn btn-primary btn-block btn-lg" type="submit">Contribute</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/contribute.blade.php ENDPATH**/ ?>