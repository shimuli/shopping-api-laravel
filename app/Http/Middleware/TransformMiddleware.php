<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TransformMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $transformer)
    {
        $transformerInput = [];
        foreach($request->request()->all() as $input => $value){
            $transformerInput[$transformer::originalAttributes($input)] = $value;
        }
        $request->replace($transformerInput);
        return $next($request);
    }
}
