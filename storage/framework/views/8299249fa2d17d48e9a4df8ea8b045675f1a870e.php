<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendor/trumbowyg/dist/ui/trumbowyg.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.term-of-service.term-and-condition-page')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.term-of-service.term-and-condition-page-desc')); ?></p>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="<?php echo e(route('admin.settings.page.terms-condition.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <div class="row form-group">

                            <div class="col-md-4">

                                <div class="custom-control custom-checkbox">
                                    <input value="1" name="setting_page_terms_and_condition_enable" type="checkbox" class="custom-control-input" id="setting_page_terms_and_condition_enable" <?php echo e($all_page_terms_and_condition_settings->setting_page_terms_and_condition_enable == 1 ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="setting_page_terms_and_condition_enable"><?php echo e(__('backend.term-of-service.show-term-and-condition-page')); ?></label>
                                </div>
                                <?php $__errorArgs = ['setting_page_terms_and_condition_enable'];
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

                                <label class="text-black" for="setting_page_terms_and_condition"><?php echo e(__('backend.shared.page-editor')); ?></label>
                                <textarea id="setting_page_terms_and_condition" type="text" class="form-control <?php $__errorArgs = ['setting_page_terms_and_condition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_page_terms_and_condition"><?php echo e(old('setting_page_terms_and_condition') ? old('setting_page_terms_and_condition') : $all_page_terms_and_condition_settings->setting_page_terms_and_condition); ?></textarea>
                                <?php $__errorArgs = ['setting_page_terms_and_condition'];
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

                        <hr/>

                        <div class="row form-group justify-content-between">
                            <div class="col-8">
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

    <!-- Import only if you use JQuery UI with Resizable interaction -->
    <script src="<?php echo e(asset('backend/vendor/trumbowyg/dist/plugins/resizimg/resizable-resolveconflict.min.js')); ?>"></script>
    <!-- Import dependency for Resizimg. For a production setup, follow install instructions here: https://github.com/RickStrahl/jquery-resizable -->
    <script src="<?php echo e(asset('backend/vendor/jquery-resizable/dist/jquery-resizable.min.js')); ?>"></script>


    <!-- Import Trumbowyg -->
    <script src="<?php echo e(asset('backend/vendor/trumbowyg/dist/trumbowyg.min.js')); ?>"></script>

    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="<?php echo e(asset('backend/vendor/trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/vendor/trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {

            "use strict";

            $('#setting_page_terms_and_condition')
                .trumbowyg({
                    plugins: {
                        resizimg: {
                            minSize: 32,
                            step: 16,
                        }
                    },
                    btnsDef: {
                        // Create a new dropdown
                        image: {
                            dropdown: ['insertImage', 'base64'],
                            ico: 'insertImage'
                        }
                    },
                    // Redefine the button pane
                    btns: [
                        ['viewHTML'],
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['superscript', 'subscript'],
                        ['link'],
                        ['image'], // Our fresh created dropdown
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                        ['fullscreen']
                    ]
                });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/terms-and-condition/edit.blade.php ENDPATH**/ ?>