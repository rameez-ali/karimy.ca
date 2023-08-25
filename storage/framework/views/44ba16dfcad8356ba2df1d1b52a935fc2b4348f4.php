<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('product_attributes.create')); ?></h1>
            <p class="mb-4"><?php echo e(__('product_attributes.create-desc')); ?></p>
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
                    <form method="POST" action="<?php echo e(route('user.attributes.store')); ?>" class="">
                        <?php echo csrf_field(); ?>

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
unset($__errorArgs, $__bag); ?>" name="attribute_name" value="<?php echo e(old('attribute_name')); ?>">
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
                                    <option value="<?php echo e(\App\Attribute::TYPE_TEXT); ?>" <?php echo e(old('attribute_type') == \App\Attribute::TYPE_TEXT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-text')); ?></option>
                                    <option value="<?php echo e(\App\Attribute::TYPE_SELECT); ?>" <?php echo e(old('attribute_type') == \App\Attribute::TYPE_SELECT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-select')); ?></option>
                                    <option value="<?php echo e(\App\Attribute::TYPE_MULTI_SELECT); ?>" <?php echo e(old('attribute_type') == \App\Attribute::TYPE_MULTI_SELECT ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-multi-select')); ?></option>
                                    <option value="<?php echo e(\App\Attribute::TYPE_LINK); ?>" <?php echo e(old('attribute_type') == \App\Attribute::TYPE_LINK ? 'selected' : ''); ?>><?php echo e(__('product_attributes.type-link')); ?></option>
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
unset($__errorArgs, $__bag); ?>" name="attribute_seed_value" value="<?php echo e(old('attribute_seed_value')); ?>">
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

                        <div class="row form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success py-2 px-4 text-white">
                                    <?php echo e(__('backend.shared.create')); ?>

                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/attribute/create.blade.php ENDPATH**/ ?>