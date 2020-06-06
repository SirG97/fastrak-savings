<?php $__env->startSection('title', 'Pins'); ?>
<?php $__env->startSection('icon', 'fa-user-plus'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav class="nav pin-nav mr-2">
                <a class="nav-link active" href="/pins">All</a>
                <a class="nav-link " href="/pins/live">Live</a>
                <a class="nav-link" href="/pins/used">Used</a>
                <a class="nav-link" href="#">Pending</a>
            </nav>
            <div class="custom-panel card py-2">
                <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                    Pins
                </div>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="trx-bg-head text-secondary py-3 px-3">
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Pin</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Generated On</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody class="table-style">
                        <?php if(!empty($pins) && count($pins) > 0): ?>
                            <?php $__currentLoopData = $pins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td scope="row">
                                    <?php echo e($pin['serial']); ?>

                                </td>
                                <td><?php echo e($pin['pin']); ?></td>
                                <td><?php echo e($pin['amount']); ?></td>
                                <td><?php echo e($pin['created_at']); ?></td>
                                <td><?php echo e($pin['status']); ?></td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="d-flex justify-content-center">No pins generated</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer py-1 mt-0 mr-3 d-flex justify-content-end">
                    <?php echo $links; ?>

                </div>

            </div>
        </div>

    </div>
    <form method="post" action="">

        <div class="g-btn-container">
            <button type="submit" class="generate-btn pull-right">Set Pins To Live</button>
        </div>
    </form>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/generated.blade.php ENDPATH**/ ?>