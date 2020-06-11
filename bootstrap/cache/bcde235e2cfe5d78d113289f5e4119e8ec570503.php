<div>
<?php if(isset($errors) && $errors != false && is_array($errors)): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error_item); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php elseif(App\Classes\Session::has('error')): ?>
    <div class="alert alert-danger  alert-dismissible" role="alert">
        <?php echo e(App\Classes\Session::flash('error')); ?>

    </div>

<?php endif; ?>


<?php if(isset($success) && !empty($success)): ?>
    <div class="alert alert-success  alert-dismissible" role="alert">
        <?php echo e($success); ?>

    </div>
<?php elseif(App\Classes\Session::has('success')): ?>
    <div class="alert alert-success  alert-dismissible" role="alert">
        <?php echo e(App\Classes\Session::flash('success')); ?>

    </div>

<?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\noble\resources\views/includes/message.blade.php ENDPATH**/ ?>