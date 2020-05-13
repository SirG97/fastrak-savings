<?php $__env->startSection('title', 'Pins'); ?>
<?php $__env->startSection('icon', 'fa-user-plus'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
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
                                No customers yet

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

        <!-- <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="id" > -->
        <div class="g-btn-container">
            <button type="submit" class="generate-btn pull-right">Set Pins To Live</button>
        </div>
    </form>
    <div class="panel panel-success mytable">
        <!-- Default panel contents -->
        <div class="panel-heading">Generated Pins</div>

        <!-- Table -->
        <table class="table table-striped table-hover">
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </table>

        
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/generated.blade.php ENDPATH**/ ?>