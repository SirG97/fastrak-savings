<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('icon', 'fa-users'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="searchbox mt-0 mr-0">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" id="search" placeholder="Search customers" style="border:0;">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $__env->make('includes/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Customers
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="trx-bg-head text-secondary py-3 px-3">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Daily Amount</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-style">

                            <?php if(!empty($customers) && count($customers) > 0): ?>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr>
                                    <td scope="row">
                                        <?php if($customer['status'] === 1): ?>
                                            <i class="fas fa-fw fa-check-circle text-success"></i>
                                        <?php else: ?>
                                            <i class="fas fa-fw fa-exclamation-triangle text-warning"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($customer['firstname']); ?></td>
                                    <td><?php echo e($customer['surname']); ?></td>
                                    <td><?php echo e($customer['phone']); ?></td>
                                    <td><?php echo e($customer['email']); ?></td>
                                    <td><?php echo e($customer['amount']); ?></td>
                                    <td class="table-action d-flex flex-nowrap"><i class="fas fa-fw fa-eye text-success" title="View customer details"></i> &nbsp; &nbsp;
                                        <i class="fas fa-fw fa-edit text-primary" title="Edit customer details"></i> &nbsp; &nbsp;
                                        <i class="fas fa-fw fa-trash text-danger" title="Delete customer details"></i>
                                    </td>


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
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/customers.blade.php ENDPATH**/ ?>