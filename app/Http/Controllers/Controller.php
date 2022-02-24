<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function correct($response = null)
    {
      return response()->json([
          'rc'           => 1,
          'data'         => $response,
      ]);
    }

    /**
     * Return a incorrect response
     *
     * @var Response
     */
     public function incorrect($code = 0,$response = null, $extra = null)
     {
         // $response = $response?? config('errors.'.$code);
         return response()->json([
             'rc'           => $code,
             'data'         => $response,
             'details'      => $extra
         ]);
     }


}
