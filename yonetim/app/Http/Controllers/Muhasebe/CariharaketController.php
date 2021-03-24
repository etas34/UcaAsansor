<?php

namespace App\Http\Controllers\Muhasebe;

use App\AsansorModel;
use App\Cari;
use App\Cariharaket;
use App\Fatura;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function foo\func;

class CariharaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $asansor = AsansorModel::find(1)->caris;
//        foreach ($asansor as $value)
//            var_dump($value);
//        dd('die');

        $cari = Cari::where('durum', '=', '1')->get();
        return view('muhasebe.cariharaket.index', compact('cari'));
        /*      if ($id == 1){
          }
   elseif ($id == 2){
              $cari = Cari::where('durum','=',1)
                  ->get();
              foreach ($cari as $value ){
                  (\Carbon\Carbon::createFromTimeStamp(strtotime($value->gecerlilik))) < (\Carbon\Carbon::now());

              }








          }*/
    }
//->whereRaw(" NOW() > sozlesme_tarih ")

    public function tarihGecmis(){
//       $cari =  Cari::where('durum',1)->where('sozlesme_tarih',null)->get();



//        Parameter grouping yapıldı
       $cari = Cari::where('durum',1)->
       where(function($query){
           $query->where('sozlesme_tarih',null)
               ->orWhereRaw(" NOW() > sozlesme_tarih ");
       })->get();
       return view('muhasebe.cariharaket.tarihGecmis',compact('cari'));

    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gecmis($id)
    {
        $cariharaket = Cariharaket::where('cari_id', '=', $id)
            ->get();
        $tutar = Cariharaket::all()->sum('tutar');

        //  $ilgili_kisi = Cari::find($cariharaket->cari_id)->ilgili_kisi;
        //dd($ilgili_kisi);
        return view('muhasebe.cariharaket.gecmis', compact('cariharaket', 'tutar', 'id'));
    }

    public function tumgecmis()
    {
        $cariharaket = Cariharaket::orderBy('created_at','desc')->get();

        //  $ilgili_kisi = Cari::find($cariharaket->cari_id)->ilgili_kisi;
        //dd($ilgili_kisi);
        return view('muhasebe.cariharaket.tumgecmis', compact('cariharaket'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cari = Cari::find($id);

        return view('muhasebe.cariharaket.create', compact('cari'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $cari = Cari::find($request->id);
        /* $cari->adres = "off way";
         $cari->save();
         dd($cari->adres);*/

        $cariharaket = new Cariharaket();

        if (isset($request->tur))
            switch ($request->tur) {
                case 1:
                    //    $cariharaket->alacak_bakiye = $cari->alacak_bakiye ;
                    $cari->borc_bakiye -= $request->tutar;
                    if ($cari->borc_bakiye < 0) {
                        $cari->alacak_bakiye += abs($cari->borc_bakiye);
                        $cari->borc_bakiye = 0;
                    }
                    $cari->save();
                    break;
                case 2:
                    $cari->alacak_bakiye -= $request->tutar;
                    if ($cari->alacak_bakiye < 0) {
                        $cari->borc_bakiye += abs($cari->alacak_bakiye);
                        $cari->alacak_bakiye = 0;
                    }

                    $cari->save();
                    break;
            }

        $cariharaket->cari_id = $request->id;
        $cariharaket->tutar = $request->tutar;
        $cariharaket->tur = $request->tur;
        $cariharaket->islem_tarih = $request->tarih;
        $cariharaket->metot = $request->odeme_metot;
        $cariharaket->aciklama = $request->aciklama;
        $cariharaket->user_id = \Auth::user()->id;

        $saved = $cariharaket->save();
        if ($saved)
            return redirect(route('muhasebe.cariharaket.gecmis', $cariharaket->cari_id))->with('success', 'Kayıt Başarı İle Eklendi');
        else
            return redirect(route('muhasebe.cariharaket.gecmis', $cariharaket->cari_id))->with('error', 'Birşeyler Ters Gitti');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function sozlesmeDegistir(Request $request)
    {
//        $cariharaket = Cariharaket::find($request->cari_id);
        if ($request->cari_id){
            $cari = Cari::find($request->cari_id);
            $cari->sozlesme_tarih = $request->sozlesme_tarih;
            $saved = $cari->save();
            if ($saved)
                return redirect(route('muhasebe.cariharaket.index'))->with('success', 'Tarih Başarı İle Eklendi');
            else
                return redirect(route('muhasebe.cariharaket.index'))->with('error', 'Birşeyler Ters Gitti');
        }
        else
            return redirect(route('muhasebe.cariharaket.index')->with('error', 'Hesap Bulunamadı'));




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cariharaket = Cariharaket::find($id);
        if ($cariharaket->fatura_id)
            return redirect(route('muhasebe.fatura.edit',$cariharaket->fatura_id));


        $cari = Cari::find($cariharaket->cari_id);
        return view('muhasebe.cariharaket.edit', compact('cariharaket', 'cari'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cariharaket = Cariharaket::find($id);
        $cari = Cari::find($cariharaket->cari_id);


        switch ($cariharaket->tur) {
            case 1:

                if ($cari->alacak_bakiye > 0) {
                    if ($cari->alacak_bakiye > $cariharaket->tutar)
                        $cari->alacak_bakiye = $cari->alacak_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                    else {

                        $cari->borc_bakiye = $cari->borc_bakiye + ($cariharaket->tutar - $cari->alacak_bakiye); // eski bakiye'ye dönüş yapıldı
                        $cari->alacak_bakiye = 0;
                    }

                } else {

                    $cari->borc_bakiye += $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                }

                $cari->borc_bakiye -= $request->tutar;
                if ($cari->borc_bakiye < 0) {
                    $cari->alacak_bakiye += abs($cari->borc_bakiye);
                    $cari->borc_bakiye = 0;
                }
                break;
            case 2:

                if ($cari->borc_bakiye > 0) {
                    if ($cari->borc_bakiye > $cariharaket->tutar) {


                        $cari->borc_bakiye = $cari->borc_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

                    } else {

                        $cari->alacak_bakiye = $cari->alacak_bakiye + ($cariharaket->tutar - $cari->borc_bakiye); // eski bakiye'ye dönüş yapıldı
                        $cari->borc_bakiye = 0;
                    }

                } else {

                    $cari->alacak_bakiye += $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                }


                $cari->alacak_bakiye -= $request->tutar;
                if ($cari->alacak_bakiye < 0) {
                    $cari->borc_bakiye += abs($cari->alacak_bakiye);
                    $cari->alacak_bakiye = 0;
                }

                $cari->save();
                break;
        }
        $saved = $cari->save();
        $cariharaket->tutar = $request->tutar;
        $cariharaket->islem_tarih = $request->tarih;
        $cariharaket->metot = $request->odeme_metot;
        $cariharaket->aciklama = $request->aciklama;
        $saved2 = $cariharaket->save();
        if ($saved and $saved2)
            return redirect(route('muhasebe.cariharaket.gecmis', $cariharaket->cari_id))->with('success', 'İşlem Başarılı');
        else
            return redirect(route('muhasebe.cariharaket.gecmis', $cariharaket->cari_id))->with('error', 'Birşeyler Ters Gitti');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $cariharaket = Cariharaket::find($id);

        $cari = Cari::find($cariharaket->cari_id);

        switch ($cariharaket->tur) {
            case 1:
                if ($cari->alacak_bakiye > 0) {
                    if ($cari->alacak_bakiye > $cariharaket->tutar) {

                        $cari->alacak_bakiye = $cari->alacak_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

                    } else {

                        $cari->borc_bakiye = $cari->borc_bakiye + ($cariharaket->tutar - $cari->alacak_bakiye); // eski bakiye'ye dönüş yapıldı
                        $cari->alacak_bakiye = 0;
                    }

                } else {

                    $cari->borc_bakiye += $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                }
                break;
            case 2:

                if ($cari->borc_bakiye > 0) {
                    if ($cari->borc_bakiye > $cariharaket->tutar) {

                        $cari->borc_bakiye = $cari->borc_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

                    } else {

                        $cari->alacak_bakiye = $cari->alacak_bakiye + ($cariharaket->tutar - $cari->borc_bakiye); // eski bakiye'ye dönüş yapıldı
                        $cari->borc_bakiye = 0;
                    }

                } else {
                    $cari->alacak_bakiye += $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                }
                break;
                case 3:
                if ($cari->borc_bakiye > 0) {
                    if ($cari->borc_bakiye > $cariharaket->tutar) {

                        $cari->borc_bakiye = $cari->borc_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

                    } else {

                        $cari->alacak_bakiye = $cari->alacak_bakiye + ($cariharaket->tutar - $cari->borc_bakiye); // eski bakiye'ye dönüş yapıldı
                        $cari->borc_bakiye = 0;
                    }

                } else {
                    $cari->alacak_bakiye += $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                }
                $fatura =Fatura::find($cariharaket->fatura_id);

                    $fatura->delete();
                break;


        }

        $saved = $cari->save();
        $saved2 = $cariharaket->delete();

        if ($saved2 and $saved2)
            return redirect(route('muhasebe.cariharaket.gecmis', $cariharaket->cari_id))->with('success', 'İşlem Başarılı');
        else
            return redirect(route('muhasebe.cariharaket.gecmis', $cariharaket->cari_id))->with('error', 'Bir Şeyler Ters Gitti');

    }
}
