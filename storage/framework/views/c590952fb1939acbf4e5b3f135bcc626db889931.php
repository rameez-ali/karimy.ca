<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $markdown = app('Parsedown'); ?>
<?php ($markdown->setSafeMode(true)); ?>

<?php if(isset($reply) && $reply === true): ?>
  <div id="comment-<?php echo e($comment->id); ?>" class="media">
<?php else: ?>
  <li id="comment-<?php echo e($comment->id); ?>" class="media">
<?php endif; ?>

          <?php if($comment->commenter->user_image): ?>
              <img class="mr-3 rounded-circle" src="<?php echo e(url('storage/user/user_image/' . $comment->commenter->user_image)); ?>" alt="<?php echo e($comment->commenter->name ?? $comment->guest_name); ?> Avatar" width="64">
          <?php else: ?>
              <img class="mr-3 rounded-circle" src="<?php echo e(url('storage/user/user_image/' . $comment->commenter->user_image)); ?>" alt="<?php echo e($comment->commenter->name ?? $comment->guest_name); ?> Avatar" width="64">
          <?php endif; ?>


    <div class="media-body">
        <h5 class="mt-0 mb-1"><?php echo e($comment->commenter->name ?? $comment->guest_name); ?> <small class="text-muted">- <?php echo e($comment->created_at->diffForHumans()); ?></small></h5>
        <div class="media-body-comment-body"><?php echo clean($markdown->line($comment->comment), array('HTML.Allowed' => 'b,strong,i,em,u,ul,ol,li,p,br,a[href|title]')); ?></div>

        <div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reply-to-comment', $comment)): ?>
                <button data-toggle="modal" data-target="#reply-modal-<?php echo e($comment->id); ?>" class="btn btn-sm btn-link text-uppercase">Reply</button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-comment', $comment)): ?>
                <button data-toggle="modal" data-target="#comment-modal-<?php echo e($comment->id); ?>" class="btn btn-sm btn-link text-uppercase">Edit</button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-comment', $comment)): ?>
                <a href="<?php echo e(route('comments.destroy', $comment->id)); ?>" onclick="event.preventDefault();document.getElementById('comment-delete-form-<?php echo e($comment->id); ?>').submit();" class="btn btn-sm btn-link text-danger text-uppercase">Delete</a>
                <form id="comment-delete-form-<?php echo e($comment->id); ?>" action="<?php echo e(route('comments.destroy', $comment->id)); ?>" class="display-none" method="POST">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>
                </form>
            <?php endif; ?>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-comment', $comment)): ?>
            <div class="modal fade" id="comment-modal-<?php echo e($comment->id); ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="<?php echo e(route('comments.update', $comment->id)); ?>">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo e(__('frontend.comment.edit-comment')); ?></h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message"><?php echo e(__('frontend.comment.update-message')); ?></label>
                                    <textarea required class="form-control" name="message" rows="3"><?php echo e($comment->comment); ?></textarea>
                                </div>
                            </div>
                            
                            <div class="createdAt"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal"><?php echo e(__('frontend.comment.cancel')); ?></button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase"><?php echo e(__('frontend.comment.update')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reply-to-comment', $comment)): ?>
            <div class="modal fade" id="reply-modal-<?php echo e($comment->id); ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="<?php echo e(route('comments.reply', $comment->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo e(__('frontend.comment.reply-comment')); ?></h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message"><?php echo e(__('frontend.comment.enter-message')); ?></label>
                                    <textarea required class="form-control" name="message" rows="3"></textarea>
                                </div>
                            </div>
                            
                            <div class="createdAt"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal"><?php echo e(__('frontend.comment.cancel')); ?></button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase"><?php echo e(__('frontend.comment.reply')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <br />

        
        <?php if($grouped_comments->has($comment->id)): ?>
            <?php $__currentLoopData = $grouped_comments[$comment->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('comments::_comment', [
                    'comment' => $child,
                    'reply' => true,
                    'grouped_comments' => $grouped_comments
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>
<?php if(isset($reply) && $reply === true): ?>
  </div>
<?php else: ?>
  </li>
<?php endif; ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script>

function set_time() {
var dateTime = moment().toDate();
$(".createdAt").html('<input type="hidden" name="createdAt" value="'+dateTime+'"/>');
call_time();
}

function call_time(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('set_time()',refresh)
}

call_time()
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/vendor/comments/_comment.blade.php ENDPATH**/ ?>