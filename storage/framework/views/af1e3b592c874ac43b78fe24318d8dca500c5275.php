<?php $__env->startSection('styles'); ?>

    <?php if($site_global_settings->setting_site_map == \App\Setting::SITE_MAP_OPEN_STREET_MAP): ?>
    <link href="<?php echo e(asset('backend/vendor/leaflet/leaflet.css')); ?>" rel="stylesheet" />
    <?php endif; ?>

    <!-- Image Crop Css -->
    <link href="<?php echo e(asset('backend/vendor/croppie/croppie.css')); ?>" rel="stylesheet" />

    <link href="<?php echo e(asset('backend/vendor/simplemde/dist/simplemde.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.setting.general-setting')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.setting.general-setting-desc')); ?></p>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">

                    <form method="POST" action="<?php echo e(route('admin.settings.general.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true"><?php echo e(__('backend.setting.info')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="smtp-tab" data-toggle="tab" href="#smtp" role="tab" aria-controls="smtp" aria-selected="false"><?php echo e(__('smtp.smtp')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false"><?php echo e(__('backend.setting.seo')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="google-analytics-tab" data-toggle="tab" href="#google-analytics" role="tab" aria-controls="google-analytics" aria-selected="false"><?php echo e(__('backend.setting.google-analytics')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="html-tab" data-toggle="tab" href="#html" role="tab" aria-controls="html" aria-selected="false"><?php echo e(__('backend.setting.html')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="false"><?php echo e(__('google_map.map')); ?></a>
                            </li>

                        </ul>
                        <div class="tab-content pt-3 pb-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">

                                <div class="row form-group">

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_name"><?php echo e(__('backend.setting.site-name')); ?></label>
                                        <input id="setting_site_name" type="text" class="form-control <?php $__errorArgs = ['setting_site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_name" value="<?php echo e(old('setting_site_name') ? old('setting_site_name') : $settings->setting_site_name); ?>">
                                        <?php $__errorArgs = ['setting_site_name'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_email"><?php echo e(__('backend.setting.site-email')); ?></label>
                                        <input id="setting_site_email" type="text" class="form-control <?php $__errorArgs = ['setting_site_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_email" value="<?php echo e(old('setting_site_email') ? old('setting_site_email') : $settings->setting_site_email); ?>">
                                        <?php $__errorArgs = ['setting_site_email'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_phone"><?php echo e(__('backend.setting.site-phone')); ?></label>
                                        <input id="setting_site_phone" type="text" class="form-control <?php $__errorArgs = ['setting_site_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_phone" value="<?php echo e(old('setting_site_phone') ? old('setting_site_phone') : $settings->setting_site_phone); ?>">
                                        <?php $__errorArgs = ['setting_site_phone'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_address"><?php echo e(__('backend.setting.address')); ?></label>
                                        <input id="setting_site_address" type="text" class="form-control <?php $__errorArgs = ['setting_site_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_address" value="<?php echo e(old('setting_site_address') ? old('setting_site_address') : $settings->setting_site_address); ?>">
                                        <?php $__errorArgs = ['setting_site_address'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_city"><?php echo e(__('backend.setting.city')); ?></label>
                                        <input id="setting_site_city" type="text" class="form-control <?php $__errorArgs = ['setting_site_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_city" value="<?php echo e(old('setting_site_city') ? old('setting_site_city') : $settings->setting_site_city); ?>">
                                        <?php $__errorArgs = ['setting_site_city'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_state"><?php echo e(__('backend.setting.state')); ?></label>
                                        <input id="setting_site_state" type="text" class="form-control <?php $__errorArgs = ['setting_site_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_state" value="<?php echo e(old('setting_site_state') ? old('setting_site_state') : $settings->setting_site_state); ?>">
                                        <?php $__errorArgs = ['setting_site_state'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_country"><?php echo e(__('backend.setting.country')); ?></label>
                                        <input id="setting_site_country" type="text" class="form-control <?php $__errorArgs = ['setting_site_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_country" value="<?php echo e(old('setting_site_country') ? old('setting_site_country') : $settings->setting_site_country); ?>">
                                        <?php $__errorArgs = ['setting_site_country'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_postal_code"><?php echo e(__('backend.setting.postal-code')); ?></label>
                                        <input id="setting_site_postal_code" type="text" class="form-control <?php $__errorArgs = ['setting_site_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_postal_code" value="<?php echo e(old('setting_site_postal_code') ? old('setting_site_postal_code') : $settings->setting_site_postal_code); ?>">
                                        <?php $__errorArgs = ['setting_site_postal_code'];
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
                                        <label class="text-black" for="setting_site_about"><?php echo e(__('backend.setting.site-about')); ?></label>
                                        <textarea rows="4" id="setting_site_about" type="text" class="form-control <?php $__errorArgs = ['setting_site_about'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_about"><?php echo e(old('setting_site_about') ? old('setting_site_about') : $settings->setting_site_about); ?></textarea>
                                        <?php $__errorArgs = ['setting_site_about'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_location_country_id"><?php echo e(__('theme_directory_hub.setting.default-country')); ?></label>
                                        <select class="custom-select <?php $__errorArgs = ['setting_site_location_country_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_location_country_id" id="setting_site_location_country_id">
                                            <?php $__currentLoopData = $all_countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_countries_key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($country->country_status == \App\Country::COUNTRY_STATUS_ENABLE): ?>
                                                <option <?php echo e((old('setting_site_location_country_id') ? old('setting_site_location_country_id') : $settings->setting_site_location_country_id) == $country->id ? 'selected' : ''); ?> value="<?php echo e($country->id); ?>"><?php echo e($country->country_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <small id="setting_site_location_country_idHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('theme_directory_hub.setting.default-country-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_site_location_country_id'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_location_lat"><?php echo e(__('theme_directory_hub.setting.default-latitude')); ?></label>
                                        <input id="setting_site_location_lat" type="text" class="form-control <?php $__errorArgs = ['setting_site_location_lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_location_lat" value="<?php echo e(old('setting_site_location_lat') ? old('setting_site_location_lat') : $settings->setting_site_location_lat); ?>">
                                        <small id="latHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('theme_directory_hub.setting.default-latitude-help')); ?>

                                            <a class="lat_lng_select_button btn btn-sm btn-primary text-white"><?php echo e(__('backend.setting.select-map')); ?></a>
                                        </small>
                                        <?php $__errorArgs = ['setting_site_location_lat'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="setting_site_location_lng"><?php echo e(__('theme_directory_hub.setting.default-longitude')); ?></label>
                                        <input id="setting_site_location_lng" type="text" class="form-control <?php $__errorArgs = ['setting_site_location_lng'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_location_lng" value="<?php echo e(old('setting_site_location_lng') ? old('setting_site_location_lng') : $settings->setting_site_location_lng); ?>">
                                        <small id="lngHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('theme_directory_hub.setting.default-latitude-help')); ?>

                                            <a class="lat_lng_select_button btn btn-sm btn-primary text-white"><?php echo e(__('backend.setting.select-map')); ?></a>
                                        </small>
                                        <?php $__errorArgs = ['setting_site_location_lng'];
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

                                    <div class="col-md-3">
                                        <label for="setting_product_currency_symbol" class="text-black"><?php echo e(__('theme_directory_hub.setting.display-currency-symbol')); ?></label>
                                        <select id="setting_product_currency_symbol" class="custom-select" name="setting_product_currency_symbol">
                                            <option value="$" <?php echo e($settings->setting_product_currency_symbol == '$' ? 'selected' : ''); ?>>$</option>
                                            <option value="€" <?php echo e($settings->setting_product_currency_symbol == '€' ? 'selected' : ''); ?>>€</option>
                                            <option value="£" <?php echo e($settings->setting_product_currency_symbol == '£' ? 'selected' : ''); ?>>£</option>
                                            <option value="¥" <?php echo e($settings->setting_product_currency_symbol == '¥' ? 'selected' : ''); ?>>¥</option>
                                            <option value="CHF" <?php echo e($settings->setting_product_currency_symbol == 'CHF' ? 'selected' : ''); ?>>CHF</option>
                                            <option value="kr" <?php echo e($settings->setting_product_currency_symbol == 'kr' ? 'selected' : ''); ?>>kr</option>
                                            <option value="Rp" <?php echo e($settings->setting_product_currency_symbol == 'Rp' ? 'selected' : ''); ?>>Rp</option>
                                            <option value="руб" <?php echo e($settings->setting_product_currency_symbol == 'руб' ? 'selected' : ''); ?>>руб</option>
                                            <option value="₩" <?php echo e($settings->setting_product_currency_symbol == '₩' ? 'selected' : ''); ?>>₩</option>
                                            <option value="₫" <?php echo e($settings->setting_product_currency_symbol == '₫' ? 'selected' : ''); ?>>₫</option>
                                            <option value="lei" <?php echo e($settings->setting_product_currency_symbol == 'lei' ? 'selected' : ''); ?>>lei</option>
                                            <option value="GH₵" <?php echo e($settings->setting_product_currency_symbol == 'GH₵' ? 'selected' : ''); ?>>GH₵</option>
                                            <option value="₹" <?php echo e($settings->setting_product_currency_symbol == '₹' ? 'selected' : ''); ?>>₹</option>
                                            <option value="KD" <?php echo e($settings->setting_product_currency_symbol == 'KD' ? 'selected' : ''); ?>>KD</option>
                                            <option value="د.إ" <?php echo e($settings->setting_product_currency_symbol == 'د.إ' ? 'selected' : ''); ?>>د.إ</option>
                                            <option value="RM" <?php echo e($settings->setting_product_currency_symbol == 'RM' ? 'selected' : ''); ?>>RM</option>
                                            <option value="₺" <?php echo e($settings->setting_product_currency_symbol == '₺' ? 'selected' : ''); ?>>₺</option>
                                            <option value="XOF" <?php echo e($settings->setting_product_currency_symbol == 'XOF' ? 'selected' : ''); ?>>XOF</option>
                                            <option value="₱" <?php echo e($settings->setting_product_currency_symbol == '₱' ? 'selected' : ''); ?>>₱</option>
                                            <option value="COL$" <?php echo e($settings->setting_product_currency_symbol == 'COL$' ? 'selected' : ''); ?>>COL$</option>
                                            <option value="₲" <?php echo e($settings->setting_product_currency_symbol == '₲' ? 'selected' : ''); ?>>₲</option>
                                            <option value="฿" <?php echo e($settings->setting_product_currency_symbol == '฿' ? 'selected' : ''); ?>>฿</option>
                                            <option value="Kz" <?php echo e($settings->setting_product_currency_symbol == 'Kz' ? 'selected' : ''); ?>>Kz</option>
                                            <option value="KSh" <?php echo e($settings->setting_product_currency_symbol == 'KSh' ? 'selected' : ''); ?>>KSh</option>
                                            <option value="Rs." <?php echo e($settings->setting_product_currency_symbol == 'Rs.' ? 'selected' : ''); ?>>Rs.</option>
                                            <option value="₼" <?php echo e($settings->setting_product_currency_symbol == '₼' ? 'selected' : ''); ?>>₼</option>
                                        </select>
                                        <small id="setting_product_currency_symbolHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('theme_directory_hub.setting.display-currency-symbol-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_product_currency_symbol'];
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

                                    <div class="col-md-4">
                                        <span class="text-lg text-gray-800"><?php echo e(__('backend.setting.website-logo')); ?></span>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('backend.setting.website-logo-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_site_logo'];
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
                                        <div class="row mt-3">
                                            <div class="col-8">
                                                <button id="upload_image" type="button" class="btn btn-primary btn-block mb-2"><?php echo e(__('backend.setting.select-image')); ?></button>
                                                <?php if(empty($settings->setting_site_logo)): ?>
                                                    <img id="image_preview" src="<?php echo e(asset('backend/images/placeholder/full_item_feature_image.webp')); ?>" class="img-responsive">
                                                <?php else: ?>
                                                    <img id="image_preview" src="<?php echo e(Storage::disk('public')->url('setting/'. $settings->setting_site_logo)); ?>" class="img-responsive">
                                                <?php endif; ?>
                                                <input id="feature_image" type="hidden" name="setting_site_logo">
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-8">
                                                <a class="btn btn-danger btn-block text-white" id="delete_setting_logo_image_button">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <?php echo e(__('role_permission.user.delete-profile-image')); ?>

                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        <span class="text-lg text-gray-800"><?php echo e(__('backend.setting.favicon')); ?></span>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('backend.setting.favicon-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_site_favicon'];
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
                                        <div class="row mt-3">
                                            <div class="col-8">
                                                <button id="favicon_upload_image" type="button" class="btn btn-primary btn-block mb-2"><?php echo e(__('backend.setting.select-image')); ?></button>
                                                <?php if(empty($settings->setting_site_favicon)): ?>
                                                    <img id="favicon_image_preview" src="data:image/png;base64,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" class="img-responsive">
                                                <?php else: ?>
                                                    <img id="favicon_image_preview" src="<?php echo e(Storage::disk('public')->url('setting/'. $settings->setting_site_favicon)); ?>" class="img-responsive">
                                                <?php endif; ?>
                                                <input id="favicon_image" type="hidden" name="setting_site_favicon">
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-8">
                                                <a class="btn btn-danger btn-block text-white" id="delete_setting_favicon_image_button">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <?php echo e(__('role_permission.user.delete-profile-image')); ?>

                                                </a>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                            <div class="tab-pane fade" id="smtp" role="tabpanel" aria-labelledby="smtp-tab">

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input <?php echo e($settings->settings_site_smtp_enabled == \App\Setting::SITE_SMTP_ENABLED ? 'checked' : ''); ?> class="form-check-input <?php $__errorArgs = ['settings_site_smtp_enabled'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="checkbox" id="settings_site_smtp_enabled" name="settings_site_smtp_enabled" value="<?php echo e(\App\Setting::SITE_SMTP_ENABLED); ?>">
                                            <label class="form-check-label" for="settings_site_smtp_enabled">
                                                <?php echo e(__('smtp.smtp-enabled')); ?>

                                            </label>
                                        </div>

                                        <?php $__errorArgs = ['settings_site_smtp_enabled'];
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

                                    <div class="col-md-6">
                                        <label class="text-black" for="settings_site_smtp_sender_name"><?php echo e(__('smtp.from-name')); ?></label>
                                        <input id="settings_site_smtp_sender_name" type="text" class="form-control <?php $__errorArgs = ['settings_site_smtp_sender_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_sender_name" value="<?php echo e(old('settings_site_smtp_sender_name') ? old('settings_site_smtp_sender_name') : $settings->settings_site_smtp_sender_name); ?>">
                                        <?php $__errorArgs = ['settings_site_smtp_sender_name'];
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
                                        <label class="text-black" for="settings_site_smtp_sender_email"><?php echo e(__('smtp.from-email')); ?></label>
                                        <input id="settings_site_smtp_sender_email" type="text" class="form-control <?php $__errorArgs = ['settings_site_smtp_sender_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_sender_email" value="<?php echo e(old('settings_site_smtp_sender_email') ? old('settings_site_smtp_sender_email') : $settings->settings_site_smtp_sender_email); ?>">
                                        <?php $__errorArgs = ['settings_site_smtp_sender_email'];
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

                                    <div class="col-md-6">
                                        <label class="text-black" for="settings_site_smtp_host"><?php echo e(__('smtp.smtp-host')); ?></label>
                                        <input id="settings_site_smtp_host" type="text" class="form-control <?php $__errorArgs = ['settings_site_smtp_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_host" value="<?php echo e(old('settings_site_smtp_host') ? old('settings_site_smtp_host') : $settings->settings_site_smtp_host); ?>">
                                        <?php $__errorArgs = ['settings_site_smtp_host'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="settings_site_smtp_port"><?php echo e(__('smtp.smtp-port')); ?></label>
                                        <input id="settings_site_smtp_port" type="number" class="form-control <?php $__errorArgs = ['settings_site_smtp_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_port" value="<?php echo e(old('settings_site_smtp_port') ? old('settings_site_smtp_port') : $settings->settings_site_smtp_port); ?>">
                                        <?php $__errorArgs = ['settings_site_smtp_port'];
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

                                    <div class="col-md-3">
                                        <label class="text-black" for="settings_site_smtp_encryption"><?php echo e(__('smtp.smtp-encryption')); ?></label>
                                        <select class="custom-select <?php $__errorArgs = ['settings_site_smtp_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_encryption" id="settings_site_smtp_encryption">
                                            <option <?php echo e((old('settings_site_smtp_encryption') ? old('settings_site_smtp_encryption') : $settings->settings_site_smtp_encryption) == \App\Setting::SITE_SMTP_ENCRYPTION_NULL ? 'selected' : ''); ?> value="<?php echo e(\App\Setting::SITE_SMTP_ENCRYPTION_NULL); ?>"><?php echo e(__('smtp.smtp-encryption-null')); ?></option>
                                            <option <?php echo e((old('settings_site_smtp_encryption') ? old('settings_site_smtp_encryption') : $settings->settings_site_smtp_encryption) == \App\Setting::SITE_SMTP_ENCRYPTION_SSL ? 'selected' : ''); ?> value="<?php echo e(\App\Setting::SITE_SMTP_ENCRYPTION_SSL); ?>"><?php echo e(__('smtp.smtp-encryption-ssl')); ?></option>
                                            <option <?php echo e((old('settings_site_smtp_encryption') ? old('settings_site_smtp_encryption') : $settings->settings_site_smtp_encryption) == \App\Setting::SITE_SMTP_ENCRYPTION_TLS ? 'selected' : ''); ?> value="<?php echo e(\App\Setting::SITE_SMTP_ENCRYPTION_TLS); ?>"><?php echo e(__('smtp.smtp-encryption-tls')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['settings_site_smtp_encryption'];
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

                                    <div class="col-md-6">
                                        <label class="text-black" for="settings_site_smtp_username"><?php echo e(__('smtp.smtp-username')); ?></label>
                                        <input id="settings_site_smtp_username" type="text" class="form-control <?php $__errorArgs = ['settings_site_smtp_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_username" value="<?php echo e(old('settings_site_smtp_username') ? old('settings_site_smtp_username') : $settings->settings_site_smtp_username); ?>">
                                        <?php $__errorArgs = ['settings_site_smtp_username'];
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
                                        <label class="text-black" for="settings_site_smtp_password"><?php echo e(__('smtp.smtp-password')); ?></label>
                                        <input id="settings_site_smtp_password" type="text" class="form-control <?php $__errorArgs = ['settings_site_smtp_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="settings_site_smtp_password" value="<?php echo e(old('settings_site_smtp_password') ? old('settings_site_smtp_password') : $settings->settings_site_smtp_password); ?>">
                                        <?php $__errorArgs = ['settings_site_smtp_password'];
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
                                    <div class="col-12">
                                        <a class="text-info" href="#" data-toggle="modal" data-target="#testSmtpModal">
                                            <i class="far fa-paper-plane"></i>
                                            <?php echo e(__('category_index.test-smtp.send-a-test-email-link')); ?>

                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                <div class="row form-group">

                                    <div class="col-md-6">
                                        <label class="text-black" for="setting_site_seo_home_title"><?php echo e(__('backend.setting.homepage-title')); ?></label>
                                        <input id="setting_site_seo_home_title" type="text" class="form-control <?php $__errorArgs = ['setting_site_seo_home_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_seo_home_title" value="<?php echo e(old('setting_site_seo_home_title') ? old('setting_site_seo_home_title') : $settings->setting_site_seo_home_title); ?>">
                                        <?php $__errorArgs = ['setting_site_seo_home_title'];
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
                                        <label class="text-black" for="setting_site_seo_home_keywords"><?php echo e(__('backend.setting.homepage-keywords')); ?></label>
                                        <input id="setting_site_seo_home_keywords" type="text" class="form-control <?php $__errorArgs = ['setting_site_seo_home_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_seo_home_keywords" value="<?php echo e(old('setting_site_seo_home_keywords') ? old('setting_site_seo_home_keywords') : $settings->setting_site_seo_home_keywords); ?>">
                                        <small class="form-text text-muted">
                                            Separate by comma
                                        </small>
                                        <?php $__errorArgs = ['setting_site_seo_home_keywords'];
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
                                        <label class="text-black" for="setting_site_seo_home_description"><?php echo e(__('backend.setting.homepage-description')); ?></label>
                                        <textarea rows="5" class="form-control <?php $__errorArgs = ['setting_site_seo_home_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_seo_home_description"><?php echo e(old('setting_site_seo_home_description') ? old('setting_site_seo_home_description') : $settings->setting_site_seo_home_description); ?></textarea>
                                        <?php $__errorArgs = ['setting_site_seo_home_description'];
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
                            </div>

                            <div class="tab-pane fade" id="google-analytics" role="tabpanel" aria-labelledby="google-analytics-tab">
                                <div class="row form-group">

                                    <div class="col-md-6 pl-2">
                                        <div class="form-check form-check-inline">
                                            <input <?php echo e($settings->setting_site_google_analytic_enabled == \App\Setting::TRACKING_ON ? 'checked' : ''); ?> class="form-check-input <?php $__errorArgs = ['setting_site_google_analytic_enabled'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="checkbox" id="setting_site_google_analytic_enabled" name="setting_site_google_analytic_enabled" value="<?php echo e(\App\Setting::TRACKING_ON); ?>">
                                            <label class="form-check-label" for="setting_site_google_analytic_enabled">
                                                <?php echo e(__('backend.setting.google-analytics-enabled')); ?>

                                            </label>
                                        </div>

                                        <?php $__errorArgs = ['setting_site_google_analytic_enabled'];
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

                                    <div class="col-md-6">
                                        <label class="text-black" for="setting_site_google_analytic_tracking_id"><?php echo e(__('backend.setting.google-analytics-tracking-id')); ?></label>
                                        <input id="setting_site_google_analytic_tracking_id" type="text" class="form-control <?php $__errorArgs = ['setting_site_google_analytic_tracking_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_google_analytic_tracking_id" value="<?php echo e(old('setting_site_google_analytic_tracking_id') ? old('setting_site_google_analytic_tracking_id') : $settings->setting_site_google_analytic_tracking_id); ?>">
                                        <?php $__errorArgs = ['setting_site_google_analytic_tracking_id'];
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

                                    <div class="col-md-6 pl-2">
                                        <div class="form-check form-check-inline">
                                        <input <?php echo e($settings->setting_site_google_analytic_not_track_admin == \App\Setting::NOT_TRACKING_ADMIN ? 'checked' : ''); ?> class="form-check-input <?php $__errorArgs = ['setting_site_google_analytic_not_track_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="checkbox" id="setting_site_google_analytic_not_track_admin" name="setting_site_google_analytic_not_track_admin" value="<?php echo e(\App\Setting::NOT_TRACKING_ADMIN); ?>">
                                        <label class="form-check-label" for="setting_site_google_analytic_not_track_admin">
                                            <?php echo e(__('backend.setting.google-analytics-no-track-admin')); ?>

                                        </label>
                                        </div>

                                        <?php $__errorArgs = ['setting_site_google_analytic_not_track_admin'];
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
                            </div>

                            <div class="tab-pane fade" id="html" role="tabpanel" aria-labelledby="html-tab">

                                <div class="row form-group mb-5">

                                    <div class="col-md-3 pl-2">
                                        <div class="form-check form-check-inline">
                                            <input <?php echo e($settings->setting_site_header_enabled == \App\Setting::SITE_HEADER_ENABLED ? 'checked' : ''); ?> class="form-check-input <?php $__errorArgs = ['setting_site_header_enabled'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="checkbox" id="setting_site_header_enabled" name="setting_site_header_enabled" value="<?php echo e(\App\Setting::SITE_HEADER_ENABLED); ?>">
                                            <label class="form-check-label" for="setting_site_header_enabled">
                                                <?php echo e(__('backend.setting.header-enabled')); ?>

                                            </label>
                                        </div>

                                        <?php $__errorArgs = ['setting_site_header_enabled'];
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

                                    <div class="col-md-9">
                                        <label class="text-black" for="setting_site_header"><?php echo e(__('backend.setting.header-html')); ?></label>
                                        <textarea rows="6" id="setting_site_header" type="text" class="form-control <?php $__errorArgs = ['setting_site_header'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_header"><?php echo e(old('setting_site_header') ? old('setting_site_header') : $settings->setting_site_header); ?></textarea>
                                        <small id="lngHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('backend.setting.header-html-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_site_header'];
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

                                <div class="row form-group mt-5">

                                    <div class="col-md-3 pl-2">
                                        <div class="form-check form-check-inline">
                                            <input <?php echo e($settings->setting_site_footer_enabled == \App\Setting::SITE_FOOTER_ENABLED ? 'checked' : ''); ?> class="form-check-input <?php $__errorArgs = ['setting_site_footer_enabled'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="checkbox" id="setting_site_footer_enabled" name="setting_site_footer_enabled" value="<?php echo e(\App\Setting::SITE_FOOTER_ENABLED); ?>">
                                            <label class="form-check-label" for="setting_site_footer_enabled">
                                                <?php echo e(__('backend.setting.footer-enabled')); ?>

                                            </label>
                                        </div>

                                        <?php $__errorArgs = ['setting_site_footer_enabled'];
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

                                    <div class="col-md-9">
                                        <label class="text-black" for="setting_site_footer"><?php echo e(__('backend.setting.footer-html')); ?></label>
                                        <textarea rows="6" id="setting_site_footer" type="text" class="form-control <?php $__errorArgs = ['setting_site_footer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_footer"><?php echo e(old('setting_site_footer') ? old('setting_site_footer') : $settings->setting_site_footer); ?></textarea>
                                        <small id="lngHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('backend.setting.footer-html-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_site_footer'];
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

                            </div>

                            <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">


                                <div class="row form-group">

                                    <div class="col-md-6">
                                        <label class="text-black" for="setting_site_map"><?php echo e(__('google_map.select-map')); ?></label>
                                        <select class="custom-select <?php $__errorArgs = ['setting_site_map'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_map" id="setting_site_map">
                                            <option <?php echo e((old('setting_site_map') ? old('setting_site_map') : $settings->setting_site_map) == \App\Setting::SITE_MAP_OPEN_STREET_MAP ? 'selected' : ''); ?> value="<?php echo e(\App\Setting::SITE_MAP_OPEN_STREET_MAP); ?>"><?php echo e(__('google_map.open-street-map')); ?></option>
                                            <option <?php echo e((old('setting_site_map') ? old('setting_site_map') : $settings->setting_site_map) == \App\Setting::SITE_MAP_GOOGLE_MAP ? 'selected' : ''); ?> value="<?php echo e(\App\Setting::SITE_MAP_GOOGLE_MAP); ?>"><?php echo e(__('google_map.google-map')); ?></option>
                                        </select>
                                        <small id="setting_site_mapHelpBlock" class="form-text text-muted">
                                            <?php echo e(__('google_map.select-map-help')); ?>

                                        </small>
                                        <?php $__errorArgs = ['setting_site_map'];
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
                                        <label class="text-black" for="setting_site_map_google_api_key"><?php echo e(__('google_map.google-map-api-key')); ?></label>
                                        <input id="setting_site_map_google_api_key" type="text" class="form-control <?php $__errorArgs = ['setting_site_map_google_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_map_google_api_key" value="<?php echo e(old('setting_site_map_google_api_key') ? old('setting_site_map_google_api_key') : $settings->setting_site_map_google_api_key); ?>">
                                        <?php $__errorArgs = ['setting_site_map_google_api_key'];
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

    <!-- Croppie Modal for logo -->
    <div class="modal fade" id="image-crop-modal" tabindex="-1" role="dialog" aria-labelledby="image-crop-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('backend.setting.crop-logo-image')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="custom-file">
                                <input id="upload_image_input" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="upload_image_input"><?php echo e(__('backend.setting.choose-image')); ?></label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <button id="crop_image" type="button" class="btn btn-primary"><?php echo e(__('backend.setting.crop-image')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Croppie Modal for favicon -->
    <div class="modal fade" id="favicon-image-crop-modal" tabindex="-1" role="dialog" aria-labelledby="image-crop-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('backend.setting.crop-favicon-image')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="favicon_image_demo"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="custom-file">
                                <input id="favicon_upload_image_input" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="favicon_upload_image_input"><?php echo e(__('backend.setting.choose-image')); ?></label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <button id="favicon_crop_image" type="button" class="btn btn-primary"><?php echo e(__('backend.setting.crop-image')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - map -->
    <div class="modal fade" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="map-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('backend.setting.select-lat-lng-map')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div id="map-modal-body"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span id="lat_lng_span"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <button id="lat_lng_confirm" type="button" class="btn btn-primary"><?php echo e(__('backend.shared.confirm')); ?></button>
                </div>
            </div>
        </div>
    </div>


    <!-- test SMTP modal -->
    <div class="modal fade" id="testSmtpModal" tabindex="-1" role="dialog" aria-labelledby="testSmtpModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('category_index.test-smtp.modal.modal-title')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.settings.general.smtp.test')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                <div class="modal-body">

                    <div class="row form-group">
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle"></i>
                                <?php echo e(__('category_index.test-smtp.modal.modal-description')); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-12">
                            <label for="smtp_receiver_email" class="text-black"><?php echo e(__('category_index.test-smtp.receiver-email')); ?></label>
                            <input required id="smtp_receiver_email" type="email" class="form-control <?php $__errorArgs = ['smtp_receiver_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="smtp_receiver_email" value="<?php echo e(old('smtp_receiver_email')); ?>">
                            <?php $__errorArgs = ['smtp_receiver_email'];
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>
                    <button type="submit" class="btn btn-info"><?php echo e(__('category_index.test-smtp.modal.modal-send')); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php if($site_global_settings->setting_site_map == \App\Setting::SITE_MAP_OPEN_STREET_MAP): ?>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="<?php echo e(asset('backend/vendor/leaflet/leaflet.js')); ?>"></script>
    <?php endif; ?>

    <!-- Image Crop Plugin Js -->
    <script src="<?php echo e(asset('backend/vendor/croppie/croppie.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/vendor/simplemde/dist/simplemde.min.js')); ?>"></script>

    <script>

        $(document).ready(function() {

            "use strict";

            /**
             * Start initial HTML code textarea markdown
             */
            var simplemde_header = null;
            var simplemde_footer = null;
            $("#html-tab").on('shown.bs.tab', function (e) {
                //e.target // newly activated tab
                //e.relatedTarget // previous active tab

                console.log("shown html-tab");

                simplemde_header = new SimpleMDE({
                    element: document.getElementById("setting_site_header"),
                    status: false,
                    toolbar: false,
                    spellChecker: false,
                });

                simplemde_footer = new SimpleMDE({
                    element: document.getElementById("setting_site_footer"),
                    status: false,
                    toolbar: false,
                    spellChecker: false,
                });
            });
            $("#html-tab").on('hide.bs.tab', function (e) {
                //e.target // newly activated tab
                //e.relatedTarget // previous active tab

                console.log("hide html-tab");
                simplemde_header.toTextArea();
                simplemde_header = null;

                simplemde_footer.toTextArea();
                simplemde_footer = null;

            });
            /**
             * End initial HTML code textarea markdown
             */


            /**
             * Start the croppie image plugin
             */
            var image_crop = null;

            $('#upload_image').on('click', function(){

                $('#image-crop-modal').modal('show');
            });


            $('#upload_image_input').on('change', function(){

                if(!image_crop)
                {
                    image_crop = $('#image_demo').croppie({
                        enableExif: true,
                        mouseWheelZoom: false,
                        viewport: {
                            width:400,
                            height:100,
                            type:'square'
                        },
                        boundary:{
                            width:500,
                            height:300
                        }
                    });

                    $('#image-crop-modal .modal-dialog').css({
                        'max-width':'100%'
                    });
                }

                var reader = new FileReader();

                reader.onload = function (event) {

                    image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });

                };
                reader.readAsDataURL(this.files[0]);
            });

            $('#crop_image').on("click", function(event){

                image_crop.croppie('result', {
                    type: 'base64',
                    size: 'viewport'
                }).then(function(response){
                    $('#feature_image').val(response);
                    $('#image_preview').attr("src", response);
                });

                $('#image-crop-modal').modal('hide');
            });
            /**
             * End the croppie image plugin
             */


            /**
             * Start the croppie image plugin for favicon
             */
            var favicon_image_crop = null;

            $('#favicon_upload_image').on('click', function(){

                $('#favicon-image-crop-modal').modal('show');
            });


            $('#favicon_upload_image_input').on('change', function(){

                if(!favicon_image_crop)
                {
                    favicon_image_crop = $('#favicon_image_demo').croppie({
                        enableExif: true,
                        mouseWheelZoom: true,
                        viewport: {
                            width:100,
                            height:100,
                            type:'square'
                        },
                        boundary:{
                            width:200,
                            height:200
                        }
                    });

                    $('#favicon-image-crop-modal .modal-dialog').css({
                        'max-width':'100%'
                    });
                }

                var reader = new FileReader();

                reader.onload = function (event) {

                    favicon_image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });

                };
                reader.readAsDataURL(this.files[0]);
            });

            $('#favicon_crop_image').on("click", function(event){

                favicon_image_crop.croppie('result', {
                    type: 'base64',
                    size: 'viewport'
                }).then(function(response){
                    $('#favicon_image').val(response);
                    $('#favicon_image_preview').attr("src", response);
                });

                $('#favicon-image-crop-modal').modal('hide');
            });
            /**
             * End the croppie image plugin for favicon
             */

            <?php if($site_global_settings->setting_site_map == \App\Setting::SITE_MAP_OPEN_STREET_MAP): ?>
            /**
             * Start map modal
             */
            var map = L.map('map-modal-body', {
                //center: [37.0902, -95.7129],
                center: [<?php echo e($settings->setting_site_location_lat); ?>, <?php echo e($settings->setting_site_location_lng); ?>],
                zoom: 5,
            });

            var layerGroup = L.layerGroup().addTo(map);
            var current_lat = 0;
            var current_lng = 0;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            map.on('click', function(e) {

                // remove all the markers in one go
                layerGroup.clearLayers();
                L.marker([e.latlng.lat, e.latlng.lng]).addTo(layerGroup);

                current_lat = e.latlng.lat;
                current_lng = e.latlng.lng;

                $('#lat_lng_span').text("Lat, Lng : " + e.latlng.lat + ", " + e.latlng.lng);
            });

            $('#lat_lng_confirm').on('click', function(){

                $('#setting_site_location_lat').val(current_lat);
                $('#setting_site_location_lng').val(current_lng);
                $('#map-modal').modal('hide')
            });
            $('.lat_lng_select_button').on('click', function(){
                $('#map-modal').modal('show');
                setTimeout(function(){ map.invalidateSize()}, 500);
            });
            /**
             * End map modal
             */
            <?php endif; ?>

            /**
             * Start delete logo image button
             */
            $('#delete_setting_logo_image_button').on('click', function(){

                $('#delete_setting_logo_image_button').attr("disabled", true);

                var ajax_url = '/ajax/setting/logo/delete';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: ajax_url,
                    method: 'post',
                    data: {
                    },
                    success: function(result){
                        console.log(result);

                        $('#image_preview').attr("src", "<?php echo e(asset('backend/images/placeholder/full_item_feature_image.webp')); ?>");
                        $('#feature_image').val("");

                        $('#delete_setting_logo_image_button').attr("disabled", false);
                    }});
            });
            /**
             * End delete logo image button
             */

            /**
             * Start delete favicon image button
             */
            $('#delete_setting_favicon_image_button').on('click', function(){

                $('#delete_setting_favicon_image_button').attr("disabled", true);

                var ajax_url = '/ajax/setting/favicon/delete';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: ajax_url,
                    method: 'post',
                    data: {
                    },
                    success: function(result){
                        console.log(result);

                        $('#favicon_image_preview').attr("src", "data:image/png;base64,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");
                        $('#favicon_image').val("");

                        $('#delete_setting_favicon_image_button').attr("disabled", false);
                    }});
            });
            /**
             * End delete favicon image button
             */
        });
    </script>

    <?php if($site_global_settings->setting_site_map == \App\Setting::SITE_MAP_GOOGLE_MAP): ?>

        <script>
            function initMap()
            {
                const myLatlng = { lat: <?php echo e($settings->setting_site_location_lat); ?>, lng: <?php echo e($settings->setting_site_location_lng); ?> };
                const map = new google.maps.Map(document.getElementById('map-modal-body'), {
                    zoom: 4,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                let infoWindow = new google.maps.InfoWindow({
                    content: "<?php echo e(__('google_map.select-lat-lng-on-map')); ?>",
                    position: myLatlng,
                });
                infoWindow.open(map);

                var current_lat = 0;
                var current_lng = 0;

                google.maps.event.addListener(map, 'click', function( event ){

                    // Close the current InfoWindow.
                    infoWindow.close();
                    // Create a new InfoWindow.
                    infoWindow = new google.maps.InfoWindow({
                        position: event.latLng,
                    });
                    infoWindow.setContent(
                        JSON.stringify(event.latLng.toJSON(), null, 2)
                    );
                    infoWindow.open(map);

                    current_lat = event.latLng.lat();
                    current_lng = event.latLng.lng();
                    console.log( "Latitude: "+current_lat+" "+", longitude: "+current_lng );
                    $('#lat_lng_span').text("Lat, Lng : " + current_lat + ", " + current_lng);
                });

                $('#lat_lng_confirm').on('click', function(){

                    $('#setting_site_location_lat').val(current_lat);
                    $('#setting_site_location_lng').val(current_lng);
                    $('#map-modal').modal('hide')
                });
                $('.lat_lng_select_button').on('click', function(){
                    $('#map-modal').modal('show');
                    //setTimeout(function(){ map.invalidateSize()}, 500);
                });
            }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js??v=quarterly&key=<?php echo e($site_global_settings->setting_site_map_google_api_key); ?>&callback=initMap"></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/general/edit.blade.php ENDPATH**/ ?>