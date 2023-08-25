<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use App\Device;
use App\Customization;
use Auth;
use Mail;
use DB;
use Session;
use Redirect;

class CheckDeviceStatus
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {

        $settings = app('site_global_settings');

        // /**
        //  * Start SEO
        //  */
        // SEOMeta::setTitle(__('seo.auth.login', ['site_name' => empty($settings->setting_site_name) ? config('app.name', 'Laravel') : $settings->setting_site_name]));
        // SEOMeta::setDescription('');
        // SEOMeta::setCanonical(URL::current());
        // SEOMeta::addKeyword($settings->setting_site_seo_home_keywords);
        // /**
        //  * End SEO
        //  */
         
         /**
         * Start inner page header customization
         */
        $site_innerpage_header_background_type = Customization::where('customization_key', Customization::SITE_INNERPAGE_HEADER_BACKGROUND_TYPE)
            ->where('theme_id', $settings->setting_site_active_theme_id)->first()->customization_value;

        $site_innerpage_header_background_color = Customization::where('customization_key', Customization::SITE_INNERPAGE_HEADER_BACKGROUND_COLOR)
            ->where('theme_id', $settings->setting_site_active_theme_id)->first()->customization_value;

        $site_innerpage_header_background_image = Customization::where('customization_key', Customization::SITE_INNERPAGE_HEADER_BACKGROUND_IMAGE)
            ->where('theme_id', $settings->setting_site_active_theme_id)->first()->customization_value;

        $site_innerpage_header_background_youtube_video = Customization::where('customization_key', Customization::SITE_INNERPAGE_HEADER_BACKGROUND_YOUTUBE_VIDEO)
            ->where('theme_id', $settings->setting_site_active_theme_id)->first()->customization_value;

        $site_innerpage_header_title_font_color = Customization::where('customization_key', Customization::SITE_INNERPAGE_HEADER_TITLE_FONT_COLOR)
            ->where('theme_id', $settings->setting_site_active_theme_id)->first()->customization_value;

        $site_innerpage_header_paragraph_font_color = Customization::where('customization_key', Customization::SITE_INNERPAGE_HEADER_PARAGRAPH_FONT_COLOR)
            ->where('theme_id', $settings->setting_site_active_theme_id)->first()->customization_value;
        /**
         * End inner page header customization
         */
         
        if(Auth::check()){ 
            if(Auth::user()->id != 1){
            $device_id = Device::where('user_id',Auth::user()->id)->where('device_id',Session::get('device_id'))->value('device_id');

            if($device_id == null){
                    
                    return response()->view('frontend.authorization', 
                    compact('device_id','settings','site_innerpage_header_background_type',
                    'site_innerpage_header_background_color','site_innerpage_header_background_image',
                    'site_innerpage_header_background_youtube_video','site_innerpage_header_title_font_color',
                    'site_innerpage_header_paragraph_font_color'
                    ));
                }
            }
            else{
                return $next($request);
            }
        }
            return $next($request);
    }
}
