<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('item_claim.item-claim-edit-user')); ?></h1>
            <p class="mb-4"><?php echo e(__('item_claim.item-claim-edit-user-desc')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('user.item-claims.index')); ?>" class="btn btn-info btn-icon-split">
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
            <div class="row mb-5">
                <div class="col-3">
                    <?php if(empty($item->item_image)): ?>
                        <img id="image_preview" src="<?php echo e(asset('backend/images/placeholder/full_item_feature_image.webp')); ?>" class="img-responsive rounded">
                    <?php else: ?>
                        <img id="image_preview" src="<?php echo e(url('storage/item/'. $item->item_image)); ?>" class="img-responsive rounded">
                    <?php endif; ?>

                        <a target="_blank" href="<?php echo e(route('page.item', $item->item_slug)); ?>" class="btn btn-primary btn-block mt-2"><?php echo e(__('backend.message.view-listing')); ?></a>

                </div>
                <div class="col-9">
                    <p>
                        <?php $__currentLoopData = $item->allCategories()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="bg-info rounded text-white pl-2 pr-2 pt-1 pb-1 mr-1">
                                <?php echo e($category->category_name); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <h1 class="h4 mb-2 text-gray-800"><?php echo e($item->item_title); ?></h1>
                    <?php if($item_has_claimed): ?>
                        <p>
                            <i class="fas fa-check-circle"></i>
                            <?php echo e(__('item_claim.item-claimed-by') . " " . $item_claimed_user->name); ?>

                        </p>
                    <?php else: ?>
                        <p>
                            <i class="fas fa-question-circle"></i>
                            <?php echo e(__('item_claim.unclaimed') . ", " . __('item_claim.item-posted-by') . " " . $item->user->name); ?>

                        </p>
                    <?php endif; ?>
                    <p>
                        <?php if($item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                        <?php echo e($item->item_address_hide == \App\Item::ITEM_ADDR_NOT_HIDE ? $item->item_address . ', ' : ''); ?> <?php echo e($item->city->city_name . ', ' . $item->state->state_name . ' ' . $item->item_postal_code); ?>

                        <?php else: ?>
                            <span class="bg-primary text-white pl-1 pr-1 rounded"><?php echo e(__('theme_directory_hub.online-listing.online-listing')); ?></span>
                        <?php endif; ?>
                    </p>
                    <hr/>
                    <p><?php echo e($item->item_description); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <span class="text-gray-800"><?php echo e(__('item_claim.claim-status')); ?>:</span>
                            <?php if($item_claim->item_claim_status == \App\ItemClaim::ITEM_CLAIM_STATUS_REQUESTED): ?>
                                <span class="text-warning"><?php echo e(__('item_claim.status-requested')); ?></span>
                            <?php elseif($item_claim->item_claim_status == \App\ItemClaim::ITEM_CLAIM_STATUS_DISAPPROVED): ?>
                                <span class="text-danger"><?php echo e(__('item_claim.status-disapproved')); ?></span>
                            <?php elseif($item_claim->item_claim_status == \App\ItemClaim::ITEM_CLAIM_STATUS_APPROVED): ?>
                                <span class="text-success"><?php echo e(__('item_claim.status-approved')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if(!empty($item_claim->item_claim_reply)): ?>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <span class="text-gray-800"><?php echo e(__('item_claim.admin-feedback')); ?>:</span>
                            <span><?php echo e($item_claim->item_claim_reply); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($item_claim->item_claim_additional_upload)): ?>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <span class="text-gray-800"><?php echo e(__('item_claim.document-uploaded')); ?>:</span>
                                <?php echo e($item_claim->item_claim_additional_upload); ?>

                                <a class="btn btn-primary btn-sm" href="./../../../storage/item_claim_doc/<?php echo e($item_claim->item_claim_additional_upload); ?>" download>Download</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <hr>

                    <form method="POST" action="<?php echo e(route('user.item-claims.update', ['item_claim' => $item_claim])); ?>" class="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label for="item_claim_full_name" class="text-black"><?php echo e(__('item_claim.claim-full-name')); ?></label>
                                <input id="item_claim_full_name" type="text" class="form-control <?php $__errorArgs = ['item_claim_full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_claim_full_name" value="<?php echo e(old('item_claim_full_name') ? old('item_claim_full_name') : $item_claim->item_claim_full_name); ?>">
                                <?php $__errorArgs = ['item_claim_full_name'];
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

                        <div class="form-row mb-3">

                            <div class="col-md-6">
                                <label for="item_claim_phone" class="text-black"><?php echo e(__('item_claim.claim-phone')); ?></label>
                                <input id="item_claim_phone" type="text" class="form-control <?php $__errorArgs = ['item_claim_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_claim_phone" value="<?php echo e(old('item_claim_phone') ? old('item_claim_phone') : $item_claim->item_claim_phone); ?>">
                                <?php $__errorArgs = ['item_claim_phone'];
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
                                <label for="item_claim_email" class="text-black"><?php echo e(__('item_claim.claim-email')); ?></label>
                                <input id="item_claim_email" type="text" class="form-control <?php $__errorArgs = ['item_claim_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_claim_email" value="<?php echo e(old('item_claim_email') ? old('item_claim_email') : $item_claim->item_claim_email); ?>">
                                <?php $__errorArgs = ['item_claim_email'];
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

                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label class="text-black" for="item_claim_additional_proof"><?php echo e(__('item_claim.claim-additional-proof')); ?></label>
                                <textarea rows="6" id="item_claim_additional_proof" type="text" class="form-control <?php $__errorArgs = ['item_claim_additional_proof'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_claim_additional_proof"><?php echo e(old('item_claim_additional_proof') ? old('item_claim_additional_proof') : $item_claim->item_claim_additional_proof); ?></textarea>
                                <small class="text-muted">
                                    <?php echo e(__('item_claim.claim-additional-proof-help')); ?>

                                </small>
                                <?php $__errorArgs = ['item_claim_additional_proof'];
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

                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label class="text-black" for="item_claim_additional_upload"><?php echo e(__('item_claim.claim-additional-doc')); ?></label>
                                <input id="item_claim_additional_upload" type="file" class="form-control <?php $__errorArgs = ['item_claim_additional_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_claim_additional_upload">
                                <small class="form-text text-muted">
                                    <?php echo e(__('item_claim.claim-additional-doc-help')); ?>

                                </small>
                                <?php $__errorArgs = ['item_claim_additional_upload'];
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
                                    <?php echo e(__('item_claim.update-claim-request')); ?>

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
                    <p><?php echo e(__('item_claim.delete-claim')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <form action="<?php echo e(route('user.item-claims.destroy', ['item_claim' => $item_claim])); ?>" method="POST">
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
    <script>
        $(document).ready(function() {

            "use strict";

            $('#item_claim_additional_upload_download').on('click', function(){
                $('#item_claim_additional_upload_download_form').submit();
                $("form :submit").attr("disabled", false);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/item/item-claim/edit.blade.php ENDPATH**/ ?>