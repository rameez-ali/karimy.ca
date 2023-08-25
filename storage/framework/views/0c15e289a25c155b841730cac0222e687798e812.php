<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('item_claim.item-claim-admin')); ?></h1>
            <p class="mb-4"><?php echo e(__('item_claim.item-claim-admin-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row mb-4">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-12"><span class="text-lg"><?php echo e(__('backend.shared.data-filter')); ?></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <form class="form-inline" action="<?php echo e(route('admin.item-claims.index')); ?>" method="GET">
                                <div class="form-group mr-2">
                                    <select class="custom-select" name="item_claim_status">
                                        <option value="0"><?php echo e(__('item_claim.show-all')); ?></option>
                                        <option value="<?php echo e(\App\ItemClaim::ITEM_CLAIM_FILTER_REQUESTED); ?>" <?php echo e($item_claim_status == \App\ItemClaim::ITEM_CLAIM_FILTER_REQUESTED ? 'selected' : ''); ?>><?php echo e(__('item_claim.status-requested')); ?></option>
                                        <option value="<?php echo e(\App\ItemClaim::ITEM_CLAIM_FILTER_DISAPPROVED); ?>" <?php echo e($item_claim_status == \App\ItemClaim::ITEM_CLAIM_FILTER_DISAPPROVED ? 'selected' : ''); ?>><?php echo e(__('item_claim.status-approved')); ?></option>
                                        <option value="<?php echo e(\App\ItemClaim::ITEM_CLAIM_FILTER_APPROVED); ?>" <?php echo e($item_claim_status == \App\ItemClaim::ITEM_CLAIM_FILTER_APPROVED ? 'selected' : ''); ?>><?php echo e(__('item_claim.status-disapproved')); ?></option>
                                    </select>
                                </div>












                                <button type="submit" class="btn btn-primary mr-2"><?php echo e(__('backend.shared.update')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><?php echo e(__('item_claim.claim-id')); ?></th>
                                <th><?php echo e(__('item_claim.claim-item')); ?></th>
                                <th><?php echo e(__('item_claim.claim-user')); ?></th>
                                <th><?php echo e(__('item_claim.claim-full-name')); ?></th>
                                <th><?php echo e(__('item_claim.claim-status')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('item_claim.claim-id')); ?></th>
                                <th><?php echo e(__('item_claim.claim-item')); ?></th>
                                <th><?php echo e(__('item_claim.claim-user')); ?></th>
                                <th><?php echo e(__('item_claim.claim-full-name')); ?></th>
                                <th><?php echo e(__('item_claim.claim-status')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $all_item_claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item_claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item_claim->id); ?></td>
                                    <td><?php echo e($item_claim->item->item_title); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.users.edit', ['user' => $item_claim->user->id])); ?>">
                                            <?php echo e($item_claim->user->name); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($item_claim->item_claim_full_name); ?></td>
                                    <td>
                                        <?php if($item_claim->item_claim_status == \App\ItemClaim::ITEM_CLAIM_STATUS_REQUESTED): ?>
                                            <span class="text-warning"><?php echo e(__('item_claim.status-requested')); ?></span>
                                        <?php elseif($item_claim->item_claim_status == \App\ItemClaim::ITEM_CLAIM_STATUS_APPROVED): ?>
                                            <span class="text-success"><?php echo e(__('item_claim.status-approved')); ?></span>
                                        <?php elseif($item_claim->item_claim_status == \App\ItemClaim::ITEM_CLAIM_STATUS_DISAPPROVED): ?>
                                            <span class="text-danger"><?php echo e(__('item_claim.status-disapproved')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.item-claims.edit', $item_claim->id)); ?>" class="btn btn-primary btn-circle">
                                            <i class="fas fa-cog"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('backend/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {

            "use strict";

            $('#dataTable').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/item/item-claim/index.blade.php ENDPATH**/ ?>