<?php

namespace App\Http\Controllers;

use App\ArizaModel;
use App\AsansorModel;
use App\BolgeModel;
use App\EkbilgilerModel;
use App\Exports\AsansorExport;
use App\Exports\ParcaExport;
use App\ParcaModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AsansorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        if($id==1)
        {
            $asansor=AsansorModel::where('durum','=', 1)->get();
            $etiket=1;
        }
        elseif ($id==2)
        {
            $asansor=AsansorModel::where('durum','=', 1)
                ->where('etiket','=','Sarı')
                ->get();
            $etiket=2;
        }
        elseif ($id==3)
        {
            $asansor=AsansorModel::where('durum','=', 1)
                ->where('etiket','=','Kırmızı')
                ->get();
            $etiket=3;
        }


        return view('asansor.index',compact('asansor','etiket'));
    }



    public function pasifler()
    {
        $asansor=AsansorModel::where('durum','=',2)->get();

        return view('asansor.pasifler',compact('asansor'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bolge = BolgeModel::where('durum','=',1)
            ->orderBy('ad','asc')
            ->get();
        $user=User::where('durum','=',1)->get();
        return view('asansor.create',compact('user','bolge'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $asansor=new AsansorModel();
        $asansor->kimlik=$request->kimlik;
        $asansor->apartman=$request->apartman;
        $asansor->blok=$request->blok;
        $asansor->yonetici=$request->yonetici;
        $asansor->yonetici_tel=$request->yonetici_tel;
        $asansor->adres=$request->adres;
//        $asansor->aylik_bakim=$request->aylik_bakim;
        $asansor->etiket_tarihi=$request->etiket_tarihi;
        $asansor->bakimci_id=$request->bakimci_id;
        $asansor->bolge_id = $request->bolge_id;
        $asansor->bakim_ucreti=$request->bakim_ucreti;
        $saved=$asansor->save();

        $ekbilgiler=new EkbilgilerModel();
        $ekbilgiler->asansor_id=$asansor->id;
        $ekbilgiler->uretici=$request->uretici;
        $ekbilgiler->uretim_tarihi=$request->uretim_tarihi;
        $ekbilgiler->motor_marka=$request->motor_marka;
        $ekbilgiler->kapi_marka=$request->kapi_marka;
        $ekbilgiler->pano_marka=$request->pano_marka;
        $ekbilgiler->kisilik=$request->kisilik;
        $ekbilgiler->hidrolik=$request->hidrolik;
        $saved2=$ekbilgiler->save();




        if($saved and $saved2){
            return redirect(route('asansor.index',1))->with('success','Asansör Eklendi');
        }
        else
        {

            return redirect(route('asansor.index',1))->with('error','Asansör Eklenemedi');
        }

    }






        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bolge = BolgeModel::where('durum','=',1)
            ->orderBy('ad','asc')
            ->get();
        $user=User::where('durum','=',1)->get();
        $asansor=AsansorModel::find($id);
        $ekbilgiler=EkbilgilerModel::where('asansor_id','=',$id)->first();

        return view('asansor.edit',compact('asansor','ekbilgiler','user','bolge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asansor=AsansorModel::find($id);
        $asansor->kimlik=$request->kimlik;
        $asansor->apartman=$request->apartman;
        $asansor->blok=$request->blok;
        $asansor->yonetici=$request->yonetici;
        $asansor->yonetici_tel=$request->yonetici_tel;
        $asansor->adres=$request->adres;
//        $asansor->aylik_bakim=$request->aylik_bakim;
        $asansor->etiket_tarihi=$request->etiket_tarihi;
        $asansor->bakimci_id=$request->bakimci_id;
        $asansor->bolge_id = $request->bolge_id;
        $asansor->bakim_ucreti=$request->bakim_ucreti;


        $saved=$asansor->save();


        $ekbilgiler=EkbilgilerModel::where('asansor_id','=',$id)->first();
        $ekbilgiler->uretici=$request->uretici;
        $ekbilgiler->uretim_tarihi=$request->uretim_tarihi;
        $ekbilgiler->motor_marka=$request->motor_marka;
        $ekbilgiler->kapi_marka=$request->kapi_marka;
        $ekbilgiler->pano_marka=$request->pano_marka;
        $ekbilgiler->kisilik=$request->kisilik;
        $ekbilgiler->hidrolik=$request->hidrolik;
        $saved2=$ekbilgiler->save();


        if($saved and $saved2){
            return redirect(route('asansor.index',1))->with('success','Asansör Düzenlendi');
        }
        else
        {

            return redirect(route('asansor.index',1))->with('error','Asansör Düzenlenemedi');
        }
    }

    public function pasifeAl($id)
    {

        $asansor=AsansorModel::find($id);
        $asansor->durum=2;
        $saved=$asansor->save();


        if($saved){
            return redirect(route('asansor.index',1))->with('success','Asansör Düzenlendi');
        }
        else
        {

            return redirect(route('asansor.index',1))->with('error','Asansör Düzenlenemedi');
        }
    }

    public function aktifeAl($id)
    {

        $asansor=AsansorModel::find($id);
        $asansor->durum=1;
        $saved=$asansor->save();


        if($saved){
            return redirect(route('asansor.pasifler'))->with('success','Asansör Düzenlendi');
        }
        else
        {

            return redirect(route('asansor.pasifler'))->with('error','Asansör Düzenlenemedi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asansor = AsansorModel::find($id);
        $update=AsansorModel::find($id)->update(['durum' => 0]);
//        $update2= BolgeModel::find($asansor->bolge_id)->update(['bolge_id'=>null]);

        $asansor->bolge_id = null;
        $saved = $asansor->save();

        if(!$update and !$saved){
            return redirect(route('asansor.index',1))->with('error','Asansör Silinemedi');
        }
        else
        {

            return redirect(route('asansor.index',1))->with('success','Asansör Silindi');
        }

    }


    public function export($id)
    {

        return Excel::download(new AsansorExport($id), 'asansor_listesi.xlsx');
    }
}
