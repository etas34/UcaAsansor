<?php

namespace App\Http\Controllers;

use App\ArizaModel;
use App\AsansorModel;
use App\BakimModel;
use App\GorevModel;
use App\OnemModel;
use App\RevizyonModel;
use App\TeklifModel;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('preventBackHistory');
        $this->middleware('auth');

    }

    public function index()
    {
        if (!Auth::check() && !Request::is('login')) {
            return Redirect(route('login'));
        } else {

//            $bakim=AsansorModel::where('durum','=',1)
//                ->where('etiket','!=','Kırmızı')
//                ->whereDate('aylik_bakim', '<=', Carbon::now()->addMonthsNoOverflow(-1)->addWeeks(1))->get();


//            $bakim_atanan=AsansorModel::where('durum','=',1)
//                ->where('etiket','!=','Kırmızı')
//                ->where('bakimci_id','=',\Auth::user()->id)
//                ->whereDate('aylik_bakim', '<=', Carbon::now()->addMonthsNoOverflow(-1)->addWeeks(1))->get();


            $bakim_olmayan_aylik=AsansorModel::where('durum','=',1)
                ->where('etiket','!=','Kırmızı')
                ->where(function($query){
                    $query->orwhereDate('aylik_bakim', '<', Carbon::now()->firstOfMonth());
                    $query->orwhere('aylik_bakim', null);
                })->get();


            $bakim_aylik=BakimModel::where('durum',1)->whereDate('created_at', '>=', Carbon::now()->firstOfMonth())->get();

            $bakim_gunluk=BakimModel::where('durum',1)->whereDate('created_at', '>=', Carbon::now())->get();


            $revizyon=RevizyonModel::whereIn('revizyon_models.durum',[1,3])
                ->join('asansor_models', 'revizyon_models.asansor_id', '=', 'asansor_models.id')
                ->select('revizyon_models.*','asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok')
                ->get();


            $teklifler=TeklifModel::where('teklif_models.durum','1')
                ->join('asansor_models', 'teklif_models.asansor_id', '=', 'asansor_models.id')
                ->select('teklif_models.*','asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok', 'teklif_models.pdf')
                ->get();

            $gecmis_teklifler=TeklifModel::whereIn('teklif_models.durum',[2,3])
                ->join('asansor_models', 'teklif_models.asansor_id', '=', 'asansor_models.id')
                ->select('teklif_models.*','asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok', 'teklif_models.pdf')
                ->get();

            $revizyonGecmis=RevizyonModel::where('revizyon_models.durum','=',2)->get();

            $ariza=ArizaModel::where('durum','=',1)->get();

            $ariza_gecmis=ArizaModel::where('durum','=',2)->get();

            $atadıgım_gorevler=\App\GorevModel::where('sahip_id','=',Auth::user()->id)
                ->where('durum','!=',4)
                ->where('durum','!=',5)
                ->where('atanan_id','!=',Auth::user()->id)
                ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
                ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
                ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
                ->orderBy('id', 'DESC')
                ->get();

            $atanan_gorevler =\App\GorevModel::where('atanan_id','=',Auth::user()->id)
                ->where('durum','!=',4)
                ->where('durum','!=',5)
                ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
                ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
                ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
                ->orderBy('id', 'DESC')
                ->get();

            $tamamlanan_gorevler=\App\GorevModel::where('durum','=',4)
                ->where('sahip_id','=',Auth::user()->id)
                ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
                ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
                ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
                ->orderBy('id', 'DESC')
                ->get();



            /*      $asansor_bakim = AsansorModel::where('durum', '=', 1)
                    ->where('bu_ay_bakim_tarih','!=',null)
                    ->whereDate('bu_ay_bakim_tarih','<',$date)
                    ->where('bakimci_id','!=',null)
                    ->select('bakimci_id', DB::raw("count(*) as total"))
                    ->groupBy('bakimci_id')
                    ->get();

          dd($asansor_bakim);
          */
            $date=date('Y-m-d');
           $user = User::where('durum',1)->whereHas('asansors')->get();


            return view('index',compact('date','user','teklifler','gecmis_teklifler','revizyon','ariza','ariza_gecmis','atanan_gorevler','bakim_olmayan_aylik','bakim_aylik','bakim_gunluk','revizyonGecmis','atadıgım_gorevler','tamamlanan_gorevler'));

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }


}
