

<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('backend/vendor/rateyo/jquery.rateyo.min.css')); ?>" rel="stylesheet" />

    <!-- searchable selector -->
    <link href="<?php echo e(asset('backend/vendor/bootstrap-select/bootstrap-select.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800"><?php echo e(__('backend.item.item')); ?></h1>
            <p class="mb-4"><?php echo e(__('backend.item.item-desc-user')); ?></p>
        </div>
        <div class="col-3 text-right">
            <a href="<?php echo e(route('user.items.create')); ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?php echo e(__('backend.item.add-item')); ?></span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-md-10">

                    <div class="row pb-2">
                        <div class="col-12">
                            <span class="text-gray-800">
                                <?php echo e(number_format($items_count) . ' ' . __('category_description.records')); ?>

                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="bg-info text-white">
                                        <th><?php echo e(__('importer_csv.select')); ?></th>
                                        <th><?php echo e(__('backend.item.item')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items_key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input items_table_index_checkbox" type="checkbox" id="item_index_data_checkbox_<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>">
                                                </div>
                                            </td>
                                            <td>

                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <?php if(!empty($item->item_image_tiny)): ?>
                                                            <img src="<?php echo e(url('storage/item/' . $item->item_image_tiny)); ?>" alt="Image" class="img-fluid rounded">
                                                        <?php elseif(!empty($item->item_image)): ?>
                                                            <img src="<?php echo e(url('storage/item/' . $item->item_image)); ?>" alt="Image" class="img-fluid rounded">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('backend/images/placeholder/full_item_feature_image_tiny.webp')); ?>" alt="Image" class="img-fluid rounded">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <?php if($item->item_status == \App\Item::ITEM_SUBMITTED): ?>
                                                            <span class="text-warning"><i class="fas fa-exclamation-circle"></i></span>
                                                        <?php elseif($item->item_status == \App\Item::ITEM_PUBLISHED): ?>
                                                            <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                        <?php elseif($item->item_status == \App\Item::ITEM_SUSPENDED): ?>
                                                            <span class="text-danger"><i class="fas fa-ban"></i></span>
                                                        <?php endif; ?>
                                                        <span class="text-gray-800"><?php echo e($item->item_title); ?></span>
                                                        <?php if($item->item_featured == \App\Item::ITEM_FEATURED): ?>
                                                            <span class="text-white bg-info pl-1 pr-1 rounded"><?php echo e(__('prefer_country.featured')); ?></span>
                                                        <?php endif; ?>
                                                        <div class="pt-1 pl-0 rating_stars rating_stars_<?php echo e($item->item_slug); ?>" data-id="rating_stars_<?php echo e($item->item_slug); ?>" data-rating="<?php echo e(empty($item->item_average_rating) ? 0 : $item->item_average_rating); ?>"></div>
                                                        <span>
                                                            <?php echo e('(' . $item->getCountRating() . ' ' . __('review.frontend.reviews') . ')'); ?>

                                                        </span>

                                                        <br>
                                                        <?php if($item->item_type == \App\Item::ITEM_TYPE_REGULAR): ?>
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <?php echo e($item->item_address); ?>,
                                                            <?php echo e($item->city->city_name); ?>,
                                                            <?php echo e($item->state->state_name); ?>,
                                                            <?php echo e($item->country->country_name); ?>

                                                            <?php echo e($item->item_postal_code); ?>

                                                        <?php else: ?>
                                                            <span class="bg-primary text-white pl-1 pr-1 rounded"><?php echo e(__('theme_directory_hub.online-listing.online-listing')); ?></span>
                                                        <?php endif; ?>

                                                        <div class="pt-2">
                                                            <?php $__currentLoopData = $item->allCategories()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories_key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="border border-info text-info pl-1 pr-1 rounded"><?php echo e($category->category_name); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <hr class="mt-3 mb-2">
                                                        <?php if($item->item_status == \App\Item::ITEM_PUBLISHED): ?>
                                                        <a href="<?php echo e(route('page.item', $item->item_slug)); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            <?php echo e(__('prefer_country.view-item')); ?>

                                                        </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo e(route('user.items.edit', $item->id)); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="far fa-edit"></i>
                                                            <?php echo e(__('backend.shared.edit')); ?>

                                                        </a>
                                                        <hr class="mt-2 mb-2">
                                                        <span class="text-info">
                                                            <i class="far fa-plus-square"></i>
                                                            <?php echo e(__('review.backend.posted-at') . ' ' . \Carbon\Carbon::parse($item->created_at)->diffForHumans()); ?>

                                                        </span>
                                                        <?php if($item->created_at != $item->updated_at): ?>
                                                            <span class="text-info">
                                                                |
                                                                <i class="far fa-edit"></i>
                                                                <?php echo e(__('review.backend.updated-at') . ' ' . \Carbon\Carbon::parse($item->updated_at)->diffForHumans()); ?>

                                                            </span>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-8">
                            <button id="select_all_button" class="btn btn-sm btn-primary text-white">
                                <i class="far fa-check-square"></i>
                                <?php echo e(__('admin_users_table.shared.select-all')); ?>

                            </button>
                            <button id="un_select_all_button" class="btn btn-sm btn-primary text-white">
                                <i class="far fa-square"></i>
                                <?php echo e(__('admin_users_table.shared.un-select-all')); ?>

                            </button>
                        </div>
                        <div class="col-12 col-md-4 text-right">
                            <div class="dropdown">
                                <button class="btn btn-info btn-sm dropdown-toggle text-white" type="button" id="table_option_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-tasks"></i>
                                    <?php echo e(__('admin_users_table.shared.options')); ?>

                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="table_option_dropdown">
                                    <button class="dropdown-item text-danger" type="button" data-toggle="modal" data-target="#deleteModal">
                                        <i class="far fa-trash-alt"></i>
                                        <?php echo e(__('item_index.delete-selected')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <?php echo e($pagination->links()); ?>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2 pt-3 border-left-info">

                    <div class="row mb-3">
                        <div class="col-12">
                            <span class="text-gray-800">
                                <i class="fas fa-filter"></i>
                                <?php echo e(__('listings_filter.filters')); ?>

                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <form method="GET" action="<?php echo e(route('user.items.index')); ?>">

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="search_query" class="text-black"><?php echo e(__('frontend.search.search')); ?></label>
                                        <input id="search_query" type="text" class="form-control <?php $__errorArgs = ['search_query'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="search_query" value="<?php echo e($search_query); ?>">
                                        <?php $__errorArgs = ['search_query'];
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
                                        <label for="filter_categories" class="text-gray-800"><?php echo e(__('listings_filter.categories')); ?></label>

                                        <?php $__currentLoopData = $all_printable_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $all_printable_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check filter_category_div">
                                                <input <?php echo e(in_array($all_printable_category['category_id'], $filter_categories) ? 'checked' : ''); ?> name="filter_categories[]" class="form-check-input" type="checkbox" value="<?php echo e($all_printable_category['category_id']); ?>" id="filter_categories_<?php echo e($all_printable_category['category_id']); ?>">
                                                <label class="form-check-label" for="filter_categories_<?php echo e($all_printable_category['category_id']); ?>">
                                                    <?php echo e($all_printable_category['category_name']); ?>

                                                </label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <a href="javascript:;" class="show_more"><?php echo e(__('listings_filter.show-more')); ?></a>
                                        <?php $__errorArgs = ['filter_categories'];
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

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="text-gray-800" for="filter_country"><?php echo e(__('backend.setting.country')); ?></label>
                                        <select class="selectpicker form-control <?php $__errorArgs = ['filter_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="filter_country" id="filter_country" data-live-search="true">
                                            <option value="" <?php echo e(empty($filter_country) ? 'selected' : ''); ?>><?php echo e(__('prefer_country.all-country')); ?></option>
                                            <?php $__currentLoopData = $all_countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_countries_key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->id); ?>" <?php echo e($filter_country == $country->id ? 'selected' : ''); ?>><?php echo e($country->country_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['filter_country'];
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
                                        <label class="text-gray-800" for="filter_state"><?php echo e(__('backend.state.state')); ?></label>
                                        <select class="selectpicker form-control <?php $__errorArgs = ['filter_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="filter_state" id="filter_state" data-live-search="true">
                                            <option value="" <?php echo e(empty($filter_state) ? 'selected' : ''); ?>><?php echo e(__('prefer_country.all-state')); ?></option>
                                            <?php $__currentLoopData = $all_states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_states_key => $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($state->id); ?>" <?php echo e($filter_state == $state->id ? 'selected' : ''); ?>><?php echo e($state->state_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['filter_state'];
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
                                        <label class="text-gray-800" for="filter_city"><?php echo e(__('backend.city.city')); ?></label>
                                        <select class="selectpicker form-control <?php $__errorArgs = ['filter_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="filter_city" id="filter_city" data-live-search="true">
                                            <option value="" <?php echo e(empty($filter_city) ? 'selected' : ''); ?>><?php echo e(__('prefer_country.all-city')); ?></option>
                                            <?php $__currentLoopData = $all_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_cities_key => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($city->id); ?>" <?php echo e($filter_city == $city->id ? 'selected' : ''); ?>><?php echo e($city->city_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['filter_city'];
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

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="text-gray-800"><?php echo e(__('backend.item.item')); ?></label>

                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_SUBMITTED, $filter_item_status) ? 'checked' : ''); ?> name="filter_item_status[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_SUBMITTED); ?>" id="filter_item_status_<?php echo e(\App\Item::ITEM_SUBMITTED); ?>">
                                            <label class="form-check-label" for="filter_item_status_<?php echo e(\App\Item::ITEM_SUBMITTED); ?>">
                                                <?php echo e(__('backend.item.submitted')); ?>

                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_PUBLISHED, $filter_item_status) ? 'checked' : ''); ?> name="filter_item_status[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_PUBLISHED); ?>" id="filter_item_status_<?php echo e(\App\Item::ITEM_PUBLISHED); ?>">
                                            <label class="form-check-label" for="filter_item_status_<?php echo e(\App\Item::ITEM_PUBLISHED); ?>">
                                                <?php echo e(__('backend.item.published')); ?>

                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_SUSPENDED, $filter_item_status) ? 'checked' : ''); ?> name="filter_item_status[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_SUSPENDED); ?>" id="filter_item_status_<?php echo e(\App\Item::ITEM_SUSPENDED); ?>">
                                            <label class="form-check-label" for="filter_item_status_<?php echo e(\App\Item::ITEM_SUSPENDED); ?>">
                                                <?php echo e(__('backend.item.suspended')); ?>

                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['filter_item_status'];
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

                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_FEATURED, $filter_item_featured) ? 'checked' : ''); ?> name="filter_item_featured[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_FEATURED); ?>" id="filter_item_featured_<?php echo e(\App\Item::ITEM_FEATURED); ?>">
                                            <label class="form-check-label" for="filter_item_featured_<?php echo e(\App\Item::ITEM_FEATURED); ?>">
                                                <?php echo e(__('prefer_country.featured')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_NOT_FEATURED, $filter_item_featured) ? 'checked' : ''); ?> name="filter_item_featured[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_NOT_FEATURED); ?>" id="filter_item_featured_<?php echo e(\App\Item::ITEM_NOT_FEATURED); ?>">
                                            <label class="form-check-label" for="filter_item_featured_<?php echo e(\App\Item::ITEM_NOT_FEATURED); ?>">
                                                <?php echo e(__('prefer_country.not-featured')); ?>

                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['filter_item_featured'];
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

                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_TYPE_REGULAR, $filter_item_type) ? 'checked' : ''); ?> name="filter_item_type[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_TYPE_REGULAR); ?>" id="filter_item_type_<?php echo e(\App\Item::ITEM_TYPE_REGULAR); ?>">
                                            <label class="form-check-label" for="filter_item_type_<?php echo e(\App\Item::ITEM_TYPE_REGULAR); ?>">
                                                <?php echo e(__('theme_directory_hub.online-listing.regular-listing')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo e(in_array(\App\Item::ITEM_TYPE_ONLINE, $filter_item_type) ? 'checked' : ''); ?> name="filter_item_type[]" class="form-check-input" type="checkbox" value="<?php echo e(\App\Item::ITEM_TYPE_ONLINE); ?>" id="filter_item_type_<?php echo e(\App\Item::ITEM_TYPE_ONLINE); ?>">
                                            <label class="form-check-label" for="filter_item_type_<?php echo e(\App\Item::ITEM_TYPE_ONLINE); ?>">
                                                <?php echo e(__('theme_directory_hub.online-listing.online-listing')); ?>

                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['filter_item_type'];
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

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="text-gray-800" for="filter_sort_by"><?php echo e(__('listings_filter.sort-by')); ?></label>
                                        <select class="selectpicker form-control <?php $__errorArgs = ['filter_sort_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="filter_sort_by" id="filter_sort_by">
                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_NEWEST_CREATED); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_NEWEST_CREATED ? 'selected' : ''); ?>><?php echo e(__('prefer_country.item-sort-by-newest-created')); ?></option>
                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_OLDEST_CREATED); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_OLDEST_CREATED ? 'selected' : ''); ?>><?php echo e(__('prefer_country.item-sort-by-oldest-created')); ?></option>

                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_NEWEST_UPDATED); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_NEWEST_UPDATED ? 'selected' : ''); ?>><?php echo e(__('prefer_country.item-sort-by-newest-updated')); ?></option>
                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_OLDEST_UPDATED); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_OLDEST_UPDATED ? 'selected' : ''); ?>><?php echo e(__('prefer_country.item-sort-by-oldest-updated')); ?></option>

                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_HIGHEST_RATING); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_HIGHEST_RATING ? 'selected' : ''); ?>><?php echo e(__('listings_filter.sort-by-highest')); ?></option>
                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_LOWEST_RATING); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_LOWEST_RATING ? 'selected' : ''); ?>><?php echo e(__('listings_filter.sort-by-lowest')); ?></option>

                                            <option value="<?php echo e(\App\Item::ITEMS_SORT_BY_MOST_RELEVANT); ?>" <?php echo e($filter_sort_by == \App\Item::ITEMS_SORT_BY_MOST_RELEVANT ? 'selected' : ''); ?>><?php echo e(__('item_search.most-relevant')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['filter_sort_by'];
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
                                        <label class="text-gray-800" for="filter_count_per_page"><?php echo e(__('prefer_country.rows-per-page')); ?></label>
                                        <select class="selectpicker form-control <?php $__errorArgs = ['filter_count_per_page'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="filter_count_per_page" id="filter_count_per_page">
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_10); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_10 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-10')); ?></option>
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_25); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_25 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-25')); ?></option>
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_50); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_50 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-50')); ?></option>
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_100); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_100 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-100')); ?></option>
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_250); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_250 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-250')); ?></option>
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_500); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_500 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-500')); ?></option>
                                            <option value="<?php echo e(\App\Item::COUNT_PER_PAGE_1000); ?>" <?php echo e($filter_count_per_page == \App\Item::COUNT_PER_PAGE_1000 ? 'selected' : ''); ?>><?php echo e(__('importer_csv.import-listing-per-page-1000')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['filter_count_per_page'];
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
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('backend.shared.update')); ?></button>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-12">
                                        <a class="btn btn-outline-primary btn-block" href="<?php echo e(route('user.items.index')); ?>">
                                            <?php echo e(__('theme_directory_hub.filter-link-reset-all')); ?>

                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Delete Item -->
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
                    <?php echo e(__('item_index.delete-selected-items-confirm')); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('backend.shared.cancel')); ?></button>

                    <form action="<?php echo e(route('user.items.bulk.delete', $request_query_array)); ?>" method="POST" id="form_delete_selected">
                        <?php echo csrf_field(); ?>
                        <button id="delete_selected_button"  class="btn btn-danger"><?php echo e(__('backend.shared.delete')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('backend/vendor/rateyo/jquery.rateyo.min.js')); ?>"></script>

    <!-- searchable selector -->
    <script src="<?php echo e(asset('backend/vendor/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <?php echo $__env->make('backend.admin.partials.bootstrap-select-locale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function() {

            "use strict";

            /**
             * Start select all button
             */
            $('#select_all_button').on('click', function () {
                $(".items_table_index_checkbox").each(function (index) {
                    $(this).prop('checked', true);
                });
            });
            /**
             * End select all button
             */

            /**
             * Start un-select all button
             */
            $('#un_select_all_button').on('click', function () {
                $(".items_table_index_checkbox").each(function (index) {
                    $(this).prop('checked', false);
                });
            });
            /**
             * End un-select all button
             */

            /**
             * Start delete selected button action
             */
            $('#delete_selected_button').on('click', function () {

                $(".items_table_index_checkbox:checked").each(function (index) {

                    var selected_checkbox_value = $(this).val();

                    $('<input>').attr({
                        type: 'hidden',
                        name: 'item_id[]',
                        value: selected_checkbox_value
                    }).appendTo('#form_delete_selected');

                });

                $("#form_delete_selected").submit();
            });
            /**
             * End delete selected button action
             */


            /**
             * Start show more/less
             */
            //this will execute on page load(to be more specific when document ready event occurs)
            if ($(".filter_category_div").length > 5)
            {
                $(".filter_category_div:gt(5)").hide();
                $(".show_more").show();
            }

            $(".show_more").on('click', function() {
                //toggle elements with class .ty-compact-list that their index is bigger than 2
                $(".filter_category_div:gt(5)").toggle();
                //change text of show more element just for demonstration purposes to this demo
                $(this).text() === "<?php echo e(__('listings_filter.show-more')); ?>" ? $(this).text("<?php echo e(__('listings_filter.show-less')); ?>") : $(this).text("<?php echo e(__('listings_filter.show-more')); ?>");
            });
            /**
             * End show more/less
             */

            /**
             * Start country, state, city selector
             */

            $('#filter_country').on('change', function() {

                if(this.value > 0)
                {
                    $('#filter_state').html("<option selected><?php echo e(__('prefer_country.loading-wait')); ?></option>");
                    $('#filter_state').selectpicker('refresh');

                    var ajax_url = '/ajax/states/' + this.value;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: ajax_url,
                        method: 'get',
                        data: {
                        },
                        success: function(result){
                            console.log(result);
                            $('#filter_state').html("<option value=''><?php echo e(__('prefer_country.all-state')); ?></option>");
                            $('#filter_city').html("<option value=''><?php echo e(__('prefer_country.all-city')); ?></option>");
                            $.each(JSON.parse(result), function(key, value) {
                                var state_id = value.id;
                                var state_name = value.state_name;
                                $('#filter_state').append('<option value="'+ state_id +'">' + state_name + '</option>');
                            });
                            $('#filter_state').selectpicker('refresh');
                        }});
                }
                else
                {
                    $('#filter_state').html("<option value=''><?php echo e(__('prefer_country.all-state')); ?></option>");
                    $('#filter_city').html("<option value=''><?php echo e(__('prefer_country.all-city')); ?></option>");
                    $('#filter_state').selectpicker('refresh');
                    $('#filter_city').selectpicker('refresh');
                }

            });


            $('#filter_state').on('change', function() {

                if(this.value > 0)
                {
                    $('#filter_city').html("<option selected><?php echo e(__('prefer_country.loading-wait')); ?></option>");
                    $('#filter_city').selectpicker('refresh');

                    var ajax_url = '/ajax/cities/' + this.value;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: ajax_url,
                        method: 'get',
                        data: {
                        },
                        success: function(result){
                            console.log(result);
                            $('#filter_city').html("<option value=''><?php echo e(__('prefer_country.all-city')); ?></option>");
                            $.each(JSON.parse(result), function(key, value) {
                                var city_id = value.id;
                                var city_name = value.city_name;
                                $('#filter_city').append('<option value="'+ city_id +'">' + city_name + '</option>');
                            });
                            $('#filter_city').selectpicker('refresh');
                        }});
                }
                else
                {
                    $('#filter_city').html("<option value=''><?php echo e(__('prefer_country.all-city')); ?></option>");
                    $('#filter_city').selectpicker('refresh');
                }

            });
            /**
             * End country, state, city selector
             */


            /**
             * Start initial rating stars for listing box elements
             */
            /*
             * NOTE: You should listen for the event before calling `rateYo` on the element
             *       or use `onInit` option to achieve the same thing
             */
            $(".rating_stars").on("rateyo.init", function (e, data) {

                console.log(e.target.getAttribute('data-id'));
                console.log(e.target.getAttribute('data-rating'));
                console.log("RateYo initialized! with " + data.rating);

                var $rateYo = $("." + e.target.getAttribute('data-id')).rateYo();
                $rateYo.rateYo("rating", e.target.getAttribute('data-rating'));

                /* set the option `multiColor` to show Multi Color Rating */
                $rateYo.rateYo("option", "spacing", "2px");
                $rateYo.rateYo("option", "starWidth", "15px");
                $rateYo.rateYo("option", "readOnly", true);

            });

            $(".rating_stars").rateYo({
                spacing: "2px",
                starWidth: "15px",
                readOnly: true,
                rating: 0
            });
            /**
             * End initial rating stars for listing box elements
             */

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/karimyca/public_html/laravel_project/resources/views/backend/user/item/index.blade.php ENDPATH**/ ?>