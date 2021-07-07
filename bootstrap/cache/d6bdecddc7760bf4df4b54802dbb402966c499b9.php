
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin :: <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body style="">

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="login-wrapper d-flex justify-content-center .align-items-center flex-column">
                <h3 class="text-center font-weight-bold text-logo">Akawo</h3>

                <div class="login-box align-items-center">
                    <?php echo $__env->make('includes/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\noble\resources\views/user/layout/auth.blade.php ENDPATH**/ ?>