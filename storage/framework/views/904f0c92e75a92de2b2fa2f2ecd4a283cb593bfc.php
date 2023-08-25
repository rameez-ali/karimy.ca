<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('sitemap.edit-sitemap-setting')); ?></h1>
            <p class="mb-4"><?php echo e(__('sitemap.edit-sitemap-setting-desc')); ?></p>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="<?php echo e(route('admin.settings.sitemap.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <div class="row form-group">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-index')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_index_enable == \App\Setting::SITE_SITEMAP_INDEX_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.index')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.index')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <i class="fas fa-external-link-alt"></i>
                                    <span><?php echo e(route('page.sitemap.index')); ?></span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_index_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_index_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_index_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INDEX_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_index_enable == \App\Setting::SITE_SITEMAP_INDEX_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INDEX_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_index_enable == \App\Setting::SITE_SITEMAP_INDEX_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_index_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_show_in_footer"><?php echo e(__('sitemap.show-in-footer')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_show_in_footer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_show_in_footer">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_SHOW_IN_FOOTER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_show_in_footer == \App\Setting::SITE_SITEMAP_SHOW_IN_FOOTER ? 'selected' : ''); ?>><?php echo e(__('sitemap.show')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_SHOW_IN_FOOTER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_show_in_footer == \App\Setting::SITE_SITEMAP_NOT_SHOW_IN_FOOTER ? 'selected' : ''); ?>><?php echo e(__('sitemap.not-show')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_show_in_footer'];
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

                        <div class="row form-group pb-2">
                            <div class="col-12">
                                <span><?php echo e(__('sitemap.sitemap-include-to-index')); ?>:</span>
                                <ul>
                                    <?php if($all_sitemap_settings->setting_site_sitemap_page_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                            <span>
                                            <?php echo e(__('sitemap.sitemap-page') . ' - ' . route('page.sitemap.page')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_category_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                            <span>
                                            <?php echo e(__('sitemap.sitemap-category') . ' - ' . route('page.sitemap.category')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_listing_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                            <span>
                                            <?php echo e(__('sitemap.sitemap-listing') . ' - ' . route('page.sitemap.listing')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_post_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                            <span>
                                            <?php echo e(__('sitemap.sitemap-post') . ' - ' . route('page.sitemap.post')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_tag_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                            <span>
                                            <?php echo e(__('sitemap.sitemap-tag') . ' - ' . route('page.sitemap.tag')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_topic_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                            <span>
                                            <?php echo e(__('sitemap.sitemap-topic') . ' - ' . route('page.sitemap.topic')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_state_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                        <span>
                                        <?php echo e(__('sitemap_import.sitemap.state') . ' - ' . route('page.sitemap.state')); ?>

                                        </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($all_sitemap_settings->setting_site_sitemap_city_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX): ?>
                                        <li>
                                        <span>
                                        <?php echo e(__('sitemap_import.sitemap.city') . ' - ' . route('page.sitemap.city')); ?>

                                        </span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-page')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_page_enable == \App\Setting::SITE_SITEMAP_PAGE_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.page')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.page')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.page')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_page_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_page_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_page_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_PAGE_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_enable == \App\Setting::SITE_SITEMAP_PAGE_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_PAGE_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_enable == \App\Setting::SITE_SITEMAP_PAGE_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_page_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_page_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_page_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_page_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_page_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_page_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_page_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_page_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_page_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_page_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_page_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_page_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_page_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_page_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-category')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_category_enable == \App\Setting::SITE_SITEMAP_CATEGORY_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.category')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.category')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.category')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_category_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_category_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_category_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_CATEGORY_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_enable == \App\Setting::SITE_SITEMAP_CATEGORY_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_CATEGORY_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_enable == \App\Setting::SITE_SITEMAP_CATEGORY_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_category_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_category_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_category_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_category_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_category_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_category_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_category_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_category_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_category_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_category_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_category_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_category_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_category_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_category_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-listing')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_listing_enable == \App\Setting::SITE_SITEMAP_LISTING_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.listing')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.listing')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.listing')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_listing_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_listing_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_listing_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_LISTING_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_enable == \App\Setting::SITE_SITEMAP_LISTING_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_LISTING_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_enable == \App\Setting::SITE_SITEMAP_LISTING_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_listing_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_listing_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_listing_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_listing_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_listing_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_listing_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_listing_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_listing_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_listing_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_listing_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_listing_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_listing_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_listing_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_listing_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-post')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_post_enable == \App\Setting::SITE_SITEMAP_POST_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.post')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.post')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.post')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_post_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_post_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_post_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_POST_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_enable == \App\Setting::SITE_SITEMAP_POST_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_POST_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_enable == \App\Setting::SITE_SITEMAP_POST_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_post_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_post_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_post_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_post_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_post_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_post_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_post_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_post_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_post_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_post_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_post_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_post_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_post_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_post_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-tag')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_tag_enable == \App\Setting::SITE_SITEMAP_TAG_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.tag')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.tag')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.tag')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_tag_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_tag_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_tag_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_TAG_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_enable == \App\Setting::SITE_SITEMAP_TAG_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_TAG_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_enable == \App\Setting::SITE_SITEMAP_TAG_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_tag_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_tag_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_tag_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_tag_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_tag_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_tag_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_tag_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_tag_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_tag_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_tag_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_tag_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_tag_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_tag_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_tag_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap.sitemap-topic')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_topic_enable == \App\Setting::SITE_SITEMAP_TOPIC_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.topic')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.topic')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.topic')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_topic_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_topic_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_topic_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_TOPIC_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_enable == \App\Setting::SITE_SITEMAP_TOPIC_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_TOPIC_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_enable == \App\Setting::SITE_SITEMAP_TOPIC_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_topic_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_topic_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_topic_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_topic_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_topic_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_topic_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_topic_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_topic_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_topic_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_topic_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_topic_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_topic_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_topic_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_topic_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap_import.sitemap.state')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_state_enable == \App\Setting::SITE_SITEMAP_STATE_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.state')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.state')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.state')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_state_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_state_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_state_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_STATE_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_enable == \App\Setting::SITE_SITEMAP_STATE_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_STATE_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_enable == \App\Setting::SITE_SITEMAP_STATE_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_state_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_state_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_state_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_state_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_state_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_state_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_state_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_state_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_state_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_state_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_state_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_state_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_state_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_state_include_to_index'];
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

                        <hr>
                        <div class="row form-group pt-2">
                            <div class="col-12">
                                <span class="text-gray-800 text-lg"><?php echo e(__('sitemap_import.sitemap.city')); ?></span>
                                -
                                <?php if($all_sitemap_settings->setting_site_sitemap_city_enable == \App\Setting::SITE_SITEMAP_CITY_ENABLE): ?>
                                    <a href="<?php echo e(route('page.sitemap.city')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.city')); ?>

                                    </a>
                                    <i class="fas fa-check-circle text-success"></i>
                                <?php else: ?>
                                    <span>
                                        <i class="fas fa-external-link-alt"></i>
                                        <?php echo e(route('page.sitemap.city')); ?>

                                    </span>
                                    <i class="fas fa-pause-circle text-warning"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row form-group pb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_city_enable"><?php echo e(__('sitemap.sitemap-status')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_city_enable'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_city_enable">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_CITY_ENABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_enable == \App\Setting::SITE_SITEMAP_CITY_ENABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.enable')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_CITY_DISABLE); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_enable == \App\Setting::SITE_SITEMAP_CITY_DISABLE ? 'selected' : ''); ?>><?php echo e(__('sitemap.disable')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_city_enable'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_city_frequency"><?php echo e(__('sitemap.sitemap-frequency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_city_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_city_frequency">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_ALWAYS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-always')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_HOURLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-hourly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_DAILY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_DAILY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-daily')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_WEEKLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-weekly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_MONTHLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-monthly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_YEARLY ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-yearly')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FREQUENCY_NEVER); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_frequency == \App\Setting::SITE_SITEMAP_FREQUENCY_NEVER ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-frequency-never')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_city_frequency'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_city_format"><?php echo e(__('sitemap.sitemap-format')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_city_format'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_city_format">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_XML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_format == \App\Setting::SITE_SITEMAP_FORMAT_XML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-xml')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_HTML); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_format == \App\Setting::SITE_SITEMAP_FORMAT_HTML ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-html')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_TXT); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_format == \App\Setting::SITE_SITEMAP_FORMAT_TXT ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-txt')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rss')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_FORMAT_ROR_RSS); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_format == \App\Setting::SITE_SITEMAP_FORMAT_ROR_RDF ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-format-ror-rdf')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_city_format'];
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

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_sitemap_city_include_to_index"><?php echo e(__('sitemap.sitemap-include-to-index')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_sitemap_city_include_to_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_sitemap_city_include_to_index">
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_include_to_index == \App\Setting::SITE_SITEMAP_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-include')); ?></option>
                                    <option value="<?php echo e(\App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX); ?>" <?php echo e($all_sitemap_settings->setting_site_sitemap_city_include_to_index == \App\Setting::SITE_SITEMAP_NOT_INCLUDE_TO_INDEX ? 'selected' : ''); ?>><?php echo e(__('sitemap.sitemap-not-include')); ?></option>
                                </select>
                                <?php $__errorArgs = ['setting_site_sitemap_city_include_to_index'];
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

                        <hr>

                        <div class="row form-group justify-content-between">
                            <div class="col-8">
                                <button type="submit" class="btn btn-success text-white">
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/sitemap/edit.blade.php ENDPATH**/ ?>