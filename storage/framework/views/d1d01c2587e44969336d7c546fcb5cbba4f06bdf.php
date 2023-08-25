<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('review.backend.manage-reviews')); ?></h1>
            <p class="mb-4"><?php echo e(__('review.backend.manage-reviews-desc')); ?></p>
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
                            <form class="form-inline" action="<?php echo e(route('admin.items.reviews.index')); ?>" method="GET">
                                <div class="form-group mr-2">
                                    <select class="custom-select" name="reviews_type">
                                        <option value="all" <?php echo e(($reviews_type == 'all' || empty($reviews_type)) ? 'selected' : ''); ?>><?php echo e(__('review.backend.all-reviews')); ?></option>
                                        <option value="pending" <?php echo e($reviews_type == 'pending' ? 'selected' : ''); ?>><?php echo e(__('review.backend.review-pending')); ?></option>
                                        <option value="approved" <?php echo e($reviews_type == 'approved' ? 'selected' : ''); ?>><?php echo e(__('review.backend.review-approved')); ?></option>
                                        <option value="me" <?php echo e($reviews_type == 'me' ? 'selected' : ''); ?>><?php echo e(__('review.backend.my-reviews')); ?></option>
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
                                <th><?php echo e(__('review.backend.id')); ?></th>
                                <th><?php echo e(__('review.backend.overall-rating')); ?></th>
                                <th><?php echo e(__('review.backend.title')); ?></th>
                                <th><?php echo e(__('review.backend.description')); ?></th>
                                <th><?php echo e(__('review.backend.status')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('review.backend.id')); ?></th>
                                <th><?php echo e(__('review.backend.overall-rating')); ?></th>
                                <th><?php echo e(__('review.backend.description')); ?></th>
                                <th><?php echo e(__('review.backend.status')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($review->id); ?></td>
                                    <td><?php echo e($review->rating); ?></td>
                                    <td><?php echo e(str_limit($review->body, 100)); ?></td>
                                    <td>
                                        <?php if($review->approved == \App\Item::ITEM_REVIEW_APPROVED): ?>

                                            <span class="text-success"><?php echo e(__('review.backend.review-approved')); ?></span>
                                        <?php else: ?>

                                            <span class="text-warning"><?php echo e(__('review.backend.review-pending')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.items.reviews.show', ['review_id' => $review->id])); ?>" class="btn btn-sm btn-outline-primary mb-1">
                                            <?php echo e(__('review.backend.view')); ?>

                                        </a>
                                        <?php if($review->author_id == Auth::user()->id): ?>
                                            <a href="<?php echo e(route('admin.items.reviews.edit', ['item_slug' => \App\Item::find($review->reviewrateable_id)->item_slug,'review' => $review->id])); ?>" class="btn btn-sm btn-primary mb-1">
                                                <?php echo e(__('backend.shared.edit')); ?>

                                            </a>
                                        <?php endif; ?>
                                        <?php if($review->approved == \App\Item::ITEM_REVIEW_APPROVED): ?>
                                            <form action="<?php echo e(route('admin.items.reviews.disapprove', ['review_id' => $review->id])); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" class="btn btn-sm btn-warning mb-1"><?php echo e(__('backend.shared.disapprove')); ?></button>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('admin.items.reviews.approve', ['review_id' => $review->id])); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" class="btn btn-sm btn-success mb-1"><?php echo e(__('backend.shared.approve')); ?></button>
                                            </form>
                                        <?php endif; ?>
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/item/review/index.blade.php ENDPATH**/ ?>