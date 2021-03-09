<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Yetki
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$yetki=null)
    {
        $yetkiler=explode(",",Auth::user()->yetki);
        if(in_array($yetki,$yetkiler))
        {
            return $next($request);
        }
        else
        {
            return redirect()->back()->with('error','Yetkisiz İşlem');
        }

    }
}
