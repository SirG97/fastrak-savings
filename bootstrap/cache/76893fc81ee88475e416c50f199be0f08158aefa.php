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
                <nav class="nav nav-tabs customer-nav mr-2" id="myTab" role="tablist">
                    <a aria-controls="general" aria-selected="true" class="nav-link active" data-toggle="tab" href="#general"
                       id="general-tab" role="tab">General</a>
                    <a class="nav-link " aria-controls="contribution" aria-selected="true" class="nav-link" data-toggle="tab" href="#contribution"
                       id="contribution-tab" role="tab">Contributions</a>
                </nav>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="general">
                        <div class="custom-panel card py-2 tab-pane active">
                            <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                                Customer information
                            </div>

                            <form class="cool-border py-3 px-2">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <input type="hidden" id="customer_id"  value="" required>
                                        <input type="hidden" id="token" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                        <div class="col-md-4 mb-3">
                                            <label for="firstname">First name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo e($customer->firstname); ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="surname">Surname</label>
                                            <input type="text" class="form-control" id="surname" name="surname" value="<?php echo e($customer->surname); ?>" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email" value="<?php echo e($customer->email); ?>" aria-describedby="inputGroupPrepend3" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <label for="phone">Phone number</label>
                                            <input type="text" class="form-control"  name="phone" id="phone" value="<?php echo e($customer->phone); ?>" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" id="city" value="<?php echo e($customer->city); ?>" required>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="state">State</label>
                                            <select class="custom-select" id="state" name="state" required>
                                                <option selected value="<?php echo e($customer->state); ?>"><?php echo e($customer->state); ?></option>
                                                <option value="Delta">Delta</option>
                                                <option value="Enugu">Enugu</option>
                                                <option value="Ebonyi">Ebonyi</option>
                                                <option value="Imo">Imo</option>
                                                <option value="Abia">Abia</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <label for="amount">Daily amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">&#8358</span>
                                                </div>
                                                <input type="text" name="amount" id="amount" value="<?php echo e($customer->amount); ?>"  class="form-control" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7 mb-3">
                                            <label for="state">Address</label>
                                            <input type="text" class="form-control"  name="address" id="address" value="<?php echo e($customer->address); ?>" required>
                                        </div>

                                    </div>

                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="deleteCustomerBtn">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contribution">
                        <div class="custom-panel card py-2" >
                            <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                                Customer contributions
                            </div>
                            <div class="row cool-border-top ">
                                <div class="col-md-12">
                                    <div class="d-flex flex-column p-3 contribution-overview">
                                        <div class="d-flex justify-content-between">
                                            <div class=""><h6>Total Contribution</h6></div>
                                            <div class=""><h6><?php echo e($total_donation); ?></h6></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class=""><h6>Total Available</h6></div>
                                            <div class=""><h6><?php echo e($total_available); ?></h6></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class=""><h6>Maintenance</h6></div>
                                            <div class=""><h6><?php echo e($maintenance); ?></h6></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <?php if(!empty($contributions) && count($contributions) > 0): ?>
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
                                                <tbody class="table-style">
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
                                                </tbody>
                                            </table>

                                            <?php else: ?>
                                                <div class="table-responsive">
                                                    <table class="table table-hover ">
                                                        <thead class="trx-bg-head text-secondary py-3 px-3">
                                                        <tr>
                                                            <th scope="col">Pin</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Daily Amount</th>
                                                            <th scope="col">Balance</th>
                                                            <th scope="col">Date</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="table-style">
                                                        <td colspan="5" class="text-center">No data </td>
                                                        </tbody>
                                                    </table>
                                            <?php endif; ?>

                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\noble\resources\views/user/customerdetails.blade.php ENDPATH**/ ?>