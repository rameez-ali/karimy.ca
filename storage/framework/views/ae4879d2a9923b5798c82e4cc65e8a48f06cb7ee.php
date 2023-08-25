<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.social-media.social-media')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.social-media.social-media-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('admin.social-medias.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('backend.social-media.add-social-media')); ?></span>
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
                                <th><?php echo e(__('backend.social-media.id')); ?></th>
                                <th><?php echo e(__('backend.social-media.name')); ?></th>
                                <th><?php echo e(__('backend.social-media.icon')); ?></th>
                                <th><?php echo e(__('backend.social-media.link')); ?></th>
                                <th><?php echo e(__('backend.social-media.order')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('backend.social-media.id')); ?></th>
                                <th><?php echo e(__('backend.social-media.name')); ?></th>
                                <th><?php echo e(__('backend.social-media.icon')); ?></th>
                                <th><?php echo e(__('backend.social-media.link')); ?></th>
                                <th><?php echo e(__('backend.social-media.order')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $all_social_medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $social_media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($social_media->id); ?></td>
                                    <td><?php echo e($social_media->social_media_name); ?></td>
                                    <td>
                                        <i class="<?php echo e($social_media->social_media_icon); ?>"></i>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo e($social_media->social_media_link); ?>">
                                            <?php echo e($social_media->social_media_link); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($social_media->social_media_order); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.social-medias.edit', $social_media->id)); ?>" class="btn btn-primary btn-circle">
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/social-media/index.blade.php ENDPATH**/ ?>