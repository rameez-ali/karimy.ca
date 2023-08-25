<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.country.country')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.country.country-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('admin.countries.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('backend.country.add-country')); ?></span>
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
                                <th><?php echo e(__('backend.country.id')); ?></th>
                                <th><?php echo e(__('backend.country.name')); ?></th>
                                <th><?php echo e(__('backend.country.abbr')); ?></th>
                                <th><?php echo e(__('backend.country.slug')); ?></th>
                                <th><?php echo e(__('setting_language.country.country-status')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('backend.country.id')); ?></th>
                                <th><?php echo e(__('backend.country.name')); ?></th>
                                <th><?php echo e(__('backend.country.abbr')); ?></th>
                                <th><?php echo e(__('backend.country.slug')); ?></th>
                                <th><?php echo e(__('setting_language.country.country-status')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $all_countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_countries_key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($country->id); ?></td>
                                    <td><?php echo e($country->country_name); ?></td>
                                    <td><?php echo e($country->country_abbr); ?></td>
                                    <td><?php echo e($country->country_slug); ?></td>
                                    <td>
                                        <?php if($country->country_status == \App\Country::COUNTRY_STATUS_ENABLE): ?>
                                            <span class="bg-success rounded text-white pl-2 pr-2 pt-1 pb-1"><?php echo e(__('setting_language.country.country-status-enable')); ?></span>
                                        <?php else: ?>
                                            <span class="bg-warning rounded text-white pl-2 pr-2 pt-1 pb-1"><?php echo e(__('setting_language.country.country-status-disable')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.countries.edit', $country->id)); ?>" class="btn btn-primary btn-circle">
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/country/index.blade.php ENDPATH**/ ?>