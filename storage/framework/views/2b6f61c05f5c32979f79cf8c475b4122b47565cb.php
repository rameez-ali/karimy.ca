<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('stripe.edit-stripe-setting')); ?></h1>
            <p class="mb-4"><?php echo e(__('stripe.edit-stripe-setting-desc')); ?></p>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="<?php echo e(route('admin.settings.payment.stripe.update')); ?>" class="">
                        <?php echo csrf_field(); ?>

                        <div class="row form-group">
                            <div class="col-12">
                                <?php if($all_stripe_settings->setting_site_stripe_enable == \App\Setting::SITE_PAYMENT_STRIPE_ENABLE): ?>
                                    <span class="pl-2 pr-2 pt-1 pb-1 bg-success text-white rounded"><?php echo e(__('stripe.stripe-enabled')); ?></span>
                                <?php else: ?>
                                    <span class="pl-2 pr-2 pt-1 pb-1 bg-warning text-white rounded"><?php echo e(__('stripe.stripe-disabled')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <span><?php echo e(__('stripe.stripe-webhook')); ?>: <?php echo e(route('user.stripe.notify')); ?></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <span><?php echo e(__('stripe.stripe-webhook-events')); ?>: <?php echo e(__('stripe.stripe-webhook-event-code')); ?></span>
                            </div>
                        </div>
                        <hr>

                        <div class="row form-group">
                            <div class="col-12">

                                <div class="custom-control custom-checkbox">
                                    <input value="<?php echo e(\App\Setting::SITE_PAYMENT_STRIPE_ENABLE); ?>" name="setting_site_stripe_enable" type="checkbox" class="custom-control-input" id="setting_site_stripe_enable" <?php echo e((old('setting_site_stripe_enable') ? old('setting_site_stripe_enable') : $all_stripe_settings->setting_site_stripe_enable) == \App\Setting::SITE_PAYMENT_STRIPE_ENABLE ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="setting_site_stripe_enable"><?php echo e(__('stripe.enable-stripe')); ?></label>
                                </div>
                                <?php $__errorArgs = ['setting_site_stripe_enable'];
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
                            <div class="col-md-6 col-sm-12">

                                <label class="text-black" for="setting_site_stripe_publishable_key"><?php echo e(__('stripe.stripe-publishable-key')); ?></label>
                                <input id="setting_site_stripe_publishable_key" type="text" class="form-control <?php $__errorArgs = ['setting_site_stripe_publishable_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_stripe_publishable_key" value="<?php echo e(old('setting_site_stripe_publishable_key') ? old('setting_site_stripe_publishable_key') : $all_stripe_settings->setting_site_stripe_publishable_key); ?>">
                                <?php $__errorArgs = ['setting_site_stripe_publishable_key'];
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

                            <div class="col-md-6 col-sm-12">

                                <label class="text-black" for="setting_site_stripe_secret_key"><?php echo e(__('stripe.stripe-secret-key')); ?></label>
                                <input id="setting_site_stripe_secret_key" type="text" class="form-control <?php $__errorArgs = ['setting_site_stripe_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_stripe_secret_key" value="<?php echo e(old('setting_site_stripe_secret_key') ? old('setting_site_stripe_secret_key') : $all_stripe_settings->setting_site_stripe_secret_key); ?>">
                                <?php $__errorArgs = ['setting_site_stripe_secret_key'];
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

                            <div class="col-md-6 col-sm-12">

                                <label class="text-black" for="setting_site_stripe_webhook_signing_secret"><?php echo e(__('stripe.stripe-webhook-signing-secret')); ?></label>
                                <input id="setting_site_stripe_webhook_signing_secret" type="text" class="form-control <?php $__errorArgs = ['setting_site_stripe_webhook_signing_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_stripe_webhook_signing_secret" value="<?php echo e(old('setting_site_stripe_webhook_signing_secret') ? old('setting_site_stripe_webhook_signing_secret') : $all_stripe_settings->setting_site_stripe_webhook_signing_secret); ?>">
                                <?php $__errorArgs = ['setting_site_stripe_webhook_signing_secret'];
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

                            <div class="col-md-6 col-sm-12">
                                <label class="text-black" for="setting_site_stripe_currency"><?php echo e(__('backend.setting.currency')); ?></label>
                                <select class="custom-select <?php $__errorArgs = ['setting_site_stripe_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="setting_site_stripe_currency">
                                    <option value="usd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'usd' ? 'selected' : ''); ?>>usd</option>
                                    <option value="aed" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'aed' ? 'selected' : ''); ?>>aed</option>
                                    <option value="afn" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'afn' ? 'selected' : ''); ?>>afn</option>
                                    <option value="all" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'all' ? 'selected' : ''); ?>>all</option>
                                    <option value="amd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'amd' ? 'selected' : ''); ?>>amd</option>
                                    <option value="ang" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ang' ? 'selected' : ''); ?>>ang</option>
                                    <option value="aoa" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'aoa' ? 'selected' : ''); ?>>aoa</option>
                                    <option value="ars" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ars' ? 'selected' : ''); ?>>ars</option>
                                    <option value="aud" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'aud' ? 'selected' : ''); ?>>aud</option>
                                    <option value="awg" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'awg' ? 'selected' : ''); ?>>awg</option>
                                    <option value="azn" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'azn' ? 'selected' : ''); ?>>azn</option>
                                    <option value="bam" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bam' ? 'selected' : ''); ?>>bam</option>
                                    <option value="bbd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bbd' ? 'selected' : ''); ?>>bbd</option>
                                    <option value="bdt" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bdt' ? 'selected' : ''); ?>>bdt</option>
                                    <option value="bgn" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bgn' ? 'selected' : ''); ?>>bgn</option>
                                    <option value="bif" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bif' ? 'selected' : ''); ?>>bif</option>
                                    <option value="bmd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bmd' ? 'selected' : ''); ?>>bmd</option>
                                    <option value="bnd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bnd' ? 'selected' : ''); ?>>bnd</option>
                                    <option value="bob" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bob' ? 'selected' : ''); ?>>bob</option>
                                    <option value="brl" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'brl' ? 'selected' : ''); ?>>brl</option>
                                    <option value="bsd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bsd' ? 'selected' : ''); ?>>bsd</option>
                                    <option value="bwp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bwp' ? 'selected' : ''); ?>>bwp</option>
                                    <option value="bzd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'bzd' ? 'selected' : ''); ?>>bzd</option>
                                    <option value="cad" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'cad' ? 'selected' : ''); ?>>cad</option>
                                    <option value="cdf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'cdf' ? 'selected' : ''); ?>>cdf</option>
                                    <option value="chf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'chf' ? 'selected' : ''); ?>>chf</option>
                                    <option value="clp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'clp' ? 'selected' : ''); ?>>clp</option>
                                    <option value="cny" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'cny' ? 'selected' : ''); ?>>cny</option>
                                    <option value="cop" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'cop' ? 'selected' : ''); ?>>cop</option>
                                    <option value="crc" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'crc' ? 'selected' : ''); ?>>crc</option>
                                    <option value="cve" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'cve' ? 'selected' : ''); ?>>cve</option>
                                    <option value="czk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'czk' ? 'selected' : ''); ?>>czk</option>
                                    <option value="djf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'djf' ? 'selected' : ''); ?>>djf</option>
                                    <option value="dkk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'dkk' ? 'selected' : ''); ?>>dkk</option>
                                    <option value="dop" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'dop' ? 'selected' : ''); ?>>dop</option>
                                    <option value="dzd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'dzd' ? 'selected' : ''); ?>>dzd</option>
                                    <option value="egp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'egp' ? 'selected' : ''); ?>>egp</option>
                                    <option value="etb" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'etb' ? 'selected' : ''); ?>>etb</option>
                                    <option value="eur" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'eur' ? 'selected' : ''); ?>>eur</option>
                                    <option value="fjd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'fjd' ? 'selected' : ''); ?>>fjd</option>
                                    <option value="fkp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'fkp' ? 'selected' : ''); ?>>fkp</option>
                                    <option value="gbp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gbp' ? 'selected' : ''); ?>>gbp</option>
                                    <option value="gel" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gel' ? 'selected' : ''); ?>>gel</option>
                                    <option value="gip" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gip' ? 'selected' : ''); ?>>gip</option>
                                    <option value="gmd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gmd' ? 'selected' : ''); ?>>gmd</option>
                                    <option value="gnf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gnf' ? 'selected' : ''); ?>>gnf</option>
                                    <option value="gtq" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gtq' ? 'selected' : ''); ?>>gtq</option>
                                    <option value="gyd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'gyd' ? 'selected' : ''); ?>>gyd</option>
                                    <option value="hkd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'hkd' ? 'selected' : ''); ?>>hkd</option>
                                    <option value="hnl" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'hnl' ? 'selected' : ''); ?>>hnl</option>
                                    <option value="hrk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'hrk' ? 'selected' : ''); ?>>hrk</option>
                                    <option value="htg" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'htg' ? 'selected' : ''); ?>>htg</option>
                                    <option value="huf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'huf' ? 'selected' : ''); ?>>huf</option>
                                    <option value="idr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'idr' ? 'selected' : ''); ?>>idr</option>
                                    <option value="ils" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ils' ? 'selected' : ''); ?>>ils</option>
                                    <option value="inr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'inr' ? 'selected' : ''); ?>>inr</option>
                                    <option value="isk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'isk' ? 'selected' : ''); ?>>isk</option>
                                    <option value="jmd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'jmd' ? 'selected' : ''); ?>>jmd</option>
                                    <option value="jpy" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'jpy' ? 'selected' : ''); ?>>jpy</option>
                                    <option value="kes" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'kes' ? 'selected' : ''); ?>>kes</option>
                                    <option value="kgs" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'kgs' ? 'selected' : ''); ?>>kgs</option>
                                    <option value="khr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'khr' ? 'selected' : ''); ?>>khr</option>
                                    <option value="kmf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'kmf' ? 'selected' : ''); ?>>kmf</option>
                                    <option value="krw" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'krw' ? 'selected' : ''); ?>>krw</option>
                                    <option value="kyd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'kyd' ? 'selected' : ''); ?>>kyd</option>
                                    <option value="kzt" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'kzt' ? 'selected' : ''); ?>>kzt</option>
                                    <option value="lak" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'lak' ? 'selected' : ''); ?>>lak</option>
                                    <option value="lbp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'lbp' ? 'selected' : ''); ?>>lbp</option>
                                    <option value="lkr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'lkr' ? 'selected' : ''); ?>>lkr</option>
                                    <option value="lrd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'lrd' ? 'selected' : ''); ?>>lrd</option>
                                    <option value="lsl" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'lsl' ? 'selected' : ''); ?>>lsl</option>
                                    <option value="mad" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mad' ? 'selected' : ''); ?>>mad</option>
                                    <option value="mdl" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mdl' ? 'selected' : ''); ?>>mdl</option>
                                    <option value="mga" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mga' ? 'selected' : ''); ?>>mga</option>
                                    <option value="mkd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mkd' ? 'selected' : ''); ?>>mkd</option>
                                    <option value="mmk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mmk' ? 'selected' : ''); ?>>mmk</option>
                                    <option value="mnt" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mnt' ? 'selected' : ''); ?>>mnt</option>
                                    <option value="mop" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mop' ? 'selected' : ''); ?>>mop</option>
                                    <option value="mro" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mro' ? 'selected' : ''); ?>>mro</option>
                                    <option value="mur" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mur' ? 'selected' : ''); ?>>mur</option>
                                    <option value="mvr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mvr' ? 'selected' : ''); ?>>mvr</option>
                                    <option value="mwk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mwk' ? 'selected' : ''); ?>>mwk</option>
                                    <option value="mxn" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mxn' ? 'selected' : ''); ?>>mxn</option>
                                    <option value="myr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'myr' ? 'selected' : ''); ?>>myr</option>
                                    <option value="mzn" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'mzn' ? 'selected' : ''); ?>>mzn</option>
                                    <option value="nad" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'nad' ? 'selected' : ''); ?>>nad</option>
                                    <option value="ngn" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ngn' ? 'selected' : ''); ?>>ngn</option>
                                    <option value="nio" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'nio' ? 'selected' : ''); ?>>nio</option>
                                    <option value="nok" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'nok' ? 'selected' : ''); ?>>nok</option>
                                    <option value="npr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'npr' ? 'selected' : ''); ?>>npr</option>
                                    <option value="nzd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'nzd' ? 'selected' : ''); ?>>nzd</option>
                                    <option value="pab" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'pab' ? 'selected' : ''); ?>>pab</option>
                                    <option value="pen" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'pen' ? 'selected' : ''); ?>>pen</option>
                                    <option value="pgk" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'pgk' ? 'selected' : ''); ?>>pgk</option>
                                    <option value="php" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'php' ? 'selected' : ''); ?>>php</option>
                                    <option value="pkr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'pkr' ? 'selected' : ''); ?>>pkr</option>
                                    <option value="pln" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'pln' ? 'selected' : ''); ?>>pln</option>
                                    <option value="pyg" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'pyg' ? 'selected' : ''); ?>>pyg</option>
                                    <option value="qar" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'qar' ? 'selected' : ''); ?>>qar</option>
                                    <option value="ron" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ron' ? 'selected' : ''); ?>>ron</option>
                                    <option value="rsd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'rsd' ? 'selected' : ''); ?>>rsd</option>
                                    <option value="rub" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'rub' ? 'selected' : ''); ?>>rub</option>
                                    <option value="rwf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'rwf' ? 'selected' : ''); ?>>rwf</option>
                                    <option value="sar" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'sar' ? 'selected' : ''); ?>>sar</option>
                                    <option value="sbd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'sbd' ? 'selected' : ''); ?>>sbd</option>
                                    <option value="scr" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'scr' ? 'selected' : ''); ?>>scr</option>
                                    <option value="sek" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'sek' ? 'selected' : ''); ?>>sek</option>
                                    <option value="sgd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'sgd' ? 'selected' : ''); ?>>sgd</option>
                                    <option value="shp" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'shp' ? 'selected' : ''); ?>>shp</option>
                                    <option value="sll" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'sll' ? 'selected' : ''); ?>>sll</option>
                                    <option value="sos" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'sos' ? 'selected' : ''); ?>>sos</option>
                                    <option value="srd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'srd' ? 'selected' : ''); ?>>srd</option>
                                    <option value="std" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'std' ? 'selected' : ''); ?>>std</option>
                                    <option value="szl" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'szl' ? 'selected' : ''); ?>>szl</option>
                                    <option value="thb" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'thb' ? 'selected' : ''); ?>>thb</option>
                                    <option value="tjs" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'tjs' ? 'selected' : ''); ?>>tjs</option>
                                    <option value="top" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'top' ? 'selected' : ''); ?>>top</option>
                                    <option value="try" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'try' ? 'selected' : ''); ?>>try</option>
                                    <option value="ttd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ttd' ? 'selected' : ''); ?>>ttd</option>
                                    <option value="twd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'twd' ? 'selected' : ''); ?>>twd</option>
                                    <option value="tzs" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'tzs' ? 'selected' : ''); ?>>tzs</option>
                                    <option value="uah" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'uah' ? 'selected' : ''); ?>>uah</option>
                                    <option value="ugx" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'ugx' ? 'selected' : ''); ?>>ugx</option>
                                    <option value="uyu" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'uyu' ? 'selected' : ''); ?>>uyu</option>
                                    <option value="uzs" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'uzs' ? 'selected' : ''); ?>>uzs</option>
                                    <option value="vnd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'vnd' ? 'selected' : ''); ?>>vnd</option>
                                    <option value="vuv" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'vuv' ? 'selected' : ''); ?>>vuv</option>
                                    <option value="wst" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'wst' ? 'selected' : ''); ?>>wst</option>
                                    <option value="xaf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'xaf' ? 'selected' : ''); ?>>xaf</option>
                                    <option value="xcd" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'xcd' ? 'selected' : ''); ?>>xcd</option>
                                    <option value="xof" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'xof' ? 'selected' : ''); ?>>xof</option>
                                    <option value="xpf" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'xpf' ? 'selected' : ''); ?>>xpf</option>
                                    <option value="yer" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'yer' ? 'selected' : ''); ?>>yer</option>
                                    <option value="zar" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'zar' ? 'selected' : ''); ?>>zar</option>
                                    <option value="zmw" <?php echo e($all_stripe_settings->setting_site_stripe_currency == 'zmw' ? 'selected' : ''); ?>>zmw</option>
                                </select>
                                <small class="form-text text-muted">
                                    <?php echo e(__('stripe.stripe-currency-help')); ?>

                                </small>
                                <?php $__errorArgs = ['setting_site_stripe_currency'];
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

<?php echo $__env->make('backend.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/admin/setting/payment/stripe/edit.blade.php ENDPATH**/ ?>