<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct(Request $request)
    {
        $method = strtoupper($request->getMethod());
        $uri = $request->getPathInfo();
        $bodyAsJson = json_encode($request->except(config('http-logger.except')));
        $message = "{$method} {$uri} - {$bodyAsJson}";
        //Log::info($message);
    }
}