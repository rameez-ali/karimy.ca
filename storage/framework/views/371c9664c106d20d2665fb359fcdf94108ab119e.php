<?php $__env->startSection('styles'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.item.saved-item')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.item.saved-item-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('user.items.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('backend.item.add-item')); ?></span>
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
                                <th><?php echo e(__('backend.item.feature-image')); ?></th>
                                <th><?php echo e(__('backend.category.category')); ?></th>
                                <th><?php echo e(__('backend.item.title')); ?></th>
                                <th><?php echo e(__('backend.item.address')); ?></th>
                                <th><?php echo e(__('backend.city.city')); ?></th>
                                <th><?php echo e(__('backend.state.state')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php echo e(__('backend.item.feature-image')); ?></th>
                                <th><?php echo e(__('backend.category.category')); ?></th>
                                <th><?php echo e(__('backend.item.title')); ?></th>
                                <th><?php echo e(__('backend.item.address')); ?></th>
                                <th><?php echo e(__('backend.city.city')); ?></th>
                                <th><?php echo e(__('backend.state.state')); ?></th>
                                <th><?php echo e(__('backend.shared.action')); ?></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__currentLoopData = $saved_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php if(!empty($item->item_image_tiny)): ?>
                                            <img src="<?php echo e(url('storage/item/' . $item->item_image_tiny)); ?>" alt="Image" class="img-fluid rounded">
                                        <?php elseif(!empty($item->item_image)): ?>
                                            <img src="<?php echo e(url('storage/item/' . $item->item_image)); ?>" alt="Image" class="img-fluid rounded">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('backend/images/placeholder/full_item_feature_image_tiny.webp')); ?>" alt="Image" class="img-fluid rounded">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                            $item_categories = $item->allCategories()->get();
                                        ?>

                                        <?php $__currentLoopData = $item_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_categories_key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item_categories->count() == $item_categories_key + 1): ?>
                                                <?php echo e($category->category_name); ?>

                                            <?php else: ?>
                                                <?php echo e($category->category_name . ", "); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($item->item_title); ?></td>
                                    <td><?php echo e($item->item_type == \App\Item::ITEM_TYPE_REGULAR ? ($item->item_address_hide == \App\Item::ITEM_ADDR_HIDE ? '' : $item->item_address) : ''); ?></td>
                                    <td><?php echo e($item->item_type == \App\Item::ITEM_TYPE_REGULAR ? $item->city->city_name : ''); ?></td>
                                    <td><?php echo e($item->item_type == \App\Item::ITEM_TYPE_REGULAR ? $item->state->state_name : ''); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('page.item', $item->item_slug)); ?>" class="btn btn-sm btn-primary mb-1 rounded-circle" target="_blank">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a class="btn btn-sm mb-1 btn-secondary rounded-circle text-white saved-item-remove-button" id="saved-item-remove-button-<?php echo e($item->id); ?>"><i class="far fa-trash-alt"></i></a>
                                        <form id="saved-item-remove-button-<?php echo e($item->id); ?>-form" action="<?php echo e(route('user.items.unsave', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                            <?php echo csrf_field(); ?>
                                        </form>
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
        $(document).ready(function() {

            "use strict";

            $('#dataTable').DataTable();

            $('.saved-item-remove-button').on('click', function(){
                $(this).addClass("disabled");
                $("#" + $(this).attr('id') + "-form").submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/item/saved.blade.php ENDPATH**/ ?>