<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('backend/vendor/bootstrap-select/bootstrap-select.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('setting_language.language.language-setting')); ?></h1>
            <p class="mb-4"><?php echo e(__('setting_language.language.language-setting-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <form method="POST" action="<?php echo e(route('admin.settings.language.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <div class="row form-group align-items-center">
                            <div class="col-12 col-xl-2">
                                <label class="text-black" for="setting_language_default_language"><?php echo e(__('theme_directory_hub.setting.default-language')); ?></label>
                                <select class="selectpicker form-control <?php $__errorArgs = ['setting_language_default_language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_language_default_language" data-live-search="true">
                                    <option value=""><?php echo e(__('backend.setting.language.select-language')); ?></option>

                                    <?php $__currentLoopData = \App\Setting::LANGUAGES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting_languages_key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($setting_languages_key); ?>" <?php echo e($settings->settingLanguage->setting_language_default_language == $setting_languages_key ? 'selected' : ''); ?>>
                                            <?php echo e(__('prefer_languages.' . $setting_languages_key)); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                                <small class="form-text text-muted">
                                    <?php echo e(__('theme_directory_hub.setting.default-language-help')); ?>

                                </small>
                                <?php $__errorArgs = ['setting_language_default_language'];
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

                            <div class="col-12 mt-3 mt-xl-0 col-xl-10">

                                <div class="row">
                                    <div class="col-12">
                                        <label class="text-black"><?php echo e(__('setting_language.language.available-website-languages')); ?></label>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('setting_language.language.available-website-languages-help')); ?>

                                        </small>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <?php $__currentLoopData = \App\Setting::LANGUAGES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting_languages_key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="form-check form-check-inline">
                                                <?php if(old('setting_languages')): ?>
                                                    <input name="setting_languages[]" class="form-check-input" type="checkbox" id="setting_languages_<?php echo e($setting_languages_key); ?>" value="<?php echo e($setting_languages_key); ?>" <?php echo e(in_array($setting_languages_key, (old('setting_languages') ? old('setting_languages') : array()) ) ? 'checked' : ''); ?>>
                                                <?php else: ?>
                                                    <input name="setting_languages[]" class="form-check-input" type="checkbox" id="setting_languages_<?php echo e($setting_languages_key); ?>" value="<?php echo e($setting_languages_key); ?>" <?php echo e($settings->settingLanguage->$language == \App\SettingLanguage::LANGUAGE_ENABLE  ? 'checked' : ''); ?>>
                                                <?php endif; ?>
                                                <label class="form-check-label" for="setting_languages_<?php echo e($setting_languages_key); ?>"><?php echo e(__('prefer_languages.' . $setting_languages_key)); ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <script src="<?php echo e(asset('backend/vendor/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <?php echo $__env->make('backend.admin.partials.bootstrap-select-locale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/language/edit.blade.php ENDPATH**/ ?>