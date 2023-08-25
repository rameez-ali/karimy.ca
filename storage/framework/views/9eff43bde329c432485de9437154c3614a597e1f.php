<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.custom-field.edit-custom-field')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.custom-field.edit-custom-field-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('admin.custom-fields.index')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text"><?php echo e(__('backend.shared.back')); ?></span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6">
                    <form method="POST" action="<?php echo e(route('admin.custom-fields.update', $customField)); ?>" class="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="custom_field_name" class="text-black"><?php echo e(__('backend.custom-field.custom-field-name')); ?></label>
                                <input id="custom_field_name" type="text" class="form-control <?php $__errorArgs = ['custom_field_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="custom_field_name" value="<?php echo e(old('custom_field_name') ? old('custom_field_name') : $customField->custom_field_name); ?>" autofocus>
                                <?php $__errorArgs = ['custom_field_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-tooltip">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="custom_field_type"><?php echo e(__('backend.custom-field.custom-field-type')); ?></label>

                                <select class="custom-select" name="custom_field_type">
                                    <option value="<?php echo e(\App\CustomField::TYPE_TEXT); ?>" <?php echo e((old('custom_field_type') ? old('custom_field_type') : $customField->custom_field_type) == \App\CustomField::TYPE_TEXT ? 'selected' : ''); ?>><?php echo e(__('backend.custom-field.text')); ?></option>
                                    <option value="<?php echo e(\App\CustomField::TYPE_SELECT); ?>" <?php echo e((old('custom_field_type') ? old('custom_field_type') : $customField->custom_field_type) == \App\CustomField::TYPE_SELECT ? 'selected' : ''); ?>><?php echo e(__('backend.custom-field.select')); ?></option>
                                    <option value="<?php echo e(\App\CustomField::TYPE_MULTI_SELECT); ?>" <?php echo e((old('custom_field_type') ? old('custom_field_type') : $customField->custom_field_type) == \App\CustomField::TYPE_MULTI_SELECT ? 'selected' : ''); ?>><?php echo e(__('backend.custom-field.multi-select')); ?></option>
                                    <option value="<?php echo e(\App\CustomField::TYPE_LINK); ?>" <?php echo e((old('custom_field_type') ? old('custom_field_type') : $customField->custom_field_type) == \App\CustomField::TYPE_LINK ? 'selected' : ''); ?>><?php echo e(__('backend.custom-field.link')); ?></option>
                                </select>
                                <?php $__errorArgs = ['custom_field_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-tooltip">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="custom_field_seed_value"><?php echo e(__('backend.custom-field.custom-field-seed-value')); ?></label>
                                <input id="custom_field_seed_value" type="text" class="form-control <?php $__errorArgs = ['custom_field_seed_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="custom_field_seed_value" value="<?php echo e(old('custom_field_seed_value') ? old('custom_field_seed_value') : $customField->custom_field_seed_value); ?>" aria-describedby="seedValueHelpBlock">
                                <small id="seedValueHelpBlock" class="form-text text-muted">
                                    <?php echo e(__('backend.custom-field.custom-field-seed-value-help')); ?>

                                </small>
                                <?php $__errorArgs = ['custom_field_seed_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-tooltip">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="custom_field_order"><?php echo e(__('backend.custom-field.custom-field-order')); ?></label>
                                <input id="custom_field_order" type="number" min="0" class="form-control <?php $__errorArgs = ['custom_field_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="custom_field_order" value="<?php echo e(old('custom_field_order') ? old('custom_field_order') : $customField->custom_field_order); ?>">
                                <?php $__errorArgs = ['custom_field_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-tooltip">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">

                                <label for="category" class="text-black"><?php echo e(__('backend.custom-field.categories')); ?></label>
                                <select multiple class="custom-select" name="category[]" id="category" size="<?php echo e(count($all_categories)); ?>">
                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e((in_array($category['category_id'], old('category') ? old('category') : array()) || $customField->isBelongToCategory($category['category_id'])) ? 'selected' : ''); ?> value="<?php echo e($category['category_id']); ?>"><?php echo e($category['category_name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-tooltip">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>

                        </div>

                        <div class="row form-group justify-content-between">
                            <div class="col-8">
                                <button type="submit" class="btn btn-success text-white">
                                    <?php echo e(__('backend.shared.update')); ?>

                                </button>
                            </div>
                            <div class="col-4 text-right">
                                <a class="text-danger" href="#" data-toggle="modal" data-target="#deleteModal">
                                    <?php echo e(__('backend.shared.delete')); ?>

                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('backend.shared.delete-confirm')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo e(__('delete_custom_field.delete-custom-field-warning') . ' ' . __('backend.shared.delete-message', ['record_type' => __('backend.shared.custom-field'), 'record_name' => $customField->custom_field_name])); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <form action="<?php echo e(route('admin.custom-fields.destroy', $customField)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"><?php echo e(__('backend.shared.delete')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/custom-field/edit.blade.php ENDPATH**/ ?>