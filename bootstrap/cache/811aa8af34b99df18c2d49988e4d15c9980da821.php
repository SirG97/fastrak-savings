<?php $__env->startSection('title', 'Contributions'); ?>
<?php $__env->startSection('icon', 'fa-coins'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="searchbox mt-0 mr-0">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" id="search-contribution" placeholder="Search Contributions" style="border:0;">
                    </div>
                    <div class="search-result">
                        <ul class="list-group list-group-flush" id="search-result-list">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Latest Contributions
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="trx-bg-head text-secondary py-3 px-3">
                            <tr>
                                <th scope="col">Pin</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Ledger balance</th>
                                <th scope="col">Available balance</th>
                                <th scope="col">Cycle</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($contributions) && count($contributions) > 0): ?>
                                    <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td scope="row"><?php echo e($contribution['pin']); ?></td>
                                        <td><?php echo e($contribution['phone']); ?></td>
                                        <td><?php echo e($contribution['ledger_bal']); ?></td>
                                        <td><?php echo e($contribution['available_bal']); ?></td>
                                        <td><?php echo e($contribution['points']); ?></td>
                                        <td><?php echo e($contribution['created_at']); ?></td>
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

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/contributions.blade.php ENDPATH**/ ?>