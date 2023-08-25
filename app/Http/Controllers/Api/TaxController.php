<?php

namespace App\Http\Controllers\Api;

use App\Tax;
use Auth;
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
    public function my_state_tax()
    {
        $login_user = Auth::user();
        
        $tax = Tax::where('city_name',$login_user->state)->first();
        
        if ($tax) {
            
            $result = new \Stdclass();
            
            $result->state = $tax->city_name;
            
            $tax_percentage = $tax->pst + $tax->gst + $tax->hst;
            $result->tax_percentage = number_format($tax_percentage, 2, '.', '');

            return response()->json([
                'result'  => $result,
                'message' => 'success',
                'status'  => 1
            ], 200);
        } else {
            return response()->json([
                'message' => 'Please Update Your State',
                'status'  => 0
            ], 400);
        }
    }

    
}
