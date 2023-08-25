<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('advertisement.manage-ad')); ?></h1>
            <p class="mb-4"><?php echo e(__('advertisement.manage-ad-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('admin.advertisements.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('advertisement.add-ad')); ?></span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th><?php echo e(__('advertisement.ad-name')); ?></th>
                                <th><?php echo e(__('advertisement.ad-status')); ?></th>
                                <th><?php echo e(__('advertisement.ad-place')); ?></th>
                                <th><?php echo e(__('advertisement.ad-position')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('advertisement.ad-name')); ?></th>
                                <th><?php echo e(__('advertisement.ad-status')); ?></th>
                                <th><?php echo e(__('advertisement.ad-place')); ?></th>
                                <th><?php echo e(__('advertisement.ad-position')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $all_advertisements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $advertisement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($advertisement->advertisement_name); ?></td>
                                    <td>
                                        <?php if($advertisement->advertisement_status == \App\Advertisement::AD_STATUS_ENABLE): ?>
                                            <a class="btn btn-success btn-sm text-white"><?php echo e(__('advertisement.ad-status-enable')); ?></a>
                                        <?php else: ?>
                                            <a class="btn btn-warning btn-sm text-white"><?php echo e(__('advertisement.ad-status-disable')); ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_LISTING_RESULTS_PAGES): ?>
                                            <?php echo e(__('advertisement.ad-place-listing-results')); ?>

                                        <?php elseif($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_LISTING_SEARCH_PAGE): ?>
                                            <?php echo e(__('advertisement.ad-place-listing-search')); ?>

                                        <?php elseif($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_BUSINESS_LISTING_PAGE): ?>
                                            <?php echo e(__('advertisement.ad-place-business-listing')); ?>

                                        <?php elseif($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_BLOG_POSTS_PAGES): ?>
                                            <?php echo e(__('advertisement.ad-place-blog-posts')); ?>

                                        <?php elseif($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_BLOG_TOPIC_PAGES): ?>
                                            <?php echo e(__('advertisement.ad-place-blog-topic')); ?>

                                        <?php elseif($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_BLOG_TAG_PAGES): ?>
                                            <?php echo e(__('advertisement.ad-place-blog-tag')); ?>

                                        <?php elseif($advertisement->advertisement_place == \App\Advertisement::AD_PLACE_SINGLE_POST_PAGE): ?>
                                            <?php echo e(__('advertisement.ad-place-single-post')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_BREADCRUMB): ?>
                                            <?php echo e(__('advertisement.ad-position-before-breadcrumb')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_AFTER_BREADCRUMB): ?>
                                            <?php echo e(__('advertisement.ad-position-after-breadcrumb')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_CONTENT): ?>
                                            <?php echo e(__('advertisement.ad-position-before-content')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_AFTER_CONTENT): ?>
                                            <?php echo e(__('advertisement.ad-position-after-content')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_SIDEBAR_BEFORE_CONTENT): ?>
                                            <?php echo e(__('advertisement.ad-position-sidebar-before-content')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_SIDEBAR_AFTER_CONTENT): ?>
                                            <?php echo e(__('advertisement.ad-position-sidebar-after-content')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_GALLERY): ?>
                                            <?php echo e(__('advertisement.ad-position-before-gallery')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_DESCRIPTION): ?>
                                            <?php echo e(__('advertisement.ad-position-before-description')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_LOCATION): ?>
                                            <?php echo e(__('advertisement.ad-position-before-location')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_FEATURES): ?>
                                            <?php echo e(__('advertisement.ad-position-before-features')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_REVIEWS): ?>
                                            <?php echo e(__('advertisement.ad-position-before-reviews')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_COMMENTS): ?>
                                            <?php echo e(__('advertisement.ad-position-before-comments')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_SHARE): ?>
                                            <?php echo e(__('advertisement.ad-position-before-share')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_AFTER_SHARE): ?>
                                            <?php echo e(__('advertisement.ad-position-after-share')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_FEATURE_IMAGE): ?>
                                            <?php echo e(__('advertisement.ad-position-before-feature-image')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_TITLE): ?>
                                            <?php echo e(__('advertisement.ad-position-before-title')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_BEFORE_POST_CONTENT): ?>
                                            <?php echo e(__('advertisement.ad-position-before-post-content')); ?>

                                        <?php elseif($advertisement->advertisement_position == \App\Advertisement::AD_POSITION_AFTER_POST_CONTENT): ?>
                                            <?php echo e(__('advertisement.ad-position-after-post-content')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.advertisements.edit', $advertisement->id)); ?>" class="btn btn-primary btn-circle">
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/ad/index.blade.php ENDPATH**/ ?>