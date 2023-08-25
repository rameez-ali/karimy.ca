<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('product_attributes.edit')); ?></h1>
            <p class="mb-4"><?php echo e(__('product_attributes.edit-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('user.attributes.index')); ?>" class="btn btn-info btn-icon-split">
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
                <div class="col-xl-6 col-lg-10 col-sm-12">
                    <form method="POST" action="<?php echo e(route('user.attributes.update', ['attribute' => $attribute->id])); ?>" class="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="attribute_name" class="text-black"><?php echo e(__('product_attributes.form-attribute-name')); ?></label>
                                <input id="attribute_name" type="text" class="form-control <?php $__errorArgs = ['attribute_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="attribute_name" value="<?php echo e(old('attribute_name') ? old('attribute_name') : $attribute->attribute_name); ?>">
                                <?php $__errorArgs = ['attribute_name'];
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
                                <label for="attribute_type" class="text-black"><?php echo e(__('product_attributes.form-attribute-type')); ?></label>

                                <select class="custom-select" name="attribute_type">
                                    <option value="<?php echo e(\App\Attribute::TYPE_TEXT); ?>" <?php echo e((old('attribute_type') ? old('attribute_type') : $attribute->attribute_type) == \App\Attribute::TYPE_TEXT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-text')); ?></option>
                                    <option value="<?php echo e(\App\Attribute::TYPE_SELECT); ?>" <?php echo e((old('attribute_type') ? old('attribute_type') : $attribute->attribute_type) == \App\Attribute::TYPE_SELECT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-select')); ?></option>
                                    <option value="<?php echo e(\App\Attribute::TYPE_MULTI_SELECT); ?>" <?php echo e((old('attribute_type') ? old('attribute_type') : $attribute->attribute_type) == \App\Attribute::TYPE_MULTI_SELECT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-multi-select')); ?></option>
                                    <option value="<?php echo e(\App\Attribute::TYPE_LINK); ?>" <?php echo e((old('attribute_type') ? old('attribute_type') : $attribute->attribute_type) == \App\Attribute::TYPE_LINK ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-link')); ?></option>
                                </select>

                                <?php $__errorArgs = ['attribute_type'];
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
                                <label for="attribute_seed_value" class="text-black"><?php echo e(__('product_attributes.form-attribute-seed-value')); ?></label>
                                <input id="attribute_seed_value" type="text" class="form-control <?php $__errorArgs = ['attribute_seed_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="attribute_seed_value" value="<?php echo e(old('attribute_seed_value') ? old('attribute_seed_value') : $attribute->attribute_seed_value); ?>">
                                <small id="attribute_seed_valueHelpBlock" class="form-text text-muted">
                                    <?php echo e(__('product_attributes.form-attribute-seed-value-help')); ?>

                                </small>
                                <?php $__errorArgs = ['attribute_seed_value'];
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
                    <?php echo e(__('backend.shared.delete-message', ['record_type' => __('backend.shared.city'), 'record_name' => $attribute->attribute_name])); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <form action="<?php echo e(route('user.attributes.destroy', ['attribute' => $attribute->id])); ?>" method="POST">
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

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/attribute/edit.blade.php ENDPATH**/ ?>