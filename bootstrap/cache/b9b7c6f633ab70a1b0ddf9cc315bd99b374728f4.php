<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('icon', 'fa-tachometer-alt'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Customers</h6>
                        <h5 class="text-right">
                            <i class="fas fa-user  float-left"></i>
                            <span>
                                <?php if(!empty($total_customer) || $total_customer !== null): ?>
                                    <?php echo e($total_customer); ?>

                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </span>
                        </h5>
                        <p class="mb-0">New customers<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Saved</h6>
                        <h5 class="text-right">
                            <i class="fas fa-award  float-left"></i>
                            <span>
                                 <?php if(!empty($total_saved) || $total_saved !== null): ?>
                                    <?php echo e($total_saved); ?>

                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </span>
                        </h5>
                        <p class="mb-0">This week<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Revenue</h6>
                        <h5 class="text-right">
                            <i class="fas fa-coins  float-left"></i>
                            <span>
                                <?php if(!empty($total_revenue) || $total_revenue !== null): ?>
                                    <?php echo e($total_revenue); ?>

                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </span>
                        </h5>
                        <p class="mb-0">This week<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card text-secondary">
                    <div class="card-body">
                        <h6 class="text-primary">Total Pins</h6>
                        <h5 class="text-right">
                            <i class="fas fa-key  float-left"></i>
                            <span>
                                <?php if(!empty($total_pins) || $total_pins !== null): ?>
                                    <?php echo e($total_pins); ?>

                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </span>
                        </h5>
                        <p class="mb-0">This week<span class="float-right">n/a</span></p>
                    </div>
                </div>
            </div>

        </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                            Daily contributions
                        </div>
                        <div id="canvas-container" class="">
                            <canvas id="contribution-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                            Latest Transactions
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead class="trx-bg-head text-secondary py-3 px-3">
                                <tr>
                                    <th scope="col">Pin</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Point</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($latest_contributions) && count($latest_contributions) > 0): ?>
                                    <?php $__currentLoopData = $latest_contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td scope="row"><?php echo e($contribution['pin']); ?></td>
                                            <td><?php echo e($contribution['phone']); ?></td>
                                            <td><?php echo e($contribution['available_bal']); ?></td>
                                            <td><?php echo e($contribution['points']); ?></td>
                                            <td><?php echo e($contribution['created_at']->diffForHumans()); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-center">No Contributions yet</div>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-primary mb-1 py-3 px-3">
                            Used Channel
                        </div>
                        <div id="channel-container" class="cool-border px-2">
                            <canvas id="channel-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </div>

{{--        var app = <?php echo json_encode($contribution_count); ?>;--}}



<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/dashboard.blade.php ENDPATH**/ ?>