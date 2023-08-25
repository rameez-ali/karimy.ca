
<?php if($recent_posts->count() > 0): ?>
    <div class="mb-5">
        <h3 class="h5 text-black mb-3"><?php echo e(__('frontend.blog.popular-posts')); ?></h3>
        <ul class="list-unstyled">
            <?php $__currentLoopData = $recent_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="mb-2"><a href="<?php echo e(route('page.blog.show', $post->slug)); ?>"><?php echo e($post->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>


<?php if($all_topics->count() > 0): ?>
    <div class="mb-5">
        <h3 class="h5 text-black mb-3"><?php echo e(trans_choice('frontend.blog.topic', 1)); ?></h3>
        <ul class="list-unstyled">
            <?php $__currentLoopData = $all_topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="mb-2"><a href="<?php echo e(route('page.blog.topic', $topic->slug)); ?>"><?php echo e($topic->name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if($all_tags->count() > 0): ?>
    <div class="mb-5">
        <h3 class="h5 text-black mb-3"><?php echo e(trans_choice('frontend.blog.tag', 1)); ?></h3>
        <ul class="list-unstyled">
            <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="mr-2 mb-2 float-left bg-info text-white pl-2 pr-2 pt-1 pb-1" href="<?php echo e(route('page.blog.tag', $tag->slug)); ?>"><?php echo e($tag->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="mb-5 div-clear"></div>
<?php endif; ?>
<?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/frontend/blog/partials/sidebar.blade.php ENDPATH**/ ?>