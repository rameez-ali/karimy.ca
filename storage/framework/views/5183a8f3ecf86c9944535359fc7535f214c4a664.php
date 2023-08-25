<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.subscription.edit-subscription')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.subscription.edit-subscription-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="btn btn-info btn-icon-split">
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
                <div class="col-12 col-md-8 col-lg-6">
                    <form method="POST" action="<?php echo e(route('admin.subscriptions.update', $subscription->id)); ?>" class="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <span><?php echo e(__('backend.subscription.subscription-for')); ?>: </span>
                                <span class="text-gray-800"><?php echo e($subscription->user->name); ?></span><br/>
                                <span><?php echo e(__('backend.subscription.started-at')); ?>: </span>
                                <span class="text-gray-800"><?php echo e($subscription->subscription_start_date); ?></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="plan_id" class="text-black"><?php echo e(__('backend.plan.plan')); ?></label>

                                <select class="custom-select" name="plan_id">

                                    <?php $__currentLoopData = $all_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($plan->id); ?>" <?php echo e((old('plan_id') ? old('plan_id') : $subscription->plan_id) == $plan->id ? 'selected' : ''); ?>>
                                            <?php echo e($plan->plan_type == \App\Plan::PLAN_TYPE_FREE ? __('theme_directory_hub.plan.free-plan') : __('theme_directory_hub.plan.paid-plan')); ?> |
                                            <?php echo e($plan->plan_name); ?>

                                            |
                                            <?php if($plan->plan_period == \App\Plan::PLAN_LIFETIME): ?>
                                                <?php echo e($plan->plan_price); ?>/<?php echo e(__('backend.plan.lifetime')); ?>

                                            <?php elseif($plan->plan_period == \App\Plan::PLAN_MONTHLY): ?>
                                                <?php echo e($plan->plan_price); ?>/<?php echo e(__('backend.plan.monthly')); ?>

                                            <?php elseif($plan->plan_period == \App\Plan::PLAN_QUARTERLY): ?>
                                                <?php echo e($plan->plan_price); ?>/<?php echo e(__('backend.plan.quarterly')); ?>

                                            <?php elseif($plan->plan_period == \App\Plan::PLAN_YEARLY): ?>
                                                <?php echo e($plan->plan_price); ?>/<?php echo e(__('backend.plan.yearly')); ?>

                                            <?php endif; ?>
                                            |
                                            <?php echo e(is_null($plan->plan_max_free_listing) ? __('theme_directory_hub.plan.unlimited') . ' ' . __('theme_directory_hub.plan.free-listing') : $plan->plan_max_free_listing . ' ' . __('theme_directory_hub.plan.free-listing')); ?>

                                            |
                                            <?php echo e(is_null($plan->plan_max_featured_listing) ? __('theme_directory_hub.plan.unlimited') . ' ' . __('theme_directory_hub.plan.featured-listing') : $plan->plan_max_featured_listing . ' ' . __('theme_directory_hub.plan.featured-listing')); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                                <?php $__errorArgs = ['plan_id'];
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
                                <label for="subscription_end_date" class="text-black"><?php echo e(__('backend.subscription.end-at')); ?></label>
                                <input id="subscription_end_date" type="text" class="form-control <?php $__errorArgs = ['subscription_end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="subscription_end_date" value="<?php echo e(old('subscription_end_date') ? old('subscription_end_date') : $subscription->subscription_end_date); ?>" aria-describedby="subscription_end_dateHelpBlock">
                                <small id="subscription_end_dateHelpBlock" class="form-text text-muted">
                                    <?php echo e(__('theme_directory_hub.plan.subscription-edn-date-help')); ?>

                                </small>
                                <?php $__errorArgs = ['subscription_end_date'];
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/subscription/edit.blade.php ENDPATH**/ ?>