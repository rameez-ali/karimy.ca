<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('backend/vendor/datatables/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('role_permission.item-leads.admin-index')); ?></h1>
            <p class="mb-4"><?php echo e(__('role_permission.item-leads.admin-index-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('user.item-leads.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('role_permission.item-leads.add-a-lead')); ?></span>
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
                                <th><?php echo e(__('backend.city.id')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.listing')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-name')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-email')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-phone')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-subject')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-message')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-received-at')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('backend.city.id')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.listing')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-name')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-email')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-phone')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-subject')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-message')); ?></th>
                                <th><?php echo e(__('role_permission.item-leads.item-lead-received-at')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $all_item_leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_item_leads_key => $item_lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item_lead->id); ?></td>
                                    <td><?php echo e($item_lead->item->item_title); ?></td>
                                    <td><?php echo e($item_lead->item_lead_name); ?></td>
                                    <td><?php echo e($item_lead->item_lead_email); ?></td>
                                    <td><?php echo e($item_lead->item_lead_phone); ?></td>
                                    <td><?php echo e($item_lead->item_lead_subject); ?></td>
                                    <td><?php echo e($item_lead->item_lead_message); ?></td>
                                    <td><?php echo e($item_lead->created_at->diffForHumans()); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('user.item-leads.edit', ['item_lead' => $item_lead])); ?>" class="btn btn-primary btn-circle">
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
    <script src="<?php echo e(asset('backend/vendor/datatables/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datatables/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datatables/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datatables/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datatables/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datatables/buttons.print.min.js')); ?>"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {

            "use strict";

            $('#dataTable').DataTable({
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    },
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/item/item-lead/index.blade.php ENDPATH**/ ?>