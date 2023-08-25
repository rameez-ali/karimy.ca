<?php $__env->startSection('styles'); ?>
    <!-- searchable selector -->
    <link href="<?php echo e(asset('backend/vendor/bootstrap-select/bootstrap-select.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.subscribers_list.subscribers_list')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.subscribers_list.subscribers_list_desc')); ?></p>
        </div>
        <div class="col-3 text-right">
           
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-md-10">

                    <div class="row pb-2">
                        <div class="col-12">
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="bg-info text-white">
                                        <th><?php echo e(__('backend.subscribers_list.email')); ?></th>
                                        <th><?php echo e(__('backend.subscribers_list.active')); ?></th>
                                        <!--<th><?php echo e(__('backend.subscribers_list.action')); ?></th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $subscribers_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscribers_key => $subscribers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($subscribers->email); ?></td>
                                            <td><!--<<?php echo e($subscribers->is_active); ?>-->
                                            <?php if($subscribers->is_active === 1): ?>
                                                <span class="text-success">Active</span>
                                            <?php else: ?> 
                                             <span class="text-danger"> Non Active</span>
                                              
                                            <?php endif; ?>
                                            </td>
                                           
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            
                        </div>
                    </div>

                </div>

               

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- searchable selector -->
    <script src="<?php echo e(asset('backend/vendor/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <?php echo $__env->make('backend.admin.partials.bootstrap-select-locale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function() {
            // "use strict";
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/subscribers_list/index.blade.php ENDPATH**/ ?>