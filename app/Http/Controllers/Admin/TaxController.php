<?php

namespace App\Http\Controllers\Admin;

use App\Tax;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class TaxController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $settings = app('site_global_settings');

        /**
         * Start SEO
         */
        SEOMeta::setTitle(__('seo.backend.admin.category.categories', ['site_name' => empty($settings->setting_site_name) ? config('app.name', 'Laravel') : $settings->setting_site_name]));
        SEOMeta::setDescription('');
        SEOMeta::setCanonical(URL::current());
        SEOMeta::addKeyword($settings->setting_site_seo_home_keywords);
        /**
         * End SEO
         */


        /**
         * Start build query
         */
        $taxes = Tax::get();
        /**
         * End build query
         */


        return response()->view('backend.admin.tax.index',compact('taxes'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function show(Category $category)
    {
        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit($id)
    {
        $settings = app('site_global_settings');

        /**
         * Start SEO
         */
        SEOMeta::setTitle(__('seo.backend.admin.category.edit-category', ['site_name' => empty($settings->setting_site_name) ? config('app.name', 'Laravel') : $settings->setting_site_name]));
        SEOMeta::setDescription('');
        SEOMeta::setCanonical(URL::current());
        SEOMeta::addKeyword($settings->setting_site_seo_home_keywords);
        /**
         * End SEO
         */

        $tax = Tax::find($id);

        return response()->view('backend.admin.tax.edit',compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {

        $tax = Tax::find($id);
        $tax->pst = $request->pst;
        $tax->gst = $request->gst;
        $tax->hst = $request->hst;
        $tax->save();

        \Session::flash('flash_message', __('Tax Rate has been Updated'));
        \Session::flash('flash_type', 'success');

        return redirect()->route('admin.tax.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        // check model relations before delete
        if($category->allCustomFields()->count() > 0)
        {
            \Session::flash('flash_message', __('alert.category-delete-error-custom-field'));
            \Session::flash('flash_type', 'danger');

            return redirect()->route('admin.categories.edit', $category);
        }
        elseif($category->allItems()->count() > 0)
        {
            \Session::flash('flash_message', __('alert.category-delete-error-listing'));
            \Session::flash('flash_type', 'danger');

            return redirect()->route('admin.categories.edit', $category);
        }
        elseif($category->children()->count() > 0)
        {
            \Session::flash('flash_message', __('categories.category-delete-error-children'));
            \Session::flash('flash_type', 'danger');

            return redirect()->route('admin.categories.edit', $category);
        }
        else
        {
            $category->deleteCategory();

            \Session::flash('flash_message', __('alert.category-deleted'));
            \Session::flash('flash_type', 'success');

            return redirect()->route('admin.categories.index');
        }
    }
}
