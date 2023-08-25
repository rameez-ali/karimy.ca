<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('product_attributes.index-user')); ?></h1>
            <p class="mb-4"><?php echo e(__('product_attributes.index-user-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('user.attributes.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('product_attributes.add-attribute')); ?></span>
            </a>
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
                            <form class="form-inline" action="<?php echo e(route('user.attributes.index')); ?>" method="GET">
                                <div class="form-group mr-2">
                                    <select class="custom-select" name="show_attributes_type">
                                        <option value="0" <?php echo e(empty($show_attributes_type) ? 'selected' : ''); ?>><?php echo e(__('product_attributes.show-all-types')); ?></option>

                                        <option value="<?php echo e(\App\Attribute::TYPE_TEXT); ?>" <?php echo e($show_attributes_type == \App\Attribute::TYPE_TEXT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-text')); ?></option>
                                        <option value="<?php echo e(\App\Attribute::TYPE_SELECT); ?>" <?php echo e($show_attributes_type == \App\Attribute::TYPE_SELECT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-select')); ?></option>
                                        <option value="<?php echo e(\App\Attribute::TYPE_MULTI_SELECT); ?>" <?php echo e($show_attributes_type == \App\Attribute::TYPE_MULTI_SELECT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-multi-select')); ?></option>
                                        <option value="<?php echo e(\App\Attribute::TYPE_LINK); ?>" <?php echo e($show_attributes_type == \App\Attribute::TYPE_LINK ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-link')); ?></option>
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
                                <th><?php echo e(__('product_attributes.attribute-name')); ?></th>
                                <th><?php echo e(__('product_attributes.attribute-type')); ?></th>
                                <th><?php echo e(__('product_attributes.attribute-seed-value')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('product_attributes.attribute-name')); ?></th>
                                <th><?php echo e(__('product_attributes.attribute-type')); ?></th>
                                <th><?php echo e(__('product_attributes.attribute-seed-value')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $all_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($attribute->attribute_name); ?></td>
                                    <td>
                                        <?php if($attribute->attribute_type == \App\Attribute::TYPE_TEXT): ?>
                                            <?php echo e(__('product_attributes.type-text')); ?>

                                        <?php elseif($attribute->attribute_type == \App\Attribute::TYPE_SELECT): ?>
                                            <?php echo e(__('product_attributes.type-select')); ?>

                                        <?php elseif($attribute->attribute_type == \App\Attribute::TYPE_MULTI_SELECT): ?>
                                            <?php echo e(__('product_attributes.type-multi-select')); ?>

                                        <?php elseif($attribute->attribute_type == \App\Attribute::TYPE_LINK): ?>
                                            <?php echo e(__('product_attributes.type-link')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($attribute->attribute_seed_value); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('user.attributes.edit', ['attribute' => $attribute->id])); ?>" class="btn btn-primary btn-circle">
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

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/attribute/index.blade.php ENDPATH**/ ?>