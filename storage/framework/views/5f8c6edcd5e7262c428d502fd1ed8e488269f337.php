<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_DEFAULT): ?>
        <!--<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url( <?php echo e(asset('frontend/images/placeholder/header-inner.webp')); ?>);" data-stellar-background-ratio="0.5">-->
        
        <div class="site-blocks-cover inner-page-cover overlay about-overlay" style="background-image: url( <?php echo e(asset('frontend/images/about-banner.png')); ?>);" data-stellar-background-ratio="0.5">
            
            
            

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
                           
                            <!--<h1 style="color: <?php echo e($site_innerpage_header_title_font_color); ?>;"><?php echo e(__('frontend.about.title')); ?></h1>-->
                            <!--<p class="mb-0" style="color: <?php echo e($site_innerpage_header_paragraph_font_color); ?>;"><?php echo e(__('frontend.about.description')); ?></p>-->
                            <h1 class="about-banner-title">About US</h1>
                            <p class="text-white"><a href="" class="text-white">About</a> / Karimy</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

<section class="position-relative">
    <img class="img-fluid position-absolute about-right-img" src="<?php echo e(asset('frontend/images/about-site-img.png')); ?>"/>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="about-text">
        <h3 class="heading-small text-red ">WHO WE ARE</h3>
        <h2 class="display-4 text-dark mb-3">About <?php echo e(__('frontend.header.site_title')); ?></h2>
        <p class="about-desc">
          KARIMY was established with the aim of being a trusted platform where customers and businesses can connect. The core idea behind developing KARIMY was to build trust between clients and companies because the existing market situation has made it challenging to retain customers' trust.
        </p>
        <p class="about-desc">
          Whether it’s plumbing services, driving schools, or anything in between, our platform helps businesses cut the cost of advertisement to entice and retain loyal customers. We list trusted organizations on our website and let customers choose and coordinate with their desired service providers. Our modus operandi of connecting clients to service providers maintains a connection of authenticity, promoting trustworthy and unbiased reviews of customers. KARIMY not only lets clients save their hard-earned money but also ensures credibility by collaborating with professionals. In a nutshell, we are your go-to place to explore any firm or service provider if you are in a rush and want to get the job done effortlessly.
        </p>
      </div>
    </div>
  </div>
    </div>
</section>
<section class="section-luck bg-style position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white fs-42">No More Struggling</h2>
                <p class="luck-desc text-white my-4">
                   Save your valuable time and secure the best service providers to fulfill your needs.
                </p>
                <!--<a href="" class="d-inline-block btn_about">-->
                <!--    Get Started!-->
                <!--</a>-->
                
                 <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('page.pricing')); ?>" class="d-inline-block btn_about"> <?php echo e(__('frontend.header.search_with_us')); ?></a>
                        <?php else: ?>
                            <?php if(Auth::user()->isAdmin()): ?>
                                <a href="<?php echo e(route('admin.items.create')); ?>" class="d-inline-block btn_about"><?php echo e(__('frontend.header.search_with_us')); ?></a>
                            <?php else: ?>
                                <?php if(Auth::user()->hasPaidSubscription()): ?>
                                    <a href="<?php echo e(route('user.items.create')); ?>" class="d-inline-block btn_about"><?php echo e(__('frontend.header.search_with_us')); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('page.pricing')); ?>" class="d-inline-block btn_about"> <?php echo e(__('frontend.header.search_with_us')); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        
            </div>
        </div>
    </div>
    <!--<div class="counter-box bg-white d-flex justify-content-end">-->
    <!--    <div class="counter-content text-center">-->
    <!--        <h4 class="text-dark">8705</h4>-->
    <!--        <p>Total Listings</p>-->
    <!--    </div>-->
    <!--    <div class="counter-content text-center">-->
    <!--        <h4 class="text-dark">480</h4>-->
    <!--        <p>Company Staff</p>-->
    <!--    </div>-->
    <!--    <div class="counter-content text-center">-->
    <!--        <h4 class="text-dark">6260</h4>-->
    <!--        <p>Places in Canada</p>-->
    <!--    </div>-->
    <!--    <div class="counter-content text-center">-->
    <!--        <h4 class="text-dark">9774</h4>-->
    <!--        <p>Happy People</p>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="counter-box bg-white d-flex justify-content-end">
        <div class="counter-content text-center">
            <h4 class="text-dark">1000+</h4>
            <p>Total Listings</p>
        </div>
        <div class="counter-content text-center">
            <h4 class="text-dark">500+</h4>
            <!--<p>Team Members</p>-->
        </div>
        <div class="counter-content text-center">
            <h4 class="text-dark">5000+</h4>
            <p>Business Listings</p>
        </div>
        <div class="counter-content text-center">
            <h4 class="text-dark">99%</h4>
            <p>Happy Customers</p>
        </div>
    </div>
    
</section>

    <!--<div class="site-section">-->
    <!--    <div class="container">-->

    <!--        <div class="row mb-5">-->
    <!--            <div class="col-12">-->
    <!--                <?php echo clean($about); ?>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</div>-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

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

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/frontend/about.blade.php ENDPATH**/ ?>