<?php

namespace App\Http\Controllers;

use App\EventModel;
use Auth;
use DB;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Response;

class TakvimController extends Controller
{
    public function index()
    {
        $user = \App\User::where('durum',1)
            ->whereNotNull('renk')
            ->get();
        $compact = compact('user');
        return view('takvim',$compact);
    }

    public function events()
    {

//      $data = EventModel::where('user_id','=',Auth::user()->id)->get();


        $data = \App\EventModel::where('user_id','=',Auth::user()->id);

        $data_asansor = \App\AsansorModel::join('users','asansor_models.bakimci_id','users.id')
            ->where('bu_ay_bakim_tarih','!=',null)
            ->select('asansor_models.id','bakimci_id as user id',DB::raw("CONCAT(apartman, '-', COALESCE(`blok`,'')) as title"),'bu_ay_bakim_tarih','bu_ay_bakim_tarih',DB::raw("'0' as allDay"),DB::raw("users.renk as backgroundColor"),DB::raw("users.renk as borderColor"),DB::raw("'0' as created_at"),DB::raw("'0' as updated_at"))
//            ->select(DB::raw("'0' as id"),'bakimci_id as user id','apartman as title',DB::raw('aylik_bakim + INTERVAL 1 MONTH'),DB::raw('aylik_bakim + INTERVAL 1 MONTH'),DB::raw("'0' as allDay"),DB::raw("'rgb(236, 255, 10)' as backgroundColor"),DB::raw("'rgb(236, 255, 10)' as borderColor"),DB::raw("'0' as created_at"),DB::raw("'0' as updated_at"));
            ->orderBy('bakimci_id');

        $result = $data->union($data_asansor)->get();

        $json= Response::json($result)->setEncodingOptions(JSON_NUMERIC_CHECK);

        return $json;
    }


    public function create(Request $request)
    {
        $event=new EventModel();
        $event->user_id=Auth::user()->id;
        $event->title=$request->title;
        $event->start=$request->start;
        $event->end=$request->end;
        $event->backgroundColor=$request->color;
        $event->borderColor=$request->color;
        $event->allDay=0;
        $saved=$event->save();

        if(!$saved){
            return redirect(route('takvim.index'))->with('error','Program Eklenemedi');
        }
        else {
            return redirect(route('takvim.index'))->with('success', 'Program Eklendi');
        }

    }



    public function destroy($id)
    {
        $deleted = EventModel::where('id',$id)->delete();

        return Response::json($deleted);
    }

}
