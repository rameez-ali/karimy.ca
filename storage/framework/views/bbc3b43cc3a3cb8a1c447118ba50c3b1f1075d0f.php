<form action="<?php echo e(route('page.search')); ?>">
    <div class="mb-2">
        <h3 class="h5 text-black mb-3">
            <?php echo e(__('frontend.search.title-search')); ?>

        </h3>
        <div class="form-group">
            <input name="search_query" type="text" class="form-control rounded <?php $__errorArgs = ['search_query'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('search_query')); ?>" placeholder="<?php echo e(__('frontend.search.what-are-you-looking-for')); ?>">
            <?php $__errorArgs = ['search_query'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-tooltip invalid-tooltip-side-search-query">
                <?php echo e($message); ?>

            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="mb-5">
        <input type="submit" class="btn btn-primary btn-block rounded text-white" value="<?php echo e(__('frontend.search.search')); ?>">
    </div>
</form>
<?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/frontend/partials/search/side.blade.php ENDPATH**/ ?>