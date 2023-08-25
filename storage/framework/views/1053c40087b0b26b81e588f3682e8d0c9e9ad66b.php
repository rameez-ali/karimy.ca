<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('products.setting')); ?></h1>
            <p class="mb-4"><?php echo e(__('products.setting-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <form method="POST" action="<?php echo e(route('admin.settings.product.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="setting_product_auto_approval_enable" class="text-black"><?php echo e(__('products.auto-approval')); ?></label>
                                <select id="setting_product_auto_approval_enable" class="custom-select" name="setting_product_auto_approval_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_PRODUCT_AUTO_APPROVAL_DISABLED); ?>" <?php echo e($settings->setting_product_auto_approval_enable == \App\Setting::SITE_PRODUCT_AUTO_APPROVAL_DISABLED ? 'selected' : ''); ?>><?php echo e(__('products.disabled')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_PRODUCT_AUTO_APPROVAL_ENABLED); ?>" <?php echo e($settings->setting_product_auto_approval_enable == \App\Setting::SITE_PRODUCT_AUTO_APPROVAL_ENABLED ? 'selected' : ''); ?>><?php echo e(__('products.enabled')); ?></option>
                                </select>
                                <small class="form-text text-muted">
                                    <?php echo e(__('products.auto-approval-help')); ?>

                                </small>
                                <?php $__errorArgs = ['setting_product_auto_approval_enable'];
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

                            <div class="col-md-6">
                                <label for="setting_product_max_gallery_photos" class="text-black"><?php echo e(__('products.max-gallery-photos')); ?></label>
                                <input id="setting_product_max_gallery_photos" type="number" class="form-control <?php $__errorArgs = ['setting_product_max_gallery_photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_product_max_gallery_photos" value="<?php echo e($settings->setting_product_max_gallery_photos); ?>">
                                <small class="form-text text-muted">
                                    <?php echo e(__('products.max-gallery-photos-help')); ?>

                                </small>
                                <?php $__errorArgs = ['setting_product_max_gallery_photos'];
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
                                    <?php echo e(__('backend.shared.update')); ?>

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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/product/edit.blade.php ENDPATH**/ ?>