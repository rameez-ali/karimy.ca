@extends('backend.user.layouts.app')

@section('styles')
    <!-- Image Crop Css -->
    <link href="{{ asset('backend/vendor/croppie/croppie.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.user.edit-profile') }}</h1>
            <p class="mb-4">{{ __('backend.user.edit-profile-desc') }}</p>
        </div>
        <div class="col-3 text-right">
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6">
                    <form method="POST" action="{{ route('user.profile.update') }}" class="">
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="name" class="text-black">{{ __('backend.user.user-name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $login_user->name }}" autofocus>
                                @error('name')
                                <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="email">{{ __('backend.user.user-email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $login_user->email }}">
                                @error('email')
                                <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="user_about">{{ __('backend.user.user-about') }}</label>
                                <textarea rows="4" id="user_about" class="form-control @error('user_about') is-invalid @enderror" name="user_about">{{ old('user_about') ? old('user_about') : $login_user->user_about }}</textarea>
                                @error('user_about')
                                <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">

                                <label class="text-black" for="user_prefer_language">{{ __('backend.setting.language.language') }}</label>
                                <select class="custom-select @error('user_prefer_language') is-invalid @enderror" name="user_prefer_language">
                                    <option value="">{{ __('backend.setting.language.select-language') }}</option>

                                    @foreach(\App\Setting::LANGUAGES as $setting_languages_key => $language)
                                        @if($site_global_settings->settingLanguage->$language == \App\SettingLanguage::LANGUAGE_ENABLE)
                                        <option value="{{ $setting_languages_key }}" {{ (old('user_prefer_language') ? old('user_prefer_language') : $login_user->user_prefer_language) == $setting_languages_key ? 'selected' : '' }}>
                                            {{ __('prefer_languages.' . $setting_languages_key) }}
                                        </option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('user_prefer_language')
                                <span class="invalid-tooltip">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="user_prefer_country_id">State</label>
                                <select class="custom-select @error('user_prefer_country_id') is-invalid @enderror" name="state">
                                        <option value="Alberta" {{$login_user->state == "Alberta"  ? 'selected' : ''}}>Alberta</option>
                                        <option value="British Columbia" {{$login_user->state == "British Columbia"  ? 'selected' : ''}}>British Columbia</option>
                                        <option value="Manitoba" {{$login_user->state == "Manitoba"  ? 'selected' : ''}}>Manitoba</option>
                                        <option value="New Brunswick" {{$login_user->state == "New Brunswick"  ? 'selected' : ''}}>New Brunswick</option>
                                        <option value="Newfoundland and Labrador" {{$login_user->state == "Newfoundland and Labrador"  ? 'selected' : ''}}>Newfoundland and Labrador</option>
                                        <option value="Nova Scotia" {{$login_user->state == "Nova Scotia"  ? 'selected' : ''}}>Nova Scotia</option>
                                        <option value="Nunavut" {{$login_user->state == "Nunavut"  ? 'selected' : ''}}>Nunavut</option>
                                        <option value="Ontario" {{$login_user->state == "Ontario"  ? 'selected' : ''}}>Ontario</option>
                                        <option value="Prince Edward Island" {{$login_user->state == "Prince Edward Island"  ? 'selected' : ''}}>Prince Edward Island</option>
                                        <option value="Quebec" {{$login_user->state == "Quebec"  ? 'selected' : ''}}>Quebec</option>
                                        <option value="Saskatchewan" {{$login_user->state == "Saskatchewan"  ? 'selected' : ''}}>Saskatchewan</option>
                                        <option value="Yukon" {{$login_user->state == "Yukon"  ? 'selected' : ''}}>Yukon</option>
                                    </select>
                                </select>
                                @error('user_prefer_country_id')
                                <span class="invalid-tooltip">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="row form-group">

                            <div class="col-md-6">
                                <span class="text-lg text-gray-800">{{ __('backend.user.profile-image') }}</span>
                                <small class="form-text text-muted">
                                    {{ __('backend.user.profile-image-help') }}
                                </small>
                                @error('user_image')
                                <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="row mt-3">
                                    <div class="col-8">
                                        <button id="upload_image" type="button" class="btn btn-primary btn-block mb-2">{{ __('backend.user.select-image') }}</button>
                                        @if(empty($login_user->user_image))
                                            <img id="image_preview" src="{{ asset('backend/images/placeholder/profile-' . intval($login_user->id % 10) . '.webp') }}" class="img-responsive">
                                        @else
                                            <img id="image_preview" src="{{ url('storage/user/user_image/'. $login_user->user_image) }}" class="img-responsive">
                                        @endif
                                        <input id="feature_image" type="hidden" name="user_image">
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-8">
                                        <a class="btn btn-danger btn-block text-white" id="delete_user_profile_image_button">
                                            <i class="fas fa-trash-alt"></i>
                                            {{ __('role_permission.user.delete-profile-image') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr/>

                        <div class="row form-group justify-content-between">
                            <div class="col-8">
                                <button type="submit" class="btn btn-success text-white">
                                    {{ __('backend.shared.update') }}
                                </button>
                            </div>
                            <div class="col-4 text-right">
                                <a class="text-danger" href="{{ route('user.profile.password.edit') }}">
                                    {{ __('backend.user.change-password') }}
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Croppie Modal -->
    <div class="modal fade" id="image-crop-modal" tabindex="-1" role="dialog" aria-labelledby="image-crop-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('backend.user.crop-profile-image') }}</h5>
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
                                <input id="upload_image_input" name="k" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="upload_image_input">{{ __('backend.user.choose-image') }}</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('backend.shared.cancel') }}</button>
                    <button id="crop_image" type="button" class="btn btn-primary">{{ __('backend.user.crop-image') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Image Crop Plugin Js -->
    <script src="{{ asset('backend/vendor/croppie/croppie.js') }}"></script>

    <script>

        $(document).ready(function() {

            "use strict";

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
                            width:70,
                            height:70,
                            type:'square'
                        },
                        boundary:{
                            width:150,
                            height:150
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

                $('#image-crop-modal').modal('hide')
            });
            /**
             * End the croppie image plugin
             */

            /**
             * Start delete feature image button
             */
            $('#delete_user_profile_image_button').on('click', function(){

                $('#delete_user_profile_image_button').attr("disabled", true);

                var ajax_url = '/ajax/user/image/delete/' + '{{ $login_user->id }}';

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

                        $('#image_preview').attr("src", "{{ asset('backend/images/placeholder/profile-' . intval($login_user->id % 10) . '.webp') }}");
                        $('#feature_image').val("");

                        $('#delete_user_profile_image_button').attr("disabled", false);
                    }});
            });
            /**
             * End delete feature image button
             */
        });
    </script>

@endsection
