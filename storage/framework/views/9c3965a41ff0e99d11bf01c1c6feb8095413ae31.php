<?php $__env->startSection('styles'); ?>

    <?php if($product->productGalleries()->count() > 0): ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/justified-gallery/justifiedGallery.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/colorbox/colorbox.css')); ?>" type="text/css">
    <?php endif; ?>

    <!-- Start Google reCAPTCHA version 2 -->
    <?php if($site_global_settings->setting_site_recaptcha_item_lead_enable == \App\Setting::SITE_RECAPTCHA_ITEM_LEAD_ENABLE): ?>
        <?php echo htmlScriptTagJsApi(['lang' => empty($site_global_settings->setting_site_language) ? 'en' : $site_global_settings->setting_site_language]); ?>

    <?php endif; ?>
    <!-- End Google reCAPTCHA version 2 -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Display on xl -->
    <?php if(!empty($item->item_image) && !empty($item->item_image_blur)): ?>
        <div class="site-blocks-cover inner-page-cover overlay d-none d-xl-flex" style="background-image: url(<?php echo e(Storage::disk('public')->url('item/' . $item->item_image_blur)); ?>);">
    <?php else: ?>
        <div class="site-blocks-cover inner-page-cover overlay d-none d-xl-flex" style="background-image: url(<?php echo e(asset('frontend/images/placeholder/full_item_feature_image.webp')); ?>);">
    <?php endif; ?>
        <div class="container">
            <div class="row align-items-center item-blocks-cover">

                <div class="col-lg-2 col-md-2" data-aos="fade-up" data-aos-delay="400">
                    <?php if(!empty($item->item_image_tiny)): ?>
                        <img src="<?php echo e(Storage::disk('public')->url('item/' . $item->item_image_tiny)); ?>" alt="Image" class="img-fluid rounded">
                    <?php elseif(!empty($item->item_image)): ?>
                        <img src="<?php echo e(Storage::disk('public')->url('item/' . $item->item_image)); ?>" alt="Image" class="img-fluid rounded">
                    <?php else: ?>
                        <img src="<?php echo e(asset('frontend/images/placeholder/full_item_feature_image_tiny.webp')); ?>" alt="Image" class="img-fluid rounded">
                    <?php endif; ?>
                </div>
                <div class="col-lg-7 col-md-5" data-aos="fade-up" data-aos-delay="400">

                    <h1 class="item-cover-title-section"><?php echo e($item->item_title); ?></h1>

                    <?php if($item_has_claimed): ?>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <span class="text-primary">
                                <i class="fas fa-check-circle"></i>
                                <?php echo e(__('item_claim.claimed')); ?>

                            </span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($item_count_rating > 0): ?>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="rating_stars_header"></div>
                        </div>
                        <div class="col-md-9 pl-0">
                            <span class="item-cover-address-section">
                                <?php if($item_count_rating == 1): ?>
                                    <?php echo e('(' . $item_count_rating . ' ' . __('review.frontend.review') . ')'); ?>

                                <?php else: ?>
                                    <?php echo e('(' . $item_count_rating . ' ' . __('review.frontend.reviews') . ')'); ?>

                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php $__currentLoopData = $item_display_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="btn btn-sm btn-outline-primary rounded mb-2" href="<?php echo e(route('page.category', $item_category->category_slug)); ?>">
                        <span class="category"><?php echo e($item_category->category_name); ?></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($item_total_categories > \App\Item::ITEM_TOTAL_SHOW_CATEGORY): ?>
                        <a class="text-primary" href="#" data-toggle="modal" data-target="#showCategoriesModal">
                            <?php echo e(__('categories.and') . " " . strval($item_total_categories - \App\Item::ITEM_TOTAL_SHOW_CATEGORY) . " ". __('categories.more')); ?>

                            <i class="far fa-window-restore text-primary"></i>
                        </a>
                    <?php endif; ?>

                    <p class="item-cover-address-section">
                        <?php if($item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                            <?php if($item->item_address_hide == \App\Item::ITEM_ADDR_NOT_HIDE): ?>
                                <?php echo e($item->item_address); ?> <br>
                            <?php endif; ?>
                            <?php echo e($item->city->city_name); ?>, <?php echo e($item->state->state_name); ?> <?php echo e($item->item_postal_code); ?>

                        <?php endif; ?>
                    </p>

                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-primary rounded text-white" href="<?php echo e(route('user.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                    <?php else: ?>

                        <?php if($item->user_id != Auth::user()->id): ?>

                            <?php if(Auth::user()->isAdmin()): ?>
                                <?php if($item->reviewedByUser(Auth::user()->id)): ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('admin.items.reviews.edit', ['item_slug' => $item->item_slug, 'review' => $item->getReviewByUser(Auth::user()->id)->id])); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.edit-a-review')); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('admin.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if($item->reviewedByUser(Auth::user()->id)): ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('user.items.reviews.edit', ['item_slug' => $item->item_slug, 'review' => $item->getReviewByUser(Auth::user()->id)->id])); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.edit-a-review')); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('user.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                                <?php endif; ?>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>
                    <a class="btn btn-primary rounded text-white item-share-button"><i class="fas fa-share-alt"></i> <?php echo e(__('frontend.item.share')); ?></a>
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-primary rounded text-white" id="item-save-button-xl"><i class="far fa-bookmark"></i> <?php echo e(__('frontend.item.save')); ?></a>
                        <form id="item-save-form-xl" action="<?php echo e(route('page.item.save', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php else: ?>
                        <?php if(Auth::user()->hasSavedItem($item->id)): ?>
                            <a class="btn btn-warning rounded text-white" id="item-saved-button-xl"><i class="fas fa-check"></i> <?php echo e(__('frontend.item.saved')); ?></a>
                            <form id="item-unsave-form-xl" action="<?php echo e(route('page.item.unsave', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                <?php echo csrf_field(); ?>
                            </form>
                        <?php else: ?>
                            <a class="btn btn-primary rounded text-white" id="item-save-button-xl"><i class="far fa-bookmark"></i> <?php echo e(__('frontend.item.save')); ?></a>
                            <form id="item-save-form-xl" action="<?php echo e(route('page.item.save', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                <?php echo csrf_field(); ?>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a class="btn btn-primary rounded text-white" href="tel:<?php echo e($item->item_phone); ?>"><i class="fas fa-phone-alt"></i> <?php echo e(__('frontend.item.call')); ?></a>

                </div>
                <div class="col-lg-3 col-md-5 pl-0 pr-0 item-cover-contact-section" data-aos="fade-up" data-aos-delay="400">
                    <?php if(!empty($item->item_phone)): ?>
                        <h3><i class="fas fa-phone-alt"></i> <?php echo e($item->item_phone); ?></h3>
                    <?php endif; ?>
                    <p>
                        <?php if(!empty($item->item_website)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_website); ?>" target="_blank" rel="nofollow"><i class="fas fa-globe"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_facebook)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_facebook); ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook-square"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_twitter)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_twitter); ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter-square"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_linkedin)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_linkedin); ?>" target="_blank" rel="nofollow"><i class="fab fa-linkedin"></i></a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Display on lg, md -->
    <?php if(!empty($item->item_image) && !empty($item->item_image_blur)): ?>
        <div class="site-blocks-cover inner-page-cover overlay d-none d-md-flex d-lg-flex d-xl-none" style="background-image: url(<?php echo e(Storage::disk('public')->url('item/' . $item->item_image_blur)); ?>);">
    <?php else: ?>
        <div class="site-blocks-cover inner-page-cover overlay d-none d-md-flex d-lg-flex d-xl-none" style="background-image: url(<?php echo e(asset('frontend/images/placeholder/full_item_feature_image.webp')); ?>);">
    <?php endif; ?>
        <div class="container">
            <div class="row align-items-center item-blocks-cover">
                <div class="col-lg-2 col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <?php if(!empty($item->item_image_tiny)): ?>
                        <img src="<?php echo e(Storage::disk('public')->url('item/' . $item->item_image_tiny)); ?>" alt="Image" class="img-fluid rounded">
                    <?php elseif(!empty($item->item_image)): ?>
                        <img src="<?php echo e(Storage::disk('public')->url('item/' . $item->item_image)); ?>" alt="Image" class="img-fluid rounded">
                    <?php else: ?>
                        <img src="<?php echo e(asset('frontend/images/placeholder/full_item_feature_image_tiny.webp')); ?>" alt="Image" class="img-fluid rounded">
                    <?php endif; ?>
                </div>
                <div class="col-lg-7 col-md-9" data-aos="fade-up" data-aos-delay="400">

                    <h1 class="item-cover-title-section"><?php echo e($item->item_title); ?></h1>

                    <?php if($item_has_claimed): ?>
                        <div class="row mb-2">
                            <div class="col-md-12">
                            <span class="text-primary">
                                <i class="fas fa-check-circle"></i>
                                <?php echo e(__('item_claim.claimed')); ?>

                            </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($item_count_rating > 0): ?>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="rating_stars_header"></div>
                            </div>
                            <div class="col-md-8 pl-0">
                                <span class="item-cover-address-section">
                                    <?php if($item_count_rating == 1): ?>
                                        <?php echo e('(' . $item_count_rating . ' ' . __('review.frontend.review') . ')'); ?>

                                    <?php else: ?>
                                        <?php echo e('(' . $item_count_rating . ' ' . __('review.frontend.reviews') . ')'); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $__currentLoopData = $item_display_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="btn btn-sm btn-outline-primary rounded mb-2" href="<?php echo e(route('page.category', $item_category->category_slug)); ?>">
                            <span class="category"><?php echo e($item_category->category_name); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($item_total_categories > \App\Item::ITEM_TOTAL_SHOW_CATEGORY): ?>
                        <a class="text-primary" href="#" data-toggle="modal" data-target="#showCategoriesModal">
                            <?php echo e(__('categories.and') . " " . strval($item_total_categories - \App\Item::ITEM_TOTAL_SHOW_CATEGORY) . " ". __('categories.more')); ?>

                            <i class="far fa-window-restore text-primary"></i>
                        </a>
                    <?php endif; ?>

                    <p class="item-cover-address-section">
                        <?php if($item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                            <?php if($item->item_address_hide == \App\Item::ITEM_ADDR_NOT_HIDE): ?>
                                <?php echo e($item->item_address); ?> <br>
                            <?php endif; ?>
                            <?php echo e($item->city->city_name); ?>, <?php echo e($item->state->state_name); ?> <?php echo e($item->item_postal_code); ?>

                        <?php endif; ?>
                    </p>

                    <?php if(!empty($item->item_phone)): ?>
                        <p class="item-cover-address-section"><i class="fas fa-phone-alt"></i> <?php echo e($item->item_phone); ?></p>
                    <?php endif; ?>
                    <p class="item-cover-address-section">
                        <?php if(!empty($item->item_website)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_website); ?>" target="_blank" rel="nofollow"><i class="fas fa-globe"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_facebook)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_facebook); ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook-square"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_twitter)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_twitter); ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter-square"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_linkedin)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_linkedin); ?>" target="_blank" rel="nofollow"><i class="fab fa-linkedin"></i></a>
                        <?php endif; ?>
                    </p>

                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-primary rounded text-white" href="<?php echo e(route('user.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                    <?php else: ?>

                        <?php if($item->user_id != Auth::user()->id): ?>

                            <?php if(Auth::user()->isAdmin()): ?>
                                <?php if($item->reviewedByUser(Auth::user()->id)): ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('admin.items.reviews.edit', ['item_slug' => $item->item_slug, 'review' => $item->getReviewByUser(Auth::user()->id)->id])); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.edit-a-review')); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('admin.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if($item->reviewedByUser(Auth::user()->id)): ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('user.items.reviews.edit', ['item_slug' => $item->item_slug, 'review' => $item->getReviewByUser(Auth::user()->id)->id])); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.edit-a-review')); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-primary rounded text-white" href="<?php echo e(route('user.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                                <?php endif; ?>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>
                    <a class="btn btn-primary rounded text-white item-share-button"><i class="fas fa-share-alt"></i> <?php echo e(__('frontend.item.share')); ?></a>
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-primary rounded text-white" id="item-save-button-md"><i class="far fa-bookmark"></i> <?php echo e(__('frontend.item.save')); ?></a>
                        <form id="item-save-form-md" action="<?php echo e(route('page.item.save', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php else: ?>
                        <?php if(Auth::user()->hasSavedItem($item->id)): ?>
                            <a class="btn btn-warning rounded text-white" id="item-saved-button-md"><i class="fas fa-check"></i> <?php echo e(__('frontend.item.saved')); ?></a>
                            <form id="item-unsave-form-md" action="<?php echo e(route('page.item.unsave', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                <?php echo csrf_field(); ?>
                            </form>
                        <?php else: ?>
                            <a class="btn btn-primary rounded text-white" id="item-save-button-md"><i class="far fa-bookmark"></i> <?php echo e(__('frontend.item.save')); ?></a>
                            <form id="item-save-form-md" action="<?php echo e(route('page.item.save', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                <?php echo csrf_field(); ?>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a class="btn btn-primary rounded text-white" href="tel:<?php echo e($item->item_phone); ?>"><i class="fas fa-phone-alt"></i> <?php echo e(__('frontend.item.call')); ?></a>

                </div>
            </div>
        </div>
    </div>

    <!-- Display on sm and xs -->
    <?php if(!empty($item->item_image) && !empty($item->item_image_blur)): ?>
        <div class="site-blocks-cover site-blocks-cover-sm inner-page-cover overlay d-md-none" style="background-image: url(<?php echo e(Storage::disk('public')->url('item/' . $item->item_image_blur)); ?>);">
    <?php else: ?>
        <div class="site-blocks-cover site-blocks-cover-sm inner-page-cover overlay d-md-none" style="background-image: url(<?php echo e(asset('frontend/images/placeholder/full_item_feature_image.webp')); ?>);">
    <?php endif; ?>
        <div class="container">
            <div class="row align-items-center item-blocks-cover-sm">
                <div class="col-12" data-aos="fade-up" data-aos-delay="400">

                    <h1 class="item-cover-title-section item-cover-title-section-sm-xs"><?php echo e($item->item_title); ?></h1>

                    <?php if($item_has_claimed): ?>
                        <div class="row mb-2">
                            <div class="col-md-12">
                            <span class="text-primary">
                                <i class="fas fa-check-circle"></i>
                                <?php echo e(__('item_claim.claimed')); ?>

                            </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($item_count_rating > 0): ?>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="rating_stars_header"></div>
                            </div>
                            <div class="col-6 pl-0">
                                <span class="item-cover-address-section item-cover-address-section-sm-xs">
                                    <?php if($item_count_rating == 1): ?>
                                        <?php echo e('(' . $item_count_rating . ' ' . __('review.frontend.review') . ')'); ?>

                                    <?php else: ?>
                                        <?php echo e('(' . $item_count_rating . ' ' . __('review.frontend.reviews') . ')'); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $__currentLoopData = $item_display_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="btn btn-sm btn-outline-primary rounded mb-2" href="<?php echo e(route('page.category', $item_category->category_slug)); ?>">
                            <span class="category"><?php echo e($item_category->category_name); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($item_total_categories > \App\Item::ITEM_TOTAL_SHOW_CATEGORY): ?>
                        <a class="text-primary" href="#" data-toggle="modal" data-target="#showCategoriesModal">
                            <?php echo e(__('categories.and') . " " . strval($item_total_categories - \App\Item::ITEM_TOTAL_SHOW_CATEGORY) . " ". __('categories.more')); ?>

                            <i class="far fa-window-restore text-primary"></i>
                        </a>
                    <?php endif; ?>

                    <p class="item-cover-address-section item-cover-address-section-sm-xs">
                        <?php if($item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                            <?php if($item->item_address_hide == \App\Item::ITEM_ADDR_NOT_HIDE): ?>
                                <?php echo e($item->item_address); ?> <br>
                            <?php endif; ?>
                            <?php echo e($item->city->city_name); ?>, <?php echo e($item->state->state_name); ?> <?php echo e($item->item_postal_code); ?>

                        <?php endif; ?>
                    </p>

                    <?php if(!empty($item->item_phone)): ?>
                        <p class="item-cover-address-section item-cover-address-section-sm-xs">
                            <i class="fas fa-phone-alt"></i> <?php echo e($item->item_phone); ?>

                            <a class="btn btn-outline-primary btn-sm rounded" href="tel:<?php echo e($item->item_phone); ?>"><?php echo e(__('frontend.item.call')); ?></a>
                        </p>
                    <?php endif; ?>
                    <p class="item-cover-address-section item-cover-address-section-sm-xs">
                        <?php if(!empty($item->item_website)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_website); ?>" target="_blank" rel="nofollow"><i class="fas fa-globe"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_facebook)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_facebook); ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook-square"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_twitter)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_twitter); ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter-square"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($item->item_social_linkedin)): ?>
                            <a class="mr-1" href="<?php echo e($item->item_social_linkedin); ?>" target="_blank" rel="nofollow"><i class="fab fa-linkedin"></i></a>
                        <?php endif; ?>
                    </p>

                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-primary btn-sm rounded text-white" href="<?php echo e(route('user.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                    <?php else: ?>

                        <?php if($item->user_id != Auth::user()->id): ?>

                            <?php if(Auth::user()->isAdmin()): ?>
                                <?php if($item->reviewedByUser(Auth::user()->id)): ?>
                                    <a class="btn btn-primary btn-sm rounded text-white" href="<?php echo e(route('admin.items.reviews.edit', ['item_slug' => $item->item_slug, 'review' => $item->getReviewByUser(Auth::user()->id)->id])); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.edit-a-review')); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-primary btn-sm rounded text-white" href="<?php echo e(route('admin.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if($item->reviewedByUser(Auth::user()->id)): ?>
                                    <a class="btn btn-primary btn-sm rounded text-white" href="<?php echo e(route('user.items.reviews.edit', ['item_slug' => $item->item_slug, 'review' => $item->getReviewByUser(Auth::user()->id)->id])); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.edit-a-review')); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-primary btn-sm rounded text-white" href="<?php echo e(route('user.items.reviews.create', $item->item_slug)); ?>" target="_blank"><i class="fas fa-star"></i> <?php echo e(__('review.backend.write-a-review')); ?></a>
                                <?php endif; ?>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>
                    <a class="btn btn-primary btn-sm rounded text-white item-share-button"><i class="fas fa-share-alt"></i> <?php echo e(__('frontend.item.share')); ?></a>
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn-primary btn-sm rounded text-white" id="item-save-button-sm"><i class="far fa-bookmark"></i> <?php echo e(__('frontend.item.save')); ?></a>
                        <form id="item-save-form-sm" action="<?php echo e(route('page.item.save', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php else: ?>
                        <?php if(Auth::user()->hasSavedItem($item->id)): ?>
                            <a class="btn btn-warning btn-sm rounded text-white" id="item-saved-button-sm"><i class="fas fa-check"></i> <?php echo e(__('frontend.item.saved')); ?></a>
                            <form id="item-unsave-form-sm" action="<?php echo e(route('page.item.unsave', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                <?php echo csrf_field(); ?>
                            </form>
                        <?php else: ?>
                            <a class="btn btn-primary btn-sm rounded text-white" id="item-save-button-sm"><i class="far fa-bookmark"></i> <?php echo e(__('frontend.item.save')); ?></a>
                            <form id="item-save-form-sm" action="<?php echo e(route('page.item.save', ['item_slug' => $item->item_slug])); ?>" method="POST" hidden="true">
                                <?php echo csrf_field(); ?>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <?php echo $__env->make('frontend.partials.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="row mb-3">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('page.home')); ?>">
                                    <i class="fas fa-bars"></i>
                                    <?php echo e(__('frontend.header.home')); ?>

                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('page.categories')); ?>"><?php echo e(__('frontend.item.all-categories')); ?></a></li>

                            <?php if($item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('page.state', ['state_slug'=>$item->state->state_slug])); ?>"><?php echo e($item->state->state_name); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('page.city', ['state_slug'=>$item->state->state_slug, 'city_slug'=>$item->city->city_slug])); ?>"><?php echo e($item->city->city_name); ?></a></li>
                            <?php endif; ?>

                            <li class="breadcrumb-item"><a href="<?php echo e(route('page.item', ['item_slug'=>$item->item_slug])); ?>"><?php echo e($item->item_title); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->product_name); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <?php if(Auth::check() && Auth::user()->id == $product->user_id): ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo e(__('products.alert.this-is-your-product')); ?>

                                    <?php if(Auth::user()->isAdmin()): ?>
                                        <a class="pl-1" target="_blank" href="<?php echo e(route('admin.products.edit', ['product' => $product])); ?>">
                                            <i class="fas fa-external-link-alt"></i>
                                            <?php echo e(__('products.edit-product-link')); ?>

                                        </a>
                                    <?php else: ?>
                                        <a class="pl-1" target="_blank" href="<?php echo e(route('user.products.edit', ['product' => $product])); ?>">
                                            <i class="fas fa-external-link-alt"></i>
                                            <?php echo e(__('products.edit-product-link')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-4 col-sm-4 mb-3">
                            <?php if(empty($product->product_image_large)): ?>
                                <img src="<?php echo e(asset('frontend/images/placeholder/full_item_feature_image_tiny.webp')); ?>" alt="Image" class="img-fluid rounded">
                            <?php else: ?>
                                <img src="<?php echo e(Storage::disk('public')->url('product/' . $product->product_image_large)); ?>" alt="Image" class="img-fluid rounded">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h4 class="h5 text-black"><?php echo e($product->product_name); ?></h4>
                            <span><?php echo e(__('item_section.offered-by')); ?></span>
                            <a href="<?php echo e(route('page.item', ['item_slug'=>$item->item_slug])); ?>"><?php echo e($item->item_title); ?></a>
                            <hr>

                            <?php if(!empty($product->product_price)): ?>
                                <span><?php echo e($site_global_settings->setting_product_currency_symbol . number_format($product->product_price, 2)); ?></span>
                                <hr>
                            <?php endif; ?>

                            <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                                <?php if(\Illuminate\Support\Facades\Auth::user()->id != $item->user_id): ?>
                                    <?php if(\Illuminate\Support\Facades\Auth::user()->isAdmin()): ?>
                                        <a href="<?php echo e(route('admin.messages.create', ['item' => $item->id])); ?>" class="btn btn-primary text-white rounded"><?php echo e(__('backend.message.message-txt')); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('user.messages.create', ['item' => $item->id])); ?>" class="btn btn-primary text-white rounded"><?php echo e(__('backend.message.message-txt')); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="btn btn-primary text-white rounded" href="#" data-toggle="modal" data-target="#itemLeadModal"><?php echo e(__('rating_summary.contact')); ?></a>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if($product->productGalleries()->count() > 0): ?>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div id="product-image-gallery">
                                <?php
                                $product_galleries = $product->productGalleries()->get();
                                ?>

                                <?php $__currentLoopData = $product_galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_galleries_key => $product_gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(Storage::disk('public')->url('product/gallery/' . $product_gallery->product_image_gallery_name)); ?>" rel="product-image-gallery-thumb">
                                        <img alt="Image" src="<?php echo e(Storage::disk('public')->url('product/gallery/' . $product_gallery->product_image_gallery_thumb_name)); ?>"/>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!-- Start product description block -->
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="h5 mt-3 mb-4 text-black"><?php echo e(__('item_section.product-description')); ?></h4>
                            <p><?php echo clean(nl2br($product->product_description), array('HTML.Allowed' => 'b,strong,i,em,u,ul,ol,li,p,br')); ?></p>
                            <hr>
                        </div>
                    </div>
                    <!-- End product description block -->


                    <!-- Start product features block -->
                    <?php if($product_features->count() > 0): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="h5 mb-4 text-black"><?php echo e(__('item_section.product-features')); ?></h4>
                            <?php $__currentLoopData = $product_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_features_key => $product_feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row pt-2 pb-2 mt-2 mb-2 border-left <?php echo e($product_features_key%2 == 0 ? 'bg-light' : ''); ?>">
                                    <div class="col-3">
                                        <?php echo e($product_feature->attribute->attribute_name); ?>

                                    </div>

                                    <div class="col-9">
                                        <?php if($product_feature->product_feature_value): ?>
                                            <?php if($product_feature->attribute->attribute_type == \App\Attribute::TYPE_LINK): ?>
                                                <?php
                                                    $parsed_url = parse_url($product_feature->product_feature_value);
                                                ?>

                                                <?php if(is_array($parsed_url) && array_key_exists('host', $parsed_url)): ?>
                                                    <a target="_blank" rel=”nofollow” href="<?php echo e($product_feature->product_feature_value); ?>">
                                                        <?php echo e($parsed_url['host']); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <?php echo clean(nl2br($product_feature->product_feature_value), array('HTML.Allowed' => 'b,strong,i,em,u,ul,ol,li,p,br')); ?>

                                                <?php endif; ?>

                                            <?php elseif($product_feature->attribute->attribute_type == \App\Attribute::TYPE_MULTI_SELECT): ?>
                                                <?php if(count(explode(',', $product_feature->product_feature_value))): ?>

                                                    <?php $__currentLoopData = explode(',', $product_feature->product_feature_value); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_feature_value_multi_select_key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="review"><?php echo e($value); ?></span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php else: ?>
                                                    <?php echo e($product_feature->product_feature_value); ?>

                                                <?php endif; ?>

                                            <?php elseif($product_feature->attribute->attribute_type == \App\Attribute::TYPE_SELECT): ?>
                                                <?php echo e($product_feature->product_feature_value); ?>


                                            <?php elseif($product_feature->attribute->attribute_type == \App\Attribute::TYPE_TEXT): ?>
                                                <?php echo clean(nl2br($product_feature->product_feature_value), array('HTML.Allowed' => 'b,strong,i,em,u,ul,ol,li,p,br')); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <hr>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- End product features block -->

                    <!-- start share block -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="h5 mb-4 text-black"><?php echo e(__('frontend.item.share')); ?></h4>
                            <div class="row">
                                <div class="col-12">

                                    <!-- Create link with share to Facebook -->
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-facebook" href="" data-social="facebook">
                                        <i class="fab fa-facebook-f"></i>
                                        <?php echo e(__('social_share.facebook')); ?>

                                    </a>

                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-twitter" href="" data-social="twitter">
                                        <i class="fab fa-twitter"></i>
                                        <?php echo e(__('social_share.twitter')); ?>

                                    </a>

                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-linkedin" href="" data-social="linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                        <?php echo e(__('social_share.linkedin')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-blogger" href="" data-social="blogger">
                                        <i class="fab fa-blogger-b"></i>
                                        <?php echo e(__('social_share.blogger')); ?>

                                    </a>

                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-pinterest" href="" data-social="pinterest">
                                        <i class="fab fa-pinterest-p"></i>
                                        <?php echo e(__('social_share.pinterest')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-evernote" href="" data-social="evernote">
                                        <i class="fab fa-evernote"></i>
                                        <?php echo e(__('social_share.evernote')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-reddit" href="" data-social="reddit">
                                        <i class="fab fa-reddit-alien"></i>
                                        <?php echo e(__('social_share.reddit')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-buffer" href="" data-social="buffer">
                                        <i class="fab fa-buffer"></i>
                                        <?php echo e(__('social_share.buffer')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-wordpress" href="" data-social="wordpress">
                                        <i class="fab fa-wordpress-simple"></i>
                                        <?php echo e(__('social_share.wordpress')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-weibo" href="" data-social="weibo">
                                        <i class="fab fa-weibo"></i>
                                        <?php echo e(__('social_share.weibo')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-skype" href="" data-social="skype">
                                        <i class="fab fa-skype"></i>
                                        <?php echo e(__('social_share.skype')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-telegram" href="" data-social="telegram">
                                        <i class="fab fa-telegram-plane"></i>
                                        <?php echo e(__('social_share.telegram')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-viber" href="" data-social="viber">
                                        <i class="fab fa-viber"></i>
                                        <?php echo e(__('social_share.viber')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-whatsapp" href="" data-social="whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                        <?php echo e(__('social_share.whatsapp')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-wechat" href="" data-social="wechat">
                                        <i class="fab fa-weixin"></i>
                                        <?php echo e(__('social_share.wechat')); ?>

                                    </a>
                                    <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-line" href="" data-social="line">
                                        <i class="fab fa-line"></i>
                                        <?php echo e(__('social_share.line')); ?>

                                    </a>

                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <!-- end share block -->
                </div>

                <div class="col-lg-3 ml-auto">

                    <div class="pt-3">

                        <?php if($ads_before_sidebar_content->count() > 0): ?>
                            <?php $__currentLoopData = $ads_before_sidebar_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_sidebar_content_key => $ad_before_sidebar_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mb-5">
                                    <?php if($ad_before_sidebar_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_before_sidebar_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_sidebar_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_before_sidebar_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_sidebar_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_before_sidebar_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if($item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW): ?>
                        <div class="row mb-2 align-items-center">
                            <div class="col-12">
                                <h3 class="h5 text-black"><?php echo e(__('item_hour.item-hours')); ?></h3>
                            </div>
                        </div>

                        <?php if($item_hours->count() > 0): ?>
                        <div class="row">
                            <div class="col-12 pl-0 pr-0">
                                <?php if($current_open_range): ?>
                                    <div class="alert alert-success" role="alert">
                                        <i class="fas fa-door-open"></i>
                                        <?php echo e(__('item_hour.item-open-since') . ' ' . $current_open_range->start() . '.'); ?>

                                        <?php echo e(__('item_hour.item-will-close') . ' ' . $current_open_range->end() . '.'); ?>

                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>

                                        <?php
                                            $previous_close_datetime = $opening_hours_obj->previousClose($datetime_now);
                                            $next_open_datetime = $opening_hours_obj->nextOpen($datetime_now);

                                            $previous_close_day_of_week = intval($previous_close_datetime->format('N'));
                                            $next_open_day_of_week = intval($next_open_datetime->format('N'));
                                        ?>

                                        <?php echo e(__('item_hour.item-closed-since')); ?>


                                        <?php if($previous_close_day_of_week == 1): ?>
                                            <?php echo e(__('item_hour.monday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($previous_close_day_of_week == 2): ?>
                                            <?php echo e(__('item_hour.tuesday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($previous_close_day_of_week == 3): ?>
                                            <?php echo e(__('item_hour.wednesday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($previous_close_day_of_week == 4): ?>
                                            <?php echo e(__('item_hour.thursday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($previous_close_day_of_week == 5): ?>
                                            <?php echo e(__('item_hour.friday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($previous_close_day_of_week == 6): ?>
                                            <?php echo e(__('item_hour.saturday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($previous_close_day_of_week == 7): ?>
                                            <?php echo e(__('item_hour.sunday') . ' ' . $previous_close_datetime->format('H:i') . '.'); ?>

                                        <?php endif; ?>

                                        <?php echo e(__('item_hour.item-will-re-open')); ?>


                                        <?php if($next_open_day_of_week == 1): ?>
                                            <?php echo e(__('item_hour.monday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($next_open_day_of_week == 2): ?>
                                            <?php echo e(__('item_hour.tuesday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($next_open_day_of_week == 3): ?>
                                            <?php echo e(__('item_hour.wednesday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($next_open_day_of_week == 4): ?>
                                            <?php echo e(__('item_hour.thursday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($next_open_day_of_week == 5): ?>
                                            <?php echo e(__('item_hour.friday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($next_open_day_of_week == 6): ?>
                                            <?php echo e(__('item_hour.saturday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php elseif($next_open_day_of_week == 7): ?>
                                            <?php echo e(__('item_hour.sunday') . ' ' . $next_open_datetime->format('H:i') . '.'); ?>

                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row mb-4">
                            <div class="col-12">

                                <div class="row bg-light border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.monday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_monday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_monday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_monday_key => $an_item_hours_monday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_monday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.tuesday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_tuesday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_tuesday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_tuesday_key => $an_item_hours_tuesday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_tuesday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row bg-light border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.wednesday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_wednesday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_wednesday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_wednesday_key => $an_item_hours_wednesday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_wednesday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.thursday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_thursday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_thursday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_thursday_key => $an_item_hours_thursday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_thursday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row bg-light border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.friday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_friday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_friday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_friday_key => $an_item_hours_friday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_friday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.saturday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_saturday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_saturday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_saturday_key => $an_item_hours_saturday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_saturday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row bg-light border-left pt-1 pb-1">
                                    <div class="col-3">
                                        <span class=""><?php echo e(__('item_hour.sunday')); ?></span>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php if(count($item_hours_sunday) > 0): ?>
                                            <?php $__currentLoopData = $item_hours_sunday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hours_sunday_key => $an_item_hours_sunday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span><?php echo e($an_item_hours_sunday); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><?php echo e(__('item_hour.item-closed')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if(count($item_hour_exceptions_obj) > 0): ?>
                                    <div class="row pt-1 pb-1">
                                        <div class="col-12">
                                            <a class="text-secondary" href="#" data-toggle="modal" data-target="#itemHourExceptionsModal">
                                                <i class="far fa-window-restore"></i>
                                                <?php echo e(__('item_hour.item-hour-exceptions-link')); ?>

                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                            <?php if(\Illuminate\Support\Facades\Auth::user()->id != $item->user_id): ?>
                                <div class="row mt-5 mb-2 align-items-center">
                                    <div class="col-12">
                                        <h3 class="h5 text-black"><?php echo e(__('backend.message.message-txt')); ?></h3>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                    <?php if(\Illuminate\Support\Facades\Auth::user()->isAdmin()): ?>
                                        <!-- message item owner contact form -->
                                            <form method="POST" action="<?php echo e(route('admin.messages.store')); ?>" class="">
                                                <?php echo csrf_field(); ?>

                                                <input type="hidden" name="recipient" value="<?php echo e($item->user_id); ?>">
                                                <input type="hidden" name="item" value="<?php echo e($item->id); ?>">
                                                <div class="form-group">
                                                    <input id="subject" type="text" class="form-control rounded <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="subject" value="<?php echo e(old('subject')); ?>" placeholder="<?php echo e(__('backend.message.subject')); ?>">
                                                    <?php $__errorArgs = ['subject'];
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
                                                <div class="form-group">
                                                    <textarea rows="6" id="message" type="text" class="form-control rounded <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" placeholder="<?php echo e(__('backend.message.message-txt')); ?>"><?php echo e(old('message')); ?></textarea>
                                                    <?php $__errorArgs = ['message'];
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
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-primary btn-block rounded">
                                                        <?php echo e(__('frontend.item.send-message')); ?>

                                                    </button>
                                                </div>
                                            </form>
                                    <?php else: ?>
                                        <!-- message item owner contact form -->
                                            <form method="POST" action="<?php echo e(route('user.messages.store')); ?>" class="">
                                                <?php echo csrf_field(); ?>

                                                <input type="hidden" name="recipient" value="<?php echo e($item->user_id); ?>">
                                                <input type="hidden" name="item" value="<?php echo e($item->id); ?>">
                                                <div class="form-group">
                                                    <input id="subject" type="text" class="form-control rounded <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="subject" value="<?php echo e(old('subject')); ?>" placeholder="<?php echo e(__('backend.message.subject')); ?>">
                                                    <?php $__errorArgs = ['subject'];
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
                                                <div class="form-group">
                                                    <textarea rows="6" id="message" type="text" class="form-control rounded <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" placeholder="<?php echo e(__('backend.message.message-txt')); ?>"><?php echo e(old('message')); ?></textarea>
                                                    <?php $__errorArgs = ['message'];
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
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-primary btn-block rounded">
                                                        <?php echo e(__('frontend.item.send-message')); ?>

                                                    </button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="row mb-2 align-items-center">
                            <div class="col-12">
                                <h3 class="h5 text-black"><?php echo e(__('rating_summary.managed-by')); ?></h3>
                            </div>
                        </div>

                        <div class="row align-items-center mb-4">
                            <div class="col-4">
                                <?php if(empty($item->user->user_image)): ?>
                                    <img src="<?php echo e(asset('frontend/images/placeholder/profile-'. intval($item->user->id % 10) . '.webp')); ?>" alt="Image" class="img-fluid rounded-circle">
                                <?php else: ?>

                                    <img src="<?php echo e(Storage::disk('public')->url('user/' . $item->user->user_image)); ?>" alt="<?php echo e($item->user->name); ?>" class="img-fluid rounded-circle">
                                <?php endif; ?>
                            </div>
                            <div class="col-8 pl-0">
                                <span class="font-size-13"><?php echo e($item->user->name); ?></span><br/>
                                <span class="font-size-13"><?php echo e(__('frontend.item.posted') . ' ' . $item->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>

                        <?php if(!\Illuminate\Support\Facades\Auth::check()): ?>
                            <div class="row mb-4 align-items-center">
                                <div class="col-12">
                                    <a class="btn btn-primary btn-block rounded text-white" href="#" data-toggle="modal" data-target="#itemLeadModal"><?php echo e(__('rating_summary.contact')); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <hr>

                        <?php echo $__env->make('frontend.partials.search.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php if($ads_after_sidebar_content->count() > 0): ?>
                            <?php $__currentLoopData = $ads_after_sidebar_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_after_sidebar_content_key => $ad_after_sidebar_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mt-5">
                                    <?php if($ad_after_sidebar_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_after_sidebar_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_after_sidebar_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_after_sidebar_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_after_sidebar_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_after_sidebar_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php if($similar_items->count() > 0): ?>
    <div class="site-section bg-light">
        <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 text-left border-primary">
                <h2 class="font-weight-light text-primary"><?php echo e(__('frontend.item.similar-listings')); ?></h2>
            </div>
        </div>
        <div class="row mt-5">

            <?php $__currentLoopData = $similar_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar_items_key => $similar_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-6">
                    <div class="d-block d-md-flex listing">
                        <a href="<?php echo e(route('page.item', $similar_item->item_slug)); ?>" class="img d-block" style="background-image: url(<?php echo e(!empty($similar_item->item_image_small) ? Storage::disk('public')->url('item/' . $similar_item->item_image_small) : (!empty($similar_item->item_image) ? Storage::disk('public')->url('item/' . $similar_item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_small.webp'))); ?>)"></a>
                        <div class="lh-content">

                            <?php $__currentLoopData = $similar_item->getAllCategories(\App\Item::ITEM_TOTAL_SHOW_CATEGORY); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar_items_all_categories_key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('page.category', $category->category_slug)); ?>">
                                    <span class="category">
                                        <?php if(!empty($category->category_icon)): ?>
                                            <i class="<?php echo e($category->category_icon); ?>"></i>
                                        <?php endif; ?>
                                        <?php echo e($category->category_name); ?>

                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($similar_item->allCategories()->count() > \App\Item::ITEM_TOTAL_SHOW_CATEGORY): ?>
                                <span class="category"><?php echo e(__('categories.and') . " " . strval($similar_item->allCategories()->count() - \App\Item::ITEM_TOTAL_SHOW_CATEGORY) . " " . __('categories.more')); ?></span>
                            <?php endif; ?>

                            <h3 class="pt-2"><a href="<?php echo e(route('page.item', $similar_item->item_slug)); ?>"><?php echo e($similar_item->item_title); ?></a></h3>

                            <?php if($similar_item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                                <address>
                                    <a href="<?php echo e(route('page.city', ['state_slug'=>$similar_item->state->state_slug, 'city_slug'=>$similar_item->city->city_slug])); ?>"><?php echo e($similar_item->city->city_name); ?></a>,
                                    <a href="<?php echo e(route('page.state', ['state_slug'=>$similar_item->state->state_slug])); ?>"><?php echo e($similar_item->state->state_name); ?></a>
                                </address>
                            <?php endif; ?>

                            <?php if($similar_item->getCountRating() > 0): ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="pl-0 rating_stars rating_stars_<?php echo e($similar_item->item_slug); ?>" data-id="rating_stars_<?php echo e($similar_item->item_slug); ?>" data-rating="<?php echo e($similar_item->item_average_rating); ?>"></div>
                                        <address class="mt-1">
                                            <?php if($similar_item->getCountRating() == 1): ?>
                                                <?php echo e('(' . $similar_item->getCountRating() . ' ' . __('review.frontend.review') . ')'); ?>

                                            <?php else: ?>
                                                <?php echo e('(' . $similar_item->getCountRating() . ' ' . __('review.frontend.reviews') . ')'); ?>

                                            <?php endif; ?>
                                        </address>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <hr class="item-box-hr">

                            <div class="row align-items-center">

                                <div class="col-5 col-md-7 pr-0">
                                    <div class="row align-items-center item-box-user-div">
                                        <div class="col-3 item-box-user-img-div">
                                            <?php if(empty($similar_item->user->user_image)): ?>
                                                <img src="<?php echo e(asset('frontend/images/placeholder/profile-'. intval($similar_item->user->id % 10) . '.webp')); ?>" alt="Image" class="img-fluid rounded-circle">
                                            <?php else: ?>
                                                <img src="<?php echo e(Storage::disk('public')->url('user/' . $similar_item->user->user_image)); ?>" alt="<?php echo e($similar_item->user->name); ?>" class="img-fluid rounded-circle">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-9 line-height-1-2 item-box-user-name-div">
                                            <div class="row pb-1">
                                                <div class="col-12">
                                                    <span class="font-size-13"><?php echo e(str_limit($similar_item->user->name, 14, '.')); ?></span>
                                                </div>
                                            </div>
                                            <div class="row line-height-1-0">
                                                <div class="col-12">
                                                    <span class="review"><?php echo e($similar_item->created_at->diffForHumans()); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7 col-md-5 pl-0 text-right">
                                    <?php if($similar_item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW): ?>
                                        <?php if($similar_item->hasOpened()): ?>
                                            <span class="item-box-hour-span-opened"><?php echo e(__('item_hour.frontend-item-box-hour-opened')); ?></span>
                                        <?php else: ?>
                                            <span class="item-box-hour-span-closed"><?php echo e(__('item_hour.frontend-item-box-hour-closed')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
    </div>
    <?php endif; ?>

    <?php if($nearby_items->count() > 0): ?>
    <div class="site-section bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7 text-left border-primary">
                    <h2 class="font-weight-light text-primary"><?php echo e(__('frontend.item.nearby-listings')); ?></h2>
                </div>
            </div>
            <div class="row mt-5">

                <?php $__currentLoopData = $nearby_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nearby_items_key => $nearby_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6">
                        <div class="d-block d-md-flex listing">
                            <a href="<?php echo e(route('page.item', $nearby_item->item_slug)); ?>" class="img d-block" style="background-image: url(<?php echo e(!empty($nearby_item->item_image_small) ? Storage::disk('public')->url('item/' . $nearby_item->item_image_small) : (!empty($nearby_item->item_image) ? Storage::disk('public')->url('item/' . $nearby_item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_small.webp'))); ?>)"></a>
                            <div class="lh-content">

                                <?php $__currentLoopData = $nearby_item->getAllCategories(\App\Item::ITEM_TOTAL_SHOW_CATEGORY); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nearby_items_all_categories_key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('page.category', $category->category_slug)); ?>">
                                    <span class="category">
                                        <?php if(!empty($category->category_icon)): ?>
                                            <i class="<?php echo e($category->category_icon); ?>"></i>
                                        <?php endif; ?>
                                        <?php echo e($category->category_name); ?>

                                    </span>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($nearby_item->allCategories()->count() > \App\Item::ITEM_TOTAL_SHOW_CATEGORY): ?>
                                    <span class="category"><?php echo e(__('categories.and') . " " . strval($nearby_item->allCategories()->count() - \App\Item::ITEM_TOTAL_SHOW_CATEGORY) . " " . __('categories.more')); ?></span>
                                <?php endif; ?>

                                <h3 class="pt-2"><a href="<?php echo e(route('page.item', $nearby_item->item_slug)); ?>"><?php echo e($nearby_item->item_title); ?></a></h3>

                                <?php if($nearby_item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                                    <address>
                                        <a href="<?php echo e(route('page.city', ['state_slug'=>$nearby_item->state->state_slug, 'city_slug'=>$nearby_item->city->city_slug])); ?>"><?php echo e($nearby_item->city->city_name); ?></a>,
                                        <a href="<?php echo e(route('page.state', ['state_slug'=>$nearby_item->state->state_slug])); ?>"><?php echo e($nearby_item->state->state_name); ?></a>
                                    </address>
                                <?php endif; ?>

                                <?php if($nearby_item->getCountRating() > 0): ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="pl-0 rating_stars rating_stars_<?php echo e($nearby_item->item_slug); ?>" data-id="rating_stars_<?php echo e($nearby_item->item_slug); ?>" data-rating="<?php echo e($nearby_item->item_average_rating); ?>"></div>
                                            <address class="mt-1">
                                                <?php if($nearby_item->getCountRating() == 1): ?>
                                                    <?php echo e('(' . $nearby_item->getCountRating() . ' ' . __('review.frontend.review') . ')'); ?>

                                                <?php else: ?>
                                                    <?php echo e('(' . $nearby_item->getCountRating() . ' ' . __('review.frontend.reviews') . ')'); ?>

                                                <?php endif; ?>
                                            </address>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <hr class="item-box-hr">

                                <div class="row">

                                    <div class="col-5 col-md-7 pr-0">
                                        <div class="row align-items-center item-box-user-div">
                                            <div class="col-3 item-box-user-img-div">
                                                <?php if(empty($nearby_item->user->user_image)): ?>
                                                    <img src="<?php echo e(asset('frontend/images/placeholder/profile-'. intval($nearby_item->user->id % 10) . '.webp')); ?>" alt="Image" class="img-fluid rounded-circle">
                                                <?php else: ?>
                                                    <img src="<?php echo e(Storage::disk('public')->url('user/' . $nearby_item->user->user_image)); ?>" alt="<?php echo e($nearby_item->user->name); ?>" class="img-fluid rounded-circle">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-9 line-height-1-2 item-box-user-name-div">
                                                <div class="row pb-1">
                                                    <div class="col-12">
                                                        <span class="font-size-13"><?php echo e(str_limit($nearby_item->user->name, 14, '.')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="row line-height-1-0">
                                                    <div class="col-12">
                                                        <span class="review"><?php echo e($nearby_item->created_at->diffForHumans()); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-7 col-md-5 pl-0 text-right">
                                        <?php if($nearby_item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW): ?>
                                            <?php if($nearby_item->hasOpened()): ?>
                                                <span class="item-box-hour-span-opened"><?php echo e(__('item_hour.frontend-item-box-hour-opened')); ?></span>
                                            <?php else: ?>
                                                <span class="item-box-hour-span-closed"><?php echo e(__('item_hour.frontend-item-box-hour-closed')); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>

<!-- Modal - share -->
<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="share-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('frontend.item.share-listing')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">

                        <p><?php echo e(__('frontend.item.share-listing-social-media')); ?></p>

                        <!-- Create link with share to Facebook -->
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-facebook" href="" data-social="facebook">
                            <i class="fab fa-facebook-f"></i>
                            <?php echo e(__('social_share.facebook')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-twitter" href="" data-social="twitter">
                            <i class="fab fa-twitter"></i>
                            <?php echo e(__('social_share.twitter')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-linkedin" href="" data-social="linkedin">
                            <i class="fab fa-linkedin-in"></i>
                            <?php echo e(__('social_share.linkedin')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-blogger" href="" data-social="blogger">
                            <i class="fab fa-blogger-b"></i>
                            <?php echo e(__('social_share.blogger')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-pinterest" href="" data-social="pinterest">
                            <i class="fab fa-pinterest-p"></i>
                            <?php echo e(__('social_share.pinterest')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-evernote" href="" data-social="evernote">
                            <i class="fab fa-evernote"></i>
                            <?php echo e(__('social_share.evernote')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-reddit" href="" data-social="reddit">
                            <i class="fab fa-reddit-alien"></i>
                            <?php echo e(__('social_share.reddit')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-buffer" href="" data-social="buffer">
                            <i class="fab fa-buffer"></i>
                            <?php echo e(__('social_share.buffer')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-wordpress" href="" data-social="wordpress">
                            <i class="fab fa-wordpress-simple"></i>
                            <?php echo e(__('social_share.wordpress')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-weibo" href="" data-social="weibo">
                            <i class="fab fa-weibo"></i>
                            <?php echo e(__('social_share.weibo')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-skype" href="" data-social="skype">
                            <i class="fab fa-skype"></i>
                            <?php echo e(__('social_share.skype')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-telegram" href="" data-social="telegram">
                            <i class="fab fa-telegram-plane"></i>
                            <?php echo e(__('social_share.telegram')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-viber" href="" data-social="viber">
                            <i class="fab fa-viber"></i>
                            <?php echo e(__('social_share.viber')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-whatsapp" href="" data-social="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <?php echo e(__('social_share.whatsapp')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-wechat" href="" data-social="wechat">
                            <i class="fab fa-weixin"></i>
                            <?php echo e(__('social_share.wechat')); ?>

                        </a>
                        <a class="btn btn-primary text-white btn-sm rounded mb-2 btn-line" href="" data-social="line">
                            <i class="fab fa-line"></i>
                            <?php echo e(__('social_share.line')); ?>

                        </a>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p><?php echo e(__('frontend.item.share-listing-email')); ?></p>
                        <?php if(!Auth::check()): ?>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo e(__('frontend.item.login-require')); ?>

                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('page.item.email', ['item_slug' => $item->item_slug])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-row mb-3">
                                <div class="col-md-4">
                                    <label for="item_share_email_name" class="text-black"><?php echo e(__('frontend.item.name')); ?></label>
                                    <input id="item_share_email_name" type="text" class="form-control <?php $__errorArgs = ['item_share_email_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_share_email_name" value="<?php echo e(old('item_share_email_name')); ?>" <?php echo e(Auth::check() ? '' : 'disabled'); ?>>
                                    <?php $__errorArgs = ['item_share_email_name'];
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
                                <div class="col-md-4">
                                    <label for="item_share_email_from_email" class="text-black"><?php echo e(__('frontend.item.email')); ?></label>
                                    <input id="item_share_email_from_email" type="email" class="form-control <?php $__errorArgs = ['item_share_email_from_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_share_email_from_email" value="<?php echo e(old('item_share_email_from_email')); ?>" <?php echo e(Auth::check() ? '' : 'disabled'); ?>>
                                    <?php $__errorArgs = ['item_share_email_from_email'];
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
                                <div class="col-md-4">
                                    <label for="item_share_email_to_email" class="text-black"><?php echo e(__('frontend.item.email-to')); ?></label>
                                    <input id="item_share_email_to_email" type="email" class="form-control <?php $__errorArgs = ['item_share_email_to_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_share_email_to_email" value="<?php echo e(old('item_share_email_to_email')); ?>" <?php echo e(Auth::check() ? '' : 'disabled'); ?>>
                                    <?php $__errorArgs = ['item_share_email_to_email'];
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
                                    <label for="item_share_email_note" class="text-black"><?php echo e(__('frontend.item.add-note')); ?></label>
                                    <textarea class="form-control <?php $__errorArgs = ['item_share_email_note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="item_share_email_note" rows="3" name="item_share_email_note" <?php echo e(Auth::check() ? '' : 'disabled'); ?>><?php echo e(old('item_share_email_note')); ?></textarea>
                                    <?php $__errorArgs = ['item_share_email_note'];
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
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary py-2 px-4 text-white rounded" <?php echo e(Auth::check() ? '' : 'disabled'); ?>>
                                        <?php echo e(__('frontend.item.send-email')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
            </div>
        </div>
    </div>
</div>

<?php if($item_total_categories > \App\Item::ITEM_TOTAL_SHOW_CATEGORY): ?>
<!-- Modal show categories -->
<div class="modal fade" id="showCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="showCategoriesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('categories.all-cat') . " - " . $item->item_title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <?php $__currentLoopData = $item_all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $a_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a class="btn btn-sm btn-outline-primary rounded mb-2" href="<?php echo e(route('page.category', $a_category->category_slug)); ?>">
                                <span class="category"><?php echo e($a_category->category_name); ?></span>
                            </a>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if(!\Illuminate\Support\Facades\Auth::check()): ?>
<div class="modal fade" id="itemLeadModal" tabindex="-1" role="dialog" aria-labelledby="itemLeadModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('rating_summary.contact') . ' ' . $item->item_title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php echo e(route('page.item.lead.store', ['item_slug' => $item->item_slug])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="item_lead_name" class="text-black"><?php echo e(__('role_permission.item-leads.item-lead-name')); ?></label>
                                    <input id="item_lead_name" type="text" class="form-control <?php $__errorArgs = ['item_lead_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_lead_name" value="<?php echo e(old('item_lead_name')); ?>">
                                    <?php $__errorArgs = ['item_lead_name'];
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
                                <div class="col-12 col-md-6">
                                    <label for="item_lead_email" class="text-black"><?php echo e(__('role_permission.item-leads.item-lead-email')); ?></label>
                                    <input id="item_lead_email" type="text" class="form-control <?php $__errorArgs = ['item_lead_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_lead_email" value="<?php echo e(old('item_lead_email')); ?>">
                                    <?php $__errorArgs = ['item_lead_email'];
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
                                <div class="col-12 col-md-6">
                                    <label for="item_lead_phone" class="text-black"><?php echo e(__('role_permission.item-leads.item-lead-phone')); ?></label>
                                    <input id="item_lead_phone" type="text" class="form-control <?php $__errorArgs = ['item_lead_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_lead_phone" value="<?php echo e(old('item_lead_phone')); ?>">
                                    <?php $__errorArgs = ['item_lead_phone'];
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
                                <div class="col-12 col-md-6">
                                    <label for="item_lead_subject" class="text-black"><?php echo e(__('role_permission.item-leads.item-lead-subject')); ?></label>
                                    <input id="item_lead_subject" type="text" class="form-control <?php $__errorArgs = ['item_lead_subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="item_lead_subject" value="<?php echo e(old('item_lead_subject')); ?>">
                                    <?php $__errorArgs = ['item_lead_subject'];
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
                                    <label for="item_lead_message" class="text-black"><?php echo e(__('role_permission.item-leads.item-lead-message')); ?></label>
                                    <textarea class="form-control <?php $__errorArgs = ['item_lead_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="item_lead_message" rows="3" name="item_lead_message"><?php echo e(old('item_lead_message')); ?></textarea>
                                    <?php $__errorArgs = ['item_lead_message'];
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

                            <!-- Start Google reCAPTCHA version 2 -->
                            <?php if($site_global_settings->setting_site_recaptcha_item_lead_enable == \App\Setting::SITE_RECAPTCHA_ITEM_LEAD_ENABLE): ?>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <?php echo htmlFormSnippet(); ?>

                                    <?php $__errorArgs = ['g-recaptcha-response'];
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
                            <?php endif; ?>
                            <!-- End Google reCAPTCHA version 2 -->

                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary py-2 px-4 text-white rounded">
                                        <?php echo e(__('rating_summary.contact')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW): ?>
    <?php if(count($item_hour_exceptions_obj) > 0): ?>
        <div class="modal fade" id="itemHourExceptionsModal" tabindex="-1" role="dialog" aria-labelledby="itemHourExceptionsModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('item_hour.modal-item-hour-exceptions-title')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <p><?php echo e($item->item_title . ' ' . __('item_hour.modal-item-hour-exceptions-description')); ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <?php $__currentLoopData = $item_hour_exceptions_obj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hour_exceptions_obj_key => $item_hour_exception): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row pt-1 pb-1 bg-light mb-1 align-items-center">
                                        <div class="col-4">
                                            <i class="far fa-calendar-alt"></i>
                                            <?php echo e($item_hour_exceptions_obj_key); ?>

                                        </div>
                                        <div class="col-8 text-right">
                                            <?php
                                                $item_hour_exception_iterator = $item_hour_exception->getIterator();
                                            ?>

                                            <?php if(count($item_hour_exception_iterator) > 0): ?>
                                                <?php $__currentLoopData = $item_hour_exception_iterator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_hour_exception_iterator_key => $an_item_hour_exception_iterator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <i class="far fa-clock"></i>
                                                    <?php if(count($item_hour_exception_iterator) - 1 == $item_hour_exception_iterator_key): ?>
                                                        <?php echo e($an_item_hour_exception_iterator); ?>

                                                    <?php else: ?>
                                                        <?php echo e($an_item_hour_exception_iterator . ', '); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php echo e(__('item_hour.item-closed')); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded" data-dismiss="modal"><?php echo e(__('importer_csv.error-notify-modal-close')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php if($product->productGalleries()->count() > 0): ?>
    <script src="<?php echo e(asset('frontend/vendor/justified-gallery/jquery.justifiedGallery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/colorbox/jquery.colorbox-min.js')); ?>"></script>
    <?php endif; ?>

    <script src="<?php echo e(asset('frontend/vendor/goodshare/goodshare.min.js')); ?>"></script>

    <script>
        $(document).ready(function(){

            "use strict";

            /**
             * Start initial image gallery justify gallery
             */
            <?php if($product->productGalleries()->count() > 0): ?>
            $("#product-image-gallery").justifiedGallery({
                rowHeight : 70,
                maxRowHeight: 80,
                lastRow : 'center',
                margins : 3,
                captions: false,
                randomize: true,
                rel : 'product-image-gallery-thumb', //replace with 'gallery1' the rel attribute of each link
            }).on('jg.complete', function () {
                $(this).find('a').colorbox({
                    maxWidth : '95%',
                    maxHeight : '95%',
                    opacity : 0.8,
                });
            });
            <?php endif; ?>
            /**
             * End initial image gallery justify gallery
             */


            /**
             * Start initial share button and share modal
             */
            $('.item-share-button').on('click', function(){
                $('#share-modal').modal('show');
            });

            <?php $__errorArgs = ['item_share_email_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#share-modal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_share_email_from_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#share-modal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_share_email_to_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#share-modal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_share_email_note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#share-modal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            /**
             * End initial share button and share modal
             */

            /**
             * Start initial listing lead modal
             */
            <?php $__errorArgs = ['item_lead_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#itemLeadModal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_lead_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#itemLeadModal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_lead_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#itemLeadModal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_lead_subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#itemLeadModal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['item_lead_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#itemLeadModal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            $('#itemLeadModal').modal('show');
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            /**
             * End initial listing lead modal
             */

            /**
             * Start initial save button
             */
            // xl view
            $('#item-save-button-xl').on('click', function(){
                $("#item-save-button-xl").addClass("disabled");
                $("#item-save-form-xl").submit();
            });

            $('#item-saved-button-xl').on('click', function(){
                $("#item-saved-button-xl").off("mouseenter");
                $("#item-saved-button-xl").off("mouseleave");
                $("#item-saved-button-xl").addClass("disabled");
                $("#item-unsave-form-xl").submit();
            });

            $("#item-saved-button-xl").on('mouseenter', function(){
                $("#item-saved-button-xl").attr("class", "btn btn-danger rounded text-white");
                $("#item-saved-button-xl").html("<i class=\"far fa-trash-alt\"></i> <?php echo __('frontend.item.unsave') ?>");
            });

            $("#item-saved-button-xl").on('mouseleave', function(){
                $("#item-saved-button-xl").attr("class", "btn btn-warning rounded text-white");
                $("#item-saved-button-xl").html("<i class=\"fas fa-check\"></i> <?php echo __('frontend.item.saved') ?>");
            });

            // md view
            $('#item-save-button-md').on('click', function(){
                $("#item-save-button-md").addClass("disabled");
                $("#item-save-form-md").submit();
            });

            $('#item-saved-button-md').on('click', function(){
                $("#item-saved-button-md").off("mouseenter");
                $("#item-saved-button-md").off("mouseleave");
                $("#item-saved-button-md").addClass("disabled");
                $("#item-unsave-form-md").submit();
            });

            $("#item-saved-button-md").on('mouseenter', function(){
                $("#item-saved-button-md").attr("class", "btn btn-danger rounded text-white");
                $("#item-saved-button-md").html("<i class=\"far fa-trash-alt\"></i> <?php echo __('frontend.item.unsave') ?>");
            });

            $("#item-saved-button-md").on('mouseleave', function(){
                $("#item-saved-button-md").attr("class", "btn btn-warning rounded text-white");
                $("#item-saved-button-md").html("<i class=\"fas fa-check\"></i> <?php echo __('frontend.item.saved') ?>");
            });

            // sm view
            $('#item-save-button-sm').on('click', function(){
                $("#item-save-button-sm").addClass("disabled");
                $("#item-save-form-sm").submit();
            });

            $('#item-saved-button-sm').on('click', function(){
                $("#item-saved-button-sm").off("mouseenter");
                $("#item-saved-button-sm").off("mouseleave");
                $("#item-saved-button-sm").addClass("disabled");
                $("#item-unsave-form-sm").submit();
            });

            $("#item-saved-button-sm").on('mouseenter', function(){
                $("#item-saved-button-sm").attr("class", "btn btn-sm btn-danger rounded text-white");
                $("#item-saved-button-sm").html("<i class=\"far fa-trash-alt\"></i> <?php echo __('frontend.item.unsave') ?>");
            });

            $("#item-saved-button-sm").on('mouseleave', function(){
                $("#item-saved-button-sm").attr("class", "btn btn-sm btn-warning rounded text-white");
                $("#item-saved-button-sm").html("<i class=\"fas fa-check\"></i> <?php echo __('frontend.item.saved') ?>");
            });
            /**
             * End initial save button
             */

            /**
             * Start rating star
             */
            <?php if($item_count_rating > 0): ?>
            $(".rating_stars_header").rateYo({
                spacing: "5px",
                starWidth: "23px",
                readOnly: true,
                rating: <?php echo e($item_average_rating); ?>,
            });
            <?php endif; ?>
            /**
             * End rating star
             */
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/frontend/product.blade.php ENDPATH**/ ?>