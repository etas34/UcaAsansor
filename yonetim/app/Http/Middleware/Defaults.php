<?php

namespace App\Http\Middleware;

use App\BildirimModel;
use App\GorevModel;
use Auth;
use Closure;
use View;

class Defaults
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $tamgorev=GorevModel::where('sahip_id', '=', Auth::user()->id)
            ->where('durum', '=', 4)->get();

        $bildirim=BildirimModel::where('user_id','=',Auth::user()->id)
                            ->join('gorev_models', 'bildirim_models.gorev_id', '=', 'gorev_models.id')
                            ->select('bildirim_models.*', 'gorev_models.baslik as gorev_name')
                             ->orderBy('id','desc')
                                ->get();

        View::share('tamgorev', $tamgorev);
        View::share('bildirim', $bildirim);

        return $next($request);
    }
}
