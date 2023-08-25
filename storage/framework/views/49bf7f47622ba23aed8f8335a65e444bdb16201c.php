<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('maintenance_mode.maintenance-setting')); ?></h1>
            <p class="mb-4"><?php echo e(__('maintenance_mode.maintenance-setting-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <form method="POST" action="<?php echo e(route('admin.settings.maintenance.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <div class="row form-group">
                            <div class="col-12">
                                <div class="form-row">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <div class="form-check">
                                            <input <?php echo e((old('setting_site_maintenance_mode') ? old('setting_site_maintenance_mode') : $settings->setting_site_maintenance_mode) == \App\Setting::SITE_MAINTENANCE_MODE_OFF ? 'checked' : ''); ?> class="form-check-input" type="radio" name="setting_site_maintenance_mode" id="setting_site_maintenance_mode_off" value="<?php echo e(\App\Setting::SITE_MAINTENANCE_MODE_OFF); ?>" aria-describedby="setting_site_maintenance_mode_off_help">
                                            <label class="form-check-label" for="setting_site_maintenance_mode_off">
                                                <?php echo e(__('maintenance_mode.maintenance-mode-off')); ?>

                                            </label>
                                            <small id="setting_site_maintenance_mode_off_help" class="form-text text-muted">
                                                <?php echo e(__('maintenance_mode.maintenance-mode-off-help')); ?>

                                            </small>
                                            <?php $__errorArgs = ['setting_site_maintenance_mode'];
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
                                    <div class="col-12 col-md-6">
                                        <div class="form-check">
                                            <input <?php echo e((old('setting_site_maintenance_mode') ? old('setting_site_maintenance_mode') : $settings->setting_site_maintenance_mode) == \App\Setting::SITE_MAINTENANCE_MODE_ON ? 'checked' : ''); ?> class="form-check-input" type="radio" name="setting_site_maintenance_mode" id="setting_site_maintenance_mode_on" value="<?php echo e(\App\Setting::SITE_MAINTENANCE_MODE_ON); ?>" aria-describedby="setting_site_maintenance_mode_on_help">
                                            <label class="form-check-label" for="setting_site_maintenance_mode_on">
                                                <?php echo e(__('maintenance_mode.maintenance-mode-on')); ?>

                                            </label>
                                            <small id="setting_site_maintenance_mode_on_help" class="form-text text-muted">
                                                <?php echo e(__('maintenance_mode.maintenance-mode-on-help')); ?>

                                            </small>
                                            <?php $__errorArgs = ['setting_site_maintenance_mode'];
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
                                </div>
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/maintenance/edit.blade.php ENDPATH**/ ?>