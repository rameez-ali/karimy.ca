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
                        <div class="col-md-8 text-center">
                            <h1 style="color: {{ $site_innerpage_header_title_font_color }};">Frequently Asked Questions</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-12">
                    <!--{!! clean($faqs) !!}-->
                    <div id="accordion">
                      @foreach($faqs as $key => $faq)
                      <div class="card">
                        <div class="card-header" id="heading{{$key}}">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" onclick="myFunction()" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                              {{$faq->faqs_question}}
                            </button>
                          </h5>
                        </div>
                    
                        <div id="collapse{{$key}}" class="collapse {{$faq->collapse}}"  aria-labelledby="heading{{$key}}" data-parent="#accordion">
                          <div class="card-body">
                              {!!$faq->faqs_answer!!}
                          </div>
                        </div>
                      </div>
                      @endforeach
                      
                    </div>
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
        
    function myFunction() {
        document.getElementByClass("collapse").innerHTML = removeClass("show");
    }

@endsection
