<?php $__env->startSection('styles'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_DEFAULT): ?>
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url( <?php echo e(asset('frontend/images/placeholder/header-inner.webp')); ?>);" data-stellar-background-ratio="0.5">

    <?php elseif($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_COLOR): ?>
        <div class="site-blocks-cover inner-page-cover overlay" style="background-color: <?php echo e($site_innerpage_header_background_color); ?>;" data-stellar-background-ratio="0.5">

    <?php elseif($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_IMAGE): ?>
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url( <?php echo e(Storage::disk('public')->url('customization/' . $site_innerpage_header_background_image)); ?>);" data-stellar-background-ratio="0.5">

    <?php elseif($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO): ?>
        <div class="site-blocks-cover inner-page-cover overlay" style="background-color: #333333;" data-stellar-background-ratio="0.5">
    <?php endif; ?>

        <?php if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO): ?>
            <div data-youtube="<?php echo e($site_innerpage_header_background_youtube_video); ?>"></div>
        <?php endif; ?>

        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8 text-center">
                            <h1 style="color: <?php echo e($site_innerpage_header_title_font_color); ?>;"><?php echo e($data['post']->title); ?></h1>
                            <?php if($data['post']->topic()->count() != 0): ?>
                                <p class="mb-0" style="color: <?php echo e($site_innerpage_header_paragraph_font_color); ?>;"><?php echo e($data['post']->topic()->first()->name); ?></p>
                            <?php else: ?>
                                <p class="mb-0" style="color: <?php echo e($site_innerpage_header_paragraph_font_color); ?>;"><?php echo e(__('frontend.blog.uncategorized')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <?php if($ads_before_breadcrumb->count() > 0): ?>
                <?php $__currentLoopData = $ads_before_breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_breadcrumb_key => $ad_before_breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mb-5">
                        <?php if($ad_before_breadcrumb->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                            <div class="col-12 text-left">
                                <div>
                                    <?php echo $ad_before_breadcrumb->advertisement_code; ?>

                                </div>
                            </div>
                        <?php elseif($ad_before_breadcrumb->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                            <div class="col-12 text-center">
                                <div>
                                    <?php echo $ad_before_breadcrumb->advertisement_code; ?>

                                </div>
                            </div>
                        <?php elseif($ad_before_breadcrumb->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                            <div class="col-12 text-right">
                                <div>
                                    <?php echo $ad_before_breadcrumb->advertisement_code; ?>

                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <div class="row mb-4">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('page.home')); ?>">
                                    <i class="fas fa-bars"></i>
                                    <?php echo e(__('frontend.shared.home')); ?>

                                </a>
                            </li>

                            <li class="breadcrumb-item"><a href="<?php echo e(route('page.blog')); ?>"><?php echo e(__('frontend.blog.title')); ?></a></li>
                            <?php if($data['post']->topic()->count() != 0): ?>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('page.blog.topic', $data['post']->topic()->first()->slug)); ?>"><?php echo e($data['post']->topic()->first()->name); ?></a></li>
                            <?php endif; ?>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($data['post']->title); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <?php if($ads_after_breadcrumb->count() > 0): ?>
                <?php $__currentLoopData = $ads_after_breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_after_breadcrumb_key => $ad_after_breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mb-5">
                        <?php if($ad_after_breadcrumb->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                            <div class="col-12 text-left">
                                <div>
                                    <?php echo $ad_after_breadcrumb->advertisement_code; ?>

                                </div>
                            </div>
                        <?php elseif($ad_after_breadcrumb->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                            <div class="col-12 text-center">
                                <div>
                                    <?php echo $ad_after_breadcrumb->advertisement_code; ?>

                                </div>
                            </div>
                        <?php elseif($ad_after_breadcrumb->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                            <div class="col-12 text-right">
                                <div>
                                    <?php echo $ad_after_breadcrumb->advertisement_code; ?>

                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <div class="row">

                <div class="col-md-8">

                    <?php if($ads_before_feature_image->count() > 0): ?>
                        <?php $__currentLoopData = $ads_before_feature_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_feature_image_key => $ad_before_feature_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row mb-5">
                                <?php if($ad_before_feature_image->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                    <div class="col-12 text-left">
                                        <div>
                                            <?php echo $ad_before_feature_image->advertisement_code; ?>

                                        </div>
                                    </div>
                                <?php elseif($ad_before_feature_image->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                    <div class="col-12 text-center">
                                        <div>
                                            <?php echo $ad_before_feature_image->advertisement_code; ?>

                                        </div>
                                    </div>
                                <?php elseif($ad_before_feature_image->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                    <div class="col-12 text-right">
                                        <div>
                                            <?php echo $ad_before_feature_image->advertisement_code; ?>

                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(empty($data['post']->featured_image)): ?>
                        <div class="mb-3" style="min-height:627px;border-radius: 0.25rem;background-image:url(<?php echo e(asset('frontend/images/placeholder/full_item_feature_image.webp')); ?>);background-size:cover;background-repeat:no-repeat;background-position: center center;"></div>
                    <?php else: ?>
                        <div class="mb-3" style="min-height:627px;border-radius: 0.25rem;background-image:url(<?php echo e(url('laravel_project/public' . $data['post']->featured_image)); ?>);background-size:cover;background-repeat:no-repeat;background-position: center center;"></div>
                    <?php endif; ?>

                        <hr/>

                        <?php if($ads_before_title->count() > 0): ?>
                            <?php $__currentLoopData = $ads_before_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_title_key => $ad_before_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mb-5">
                                    <?php if($ad_before_title->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_before_title->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_title->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_before_title->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_title->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_before_title->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <h2 class="font-size-regular text-black"><?php echo e($data['post']->title); ?></h2>
                        <div class="mb-5">
                            <?php echo e(__('frontend.blog.by')); ?> <?php echo e($data['post']->user()->first()->name); ?><span class="mx-1">&bullet;</span>
                            <?php echo e($data['post']->updated_at->diffForHumans()); ?> <span class="mx-1">&bullet;</span>
                            <?php if($data['post']->topic()->count() != 0): ?>
                                <a href="<?php echo e(route('page.blog.topic', $data['post']->topic()->first()->slug)); ?>"><?php echo e($data['post']->topic()->first()->name); ?></a>
                            <?php else: ?>
                                <?php echo e(__('frontend.blog.uncategorized')); ?>

                            <?php endif; ?>

                        </div>

                        <?php if($ads_before_post_content->count() > 0): ?>
                            <?php $__currentLoopData = $ads_before_post_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_post_content_key => $ad_before_post_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mb-5">
                                    <?php if($ad_before_post_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_before_post_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_post_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_before_post_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_post_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_before_post_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="row post-body mb-3">
                            <div class="col-12">
                                <?php echo $data['post']->body; ?>

                            </div>
                        </div>

                        <?php if($ads_after_post_content->count() > 0): ?>
                            <?php $__currentLoopData = $ads_after_post_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_after_post_content_key => $ad_after_post_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mb-5">
                                    <?php if($ad_after_post_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_after_post_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_after_post_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_after_post_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_after_post_content->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_after_post_content->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if($data['post']->tags()->count() > 0): ?>
                            <div class="row mb-3">
                                <div class="col-1">
                                    <h3 class="h5 text-black"><?php echo e(trans_choice('frontend.blog.tag', 1)); ?></h3>
                                </div>
                                <div class="col-11">
                                    <?php $__currentLoopData = $data['post']->tags()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="mr-2 mb-2 float-left bg-info text-white pl-2 pr-2 pt-1 pb-1" href="<?php echo e(route('page.blog.tag', $tag->slug)); ?>"><?php echo e($tag->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($ads_before_comments->count() > 0): ?>
                            <?php $__currentLoopData = $ads_before_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_comments_key => $ad_before_comments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mb-5">
                                    <?php if($ad_before_comments->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_before_comments->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_comments->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_before_comments->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_comments->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_before_comments->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="row mb-3">
                            <div class="col-12">
                                <h3 class="h5 text-black mb-3"><?php echo e(trans_choice('frontend.blog.comment', 1)); ?></h3>
                                <?php echo $__env->make('comments::components.comments', [
                                    'model' => $blog_post,
                                    'approved' => true,
                                    'perPage' => 10
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>

                        <?php if($ads_before_share->count() > 0): ?>
                            <?php $__currentLoopData = $ads_before_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_before_share_key => $ad_before_share): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mb-5">
                                    <?php if($ad_before_share->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_before_share->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_share->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_before_share->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_before_share->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_before_share->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <h4 class="h5 mb-4 mt-4 text-black"><?php echo e(__('frontend.item.share')); ?></h4>
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

                        <?php if($ads_after_share->count() > 0): ?>
                            <?php $__currentLoopData = $ads_after_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_after_share_key => $ad_after_share): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mt-5">
                                    <?php if($ad_after_share->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_LEFT): ?>
                                        <div class="col-12 text-left">
                                            <div>
                                                <?php echo $ad_after_share->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_after_share->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_CENTER): ?>
                                        <div class="col-12 text-center">
                                            <div>
                                                <?php echo $ad_after_share->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php elseif($ad_after_share->advertisement_alignment == \App\Advertisement::AD_ALIGNMENT_RIGHT): ?>
                                        <div class="col-12 text-right">
                                            <div>
                                                <?php echo $ad_after_share->advertisement_code; ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                </div>

                <div class="col-md-3 ml-auto">

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

                    <?php echo $__env->make('frontend.blog.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('frontend/vendor/goodshare/goodshare.min.js')); ?>"></script>

    <?php if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO): ?>
    <!-- Youtube Background for Header -->
        <script src="<?php echo e(asset('frontend/vendor/jquery-youtube-background/jquery.youtube-background.js')); ?>"></script>
    <?php endif; ?>

    <script>
        $(document).ready(function(){

            "use strict";

            <?php if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO): ?>
            /**
             * Start Initial Youtube Background
             */
            $("[data-youtube]").youtube_background();
            /**
             * End Initial Youtube Background
             */
            <?php endif; ?>

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.appblog',['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/frontend/blog/show.blade.php ENDPATH**/ ?>