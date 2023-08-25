@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
       <img
        class="mb-3 w-xl-100 m20w"
        alt="logo"
        width="100"
        height="100"
        src="{{ asset('frontend/images/Karimy_white.png') }}"
      />
        @endcomponent
    @endslot

    Your OTP is: {{ $OPT }}

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => config('app.url'),'color' => 'success'])
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
