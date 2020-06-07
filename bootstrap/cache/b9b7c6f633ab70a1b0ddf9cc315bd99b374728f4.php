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
                            Daily contribution
                        </div>
                        <div id="canvas-container" class="cool-border">
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
                                <th scope="col">Status</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-times-circle text-danger"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fas fa-fw fa-check-circle text-success"></i></th>
                                <td>Payments from adaku@mail.com</td>
                                <td>USD3000</td>
                                <td>4 days ago</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-primary mb-1 py-3 px-3">
                        Messages
                    </div>
                    <table class="table">

                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Subject</h6>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-0">Donec id elit non mi....</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Subject</h6>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-0">Donec id elit non mi....</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Subject</h6>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-0">Donec id elit non mi....</p>
                            </a>
                        </div>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/dashboard.blade.php ENDPATH**/ ?>