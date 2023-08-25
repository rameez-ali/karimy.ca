@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    @if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_DEFAULT)
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url( {{ asset('frontend/images/placeholder/header-inner.webp') }});" data-stellar-background-ratio="0.5">

    @elseif($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_COLOR)
        <div class="site-blocks-cover inner-page-cover overlay" style="background-color: {{ $site_innerpage_header_background_color }};" data-stellar-background-ratio="0.5">

    @elseif($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_IMAGE)
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url( {{ Storage::disk('public')->url('customization/' . $site_innerpage_header_background_image) }});" data-stellar-background-ratio="0.5">

    @elseif($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO)
        <div class="site-blocks-cover inner-page-cover overlay" style="background-color: #333333;" data-stellar-background-ratio="0.5">
    @endif

        @if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO)
            <div data-youtube="{{ $site_innerpage_header_background_youtube_video }}"></div>
        @endif

        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


                    <div class="row justify-content-center mt-5">
                        <div class="col-md-10 text-center">
                            <h1 style="color: {{ $site_innerpage_header_title_font_color }};">Device Verification</h1>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 mb-5">
                    @if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif
                    <form method="POST" action="{{ route('device_authorization_added') }}" class="p-2 p-lg-5 bg-white">
                    @csrf    
                        <p>
                        Please, enter the verification code we sent to your email 
                        {{ Auth::user()->email }} for the new device.
                        </p>
                        <input  type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                        <input  type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input  type="hidden" name="device_id" value="{{ Session::get('device_id') }}">

                        <div class="row form-group">

                            <div class="col-md-12">
                            <label class="text-black" for="device_verfication_otp">OTP:</label>
                            <div class="d-flex" style="gap: 5px;">
                            <input id="device_verfication_otp1" type="number" class="form-control " name="device_verfication_otp1" value="" required="" autocomplete="device_verfication_otp" autofocus="">
                            <input id="device_verfication_otp2" type="number" class="form-control " name="device_verfication_otp2" value="" required="" autocomplete="device_verfication_otp" autofocus="">
                            <input id="device_verfication_otp3" type="number" class="form-control " name="device_verfication_otp3" value="" required="" autocomplete="device_verfication_otp" autofocus="">
                            <input id="device_verfication_otp4" type="number" class="form-control " name="device_verfication_otp4" value="" required="" autocomplete="device_verfication_otp" autofocus="">
                            <input id="device_verfication_otp5" type="number" class="form-control " name="device_verfication_otp5" value="" required="" autocomplete="device_verfication_otp" autofocus="">
                            <input id="device_verfication_otp6" type="number" class="form-control " name="device_verfication_otp6" value="" required="" autocomplete="device_verfication_otp" autofocus="">
                            </div>

                            </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <p class="mb-5">Didn't Receive the OTP. <a href="#"> Resend OTP </a> </p>
                                    <button type="submit" class="btn btn-primary py-2 px-4 text-white">
                                        Verify Device
                                    </button>
                                </div>
                            </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    @if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO)
    <!-- Youtube Background for Header -->
        <script src="{{ asset('frontend/vendor/jquery-youtube-background/jquery.youtube-background.js') }}"></script>
    @endif
    <script>

        $(document).ready(function(){

            "use strict";

            @if($site_innerpage_header_background_type == \App\Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE_YOUTUBE_VIDEO)
            /**
             * Start Initial Youtube Background
             */
            $("[data-youtube]").youtube_background();
            /**
             * End Initial Youtube Background
             */
            @endif

        });

    </script>

@endsection
