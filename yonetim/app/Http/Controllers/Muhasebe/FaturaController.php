<?php

namespace App\Http\Controllers\Muhasebe;

use App\AsansorModel;
use App\BakimModel;
use App\Cari;
use App\Cariharaket;
use App\Fatura;
use App\Http\Controllers\Controller;
use App\ParcaModel;
use Carbon\Carbon;
use Doctrine\DBAL\Driver\OCI8\OCI8Exception;
use Illuminate\Http\Request;




class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.ü
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        dd($toplamborcbakiye);
        $cari = Cari::where('durum', '=', '1')->get();
        return view('muhasebe.fatura.index', compact('cari'));
    }


    function sayiyiYaziyaCevir($sayi, $kurusbasamak, $parabirimi, $parakurus, $diyez, $bb1, $bb2, $bb3) {
        // kurusbasamak virgülden sonra gösterilecek basamak sayısı
        // parabirimi = TL gibi , parakurus = Kuruş gibi
        // diyez başa ve sona kapatma işareti atar # gibi

        $b1 = array("", "Bir", "İki", "Üç", "Dört", "Beş", "Altı", "Yedi", "Sekiz", "Dokuz");
        $b2 = array("", "On", "Yirmi", "Otuz", "Kırk", "Elli", "Altmış", "Yetmiş", "Seksen", "Doksan");
        $b3 = array("", "Yüz", "Bin", "Milyon", "Milyar", "Trilyon", "Katrilyon");

        if ($bb1 != null) { // farklı dil kullanımı yada farklı yazım biçimi için
            $b1 = $bb1;
        }
        if ($bb2 != null) { // farklı dil kullanımı
            $b2 = $bb2;
        }
        if ($bb3 != null) { // farklı dil kullanımı
            $b3 = $bb3;
        }

        $say1="";
        $say2 = ""; // say1 virgül öncesi, say2 kuruş bölümü
        $sonuc = "";

        $sayi = str_replace(",", ".",$sayi); //virgül noktaya çevrilir

        $nokta = strpos($sayi,"."); // nokta indeksi

        if ($nokta>0) { // nokta varsa (kuruş)

            $say1 = substr($sayi,0, $nokta); // virgül öncesi
            $say2 = substr($sayi,$nokta, strlen($sayi)); // virgül sonrası, kuruş

        } else {
            $say1 = $sayi; // kuruş yoksa
        }

        $son ="";
        $w = 1; // işlenen basamak
        $sonaekle = 0; // binler on binler yüzbinler vs. için sona bin (milyon,trilyon...) eklenecek mi?
        $kac = strlen($say1); // kaç rakam var?
        $sonint =""; // işlenen basamağın rakamsal değeri
        $uclubasamak = 0; // hangi basamakta (birler onlar yüzler gibi)
        $artan = 0; // binler milyonlar milyarlar gibi artışları yapar
        $gecici ="";

        if ($kac > 0) { // virgül öncesinde rakam var mı?

            for ($i = 0; $i < $kac; $i++) {

                $son = $say1[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
                $sonint = $son; // işlenen rakam Integer.parseInt(

                if ($w == 1) { // birinci basamak bulunuyor

                    $sonuc = $b1[$sonint] . $sonuc;

                } else if ($w == 2) { // ikinci basamak

                    $sonuc = $b2[$sonint] . $sonuc;

                } else if ($w == 3) { // 3. basamak

                    if ($sonint == 1) {
                        $sonuc = $b3[1] . $sonuc;
                    } else if ($sonint > 1) {
                        $sonuc = $b1[$sonint] . $b3[1] . $sonuc;
                    }
                    $uclubasamak++;
                }

                if ($w > 3) { // 3. basamaktan sonraki işlemler

                    if ($uclubasamak == 1) {

                        if ($sonint > 0) {
                            $sonuc = $b1[$sonint] . $b3[2 + $artan] . $sonuc;
                            if ($artan == 0) { // birbin yazmasını engelle
                                $sonuc = str_replace($b1[1] . $b3[2], $b3[2],$sonuc);
                            }
                            $sonaekle = 1; // sona bin eklendi
                        } else {
                            $sonaekle = 0;
                        }
                        $uclubasamak++;

                    } else if ($uclubasamak == 2) {

                        if ($sonint > 0) {
                            if ($sonaekle > 0) {
                                $sonuc = $b2[$sonint] . $sonuc;
                                $sonaekle++;
                            } else {
                                $sonuc = $b2[$sonint] . $b3[2 + $artan] . $sonuc;
                                $sonaekle++;
                            }
                        }
                        $uclubasamak++;

                    } else if ($uclubasamak == 3) {

                        if ($sonint > 0) {
                            if ($sonint == 1) {
                                $gecici = $b3[1];
                            } else {
                                $gecici = $b1[$sonint] . $b3[1];
                            }
                            if ($sonaekle == 0) {
                                $gecici = $gecici . $b3[2 + $artan];
                            }
                            $sonuc = $gecici . $sonuc;
                        }
                        $uclubasamak = 1;
                        $artan++;
                    }

                }

                $w++; // işlenen basamak

            }
        } // if(kac>0)

        if ($sonuc=="") { // virgül öncesi sayı yoksa para birimi yazma
            $parabirimi = "";
        }

        $say2 = str_replace(".", "",$say2);
        $kurus = "";

        if ($say2!="") { // kuruş hanesi varsa

            if ($kurusbasamak > 3) { // 3 basamakla sınırlı
                $kurusbasamak = 3;
            }
            $kacc = strlen($say2);
            if ($kacc == 1) { // 2 en az
                $say2 = $say2."0"; // kuruşta tek basamak varsa sona sıfır ekler.
                $kurusbasamak = 2;
            }
            if (strlen($say2) > $kurusbasamak) { // belirlenen basamak kadar rakam yazılır
                $say2 = substr($say2,0, $kurusbasamak);
            }

            $kac = strlen($say2); // kaç rakam var?
            $w = 1;

            for ($i = 0; $i < $kac; $i++) { // kuruş hesabı

                $son = $say2[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
                $sonint = $son; // işlenen rakam Integer.parseInt(

                if ($w == 1) { // birinci basamak

                    if ($kurusbasamak > 0) {
                        $kurus = $b1[$sonint] . $kurus;
                    }

                } else if ($w == 2) { // ikinci basamak
                    if ($kurusbasamak > 1) {
                        $kurus = $b2[$sonint] . $kurus;
                    }

                } else if ($w == 3) { // 3. basamak
                    if ($kurusbasamak > 2) {
                        if ($sonint == 1) { // 'biryüz' ü engeller
                            $kurus = $b3[1] . $kurus;
                        } else if ($sonint > 1) {
                            $kurus = $b1[$sonint] . $b3[1] . $kurus;
                        }
                    }
                }
                $w++;
            }
            if ($kurus=="") { // virgül öncesi sayı yoksa para birimi yazma
                $parakurus = "";
            } else {
                $kurus = $kurus . " ";
            }
            $kurus = $kurus . $parakurus; // kuruş hanesine 'kuruş' kelimesi ekler
        }

        $sonuc = $diyez . $sonuc . " " . $parabirimi . " " . $kurus . $diyez;
        return $sonuc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gecmis($id)
    {
        $fatura = Fatura::where('cari_id', '=', $id)
            ->orderBy('tarih', 'asc')
            ->get();
        return view('muhasebe.fatura.gecmis', compact('fatura', 'id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tumgecmis()
    {
        $fatura = Fatura::all();
        return view('muhasebe.fatura.tumgecmis', compact('fatura'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faturabakim()
    {
        $bakimlar = BakimModel::where('bakim_models.durum',1)->where('cari_id', '!=', '')
            ->join('asansor_models', 'bakim_models.asansor_id', '=', 'asansor_models.id')
            ->select('bakim_models.*', 'asansor_models.apartman', 'asansor_models.cari_id', 'asansor_models.blok', 'asansor_models.bakim_ucreti')
            ->get();


        return view('muhasebe.fatura.faturaBakim', compact('bakimlar'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faturaparca()
    {
        $parcalar = ParcaModel::where('cari_id', '!=', '')->where('durum',1)
            ->join('asansor_models', 'parca_models.asansor_id', '=', 'asansor_models.id')
            ->select('parca_models.*', 'asansor_models.cari_id', 'asansor_models.apartman', 'asansor_models.blok')
            ->get();

        return view('muhasebe.fatura.faturaParca', compact('parcalar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $cari = Cari::find($id);

        $bakimlar = BakimModel::where('bakim_models.durum',1)->where('cari_id', '=', $id)
            ->join('asansor_models', 'bakim_models.asansor_id', '=', 'asansor_models.id')
            ->select('bakim_models.*', 'asansor_models.apartman', 'asansor_models.blok', 'asansor_models.bakim_ucreti')
            ->get();


        $parcalar = ParcaModel::where('cari_id', '=', $id)->where('durum',1)
            ->join('asansor_models', 'parca_models.asansor_id', '=', 'asansor_models.id')
            ->select('parca_models.*', 'asansor_models.apartman', 'asansor_models.blok')
            ->get();

////        dd($asansor->first());
//        foreach ($asansor as $asansors)
////            if (!$asansor->parca_fatura_no)
//            var_dump($asansors->parca_id);
//        dd('');

//dd($asansor);

//        $asansor = AsansorModel::where('cari_id','=',$id)
//        ->get();


//        foreach ($asansor as $asansors)
//         $bakim  =  BakimModel::where('asansor_id','=',$asansors->id)->get();
//        dd($bakim);


        return view('muhasebe.fatura.create', compact('cari', 'bakimlar', 'parcalar'));
    }


    public function faturaPrint($id)
    {
        $fatura = Fatura::find($id);
        $cari = Cari::find($fatura->cari_id);

       $yazi = $this->sayiyiYaziyaCevir($fatura->gentoplam,2,"TL","kr.","",null,null,null);


        return view('muhasebe.fatura.faturaPrint', compact('fatura', 'cari','yazi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);


        if ($request->bakim_ids)
            foreach ($request->bakim_ids as $key => $value) {
                $bakim = BakimModel::find($value);
                $bakim->fatura_no = $request->fnumarasi;
                $bakim->save();
            }

        if ($request->parca_ids)
            foreach ($request->parca_ids as $key => $value) {
                $parca = ParcaModel::find($value);
                $parca->fatura_no = $request->fnumarasi;
                $parca->save();
            }


        $fatura = new Fatura();
        $fatura->cari_id = $request->cari_id;
        $fatura->fatura_no = $request->fnumarasi;
        $fatura->tarih = $request->tarih;
        $fatura->urun = json_encode($request->urun);

        $fatura->toplam = $request->alttoplam;
        $fatura->kdv = $request->altkdv;
        $fatura->gentoplam = $request->altgentoplam;
        $fatura->aciklama = $request->aciklama;
        $saved = $fatura->save();


//        $cari = Cari::find($request->cari_id);
//        $cari->alacak_bakiye  -= $request->altgentoplam;
//        if ($cari->alacak_bakiye < 0){
//            $cari->borc_bakiye += abs($cari->alacak_bakiye);
//            $cari->alacak_bakiye  = 0;
//        }

        $cariharaket = new Cariharaket();
        $cari = Cari::find($request->cari_id);
        $cari->cari_unvan = $request->cari_unvan;
        $cari->alacak_bakiye -= $request->altgentoplam;
        if ($cari->alacak_bakiye < 0) {
            $cari->borc_bakiye += abs($cari->alacak_bakiye);
            $cari->alacak_bakiye = 0;
        }


        $cariharaket->cari_id = $request->id;
        $cariharaket->tutar = $request->altgentoplam;
        $cariharaket->tur = '3';
        $cariharaket->fatura_id = $fatura->id;
        $cariharaket->metot = '';
        $cariharaket->islem_tarih = $request->tarih;
        $cariharaket->aciklama = $request->aciklama;


        $cariharaket->save();

        $cari->save();


        if ($saved)
            return redirect(route('muhasebe.fatura.gecmis', $fatura->cari_id))->with('success', 'Fatura Eklendi');
        else
            return redirect(route('muhasebe.fatura.create', $fatura->cari_id))->with('error', 'Bir şeyler ters gitti.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $fatura = Fatura::find($id);
        $cari = Cari::find($fatura->cari_id);
        $urun = json_decode($fatura->urun);
        return view('muhasebe.fatura.edit', compact('fatura', 'cari', 'urun'));
    }

    /**
     * Update the specified resource in join.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $fatura = Fatura::find($id);

//        dd($fatura->urun);
        if ($fatura->urun != 'null')
            foreach (\GuzzleHttp\json_decode($fatura->urun) as $uruns) {
                if (isset($uruns->tur)) {
                    $tur = $uruns->tur;
                    if (isset($uruns->myid))
                        $myid = $uruns->myid;
                    if ($tur == 1) {
                        $bakim = BakimModel::find($myid);
                        $bakim->fatura_no = null;
                        $bakim->save();
                    } elseif ($tur == 2) {
                        $parca = ParcaModel::find($myid);
                        $parca->fatura_no = null;
                        $parca->save();
                    }
                }
            }


        if (isset($request->urun)) {
            $urun = json_encode($request->urun);

            foreach (json_decode($urun) as $value) {
                if (isset($value->tur))
                    if ($value->tur == 1) {
                        $bakim = BakimModel::find($value->myid);
                        $bakim->fatura_no = $request->fnumarasi;
                        $bakim->save();
                    } elseif ($value->tur == 2) {
                        $parca = ParcaModel::find($value->myid);
                        $parca->fatura_no = $request->fnumarasi;
                        $parca->save();
                    }


            }


        }


        /*
                    foreach ($request->urun as $key => $value) {
                        if (isset($uruns->tur))
                            $tur =  $uruns->tur;
                        if ($tur == 1)
                            if (isset($value->myid)) {
                                $bakim = BakimModel::find($value->myid);
                                $bakim->fatura_no = $request->fnumarasi;
                                $bakim->save();
                            }
                    }

                if (isset($uruns->tur) == 2)
                    foreach ($request->urun as $key => $value) {
                        if (isset($value->myid)) {
                            $parca = ParcaModel::find($value->myid);
                            $parca->fatura_no = $request->fnumarasi;
                            $parca->save();
                        }
                    }*/


        $fatura->fatura_no = $request->fnumarasi;
        $fatura->tarih = $request->tarih;
        $fatura->urun = json_encode($request->urun);

        $fatura->toplam = $request->alttoplam;
        $fatura->kdv = $request->altkdv;
        $fatura->gentoplam = $request->altgentoplam;
        $fatura->aciklama = $request->aciklama;

        $cariharaket = Cariharaket::where('fatura_id', '=', $id)
            ->first();
//        $cariharaket->fatura_id = $id;
        $cari = Cari::find($cariharaket->cari_id);
//        $cariharaket->tutar = $request->altgentoplam;

        /*if ($cari->borc_bakiye > 0) {

        }*/


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


        /*
           if ($cari->borc_bakiye > 0) {

               if ($cari->borc_bakiye > $cariharaket->tutar) {

                   $cari->borc_bakiye = $cari->borc_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

               } else {

                   $cari->alacak_bakiye = $cari->alacak_bakiye + ($cariharaket->tutar - $cari->borc_bakiye); // eski bakiye'ye dönüş yapıldı
                   $cari->borc_bakiye = 0;
               }





           } else {
               $cari->alacak_bakiye += $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

           }*/


        $cari->alacak_bakiye -= $request->altgentoplam;
        if ($cari->alacak_bakiye < 0) {
            $cari->borc_bakiye += abs($cari->alacak_bakiye);
            $cari->alacak_bakiye = 0;
        }

        $cariharaket->tutar = $request->altgentoplam;


        $saved = $cari->save();
        $saved2 = $cariharaket->save();
        $saved3 = $fatura->save();


        if ($saved and $saved2 and $saved3)
            return back()->with('success', 'İşlem Başarılı');
        else
            return back()->with('error', 'Birşeyler Ters Gitti');


        /*
                $cariharaket = Cariharaket::where('fatura_id','=',$id)
                ->first();

                $cari = Cari::find($cariharaket->cari_id);







                        if ($cari->borc_bakiye > 0) {

                            if ($cari->borc_bakiye > $cariharaket->tutar) {
        //                        dd($cariharaket->tutar);
                                $cari->borc_bakiye = $cari->borc_bakiye - $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı

                            } else {

                                $cari->alacak_bakiye = $cari->alacak_bakiye + ($cariharaket->tutar - $cari->borc_bakiye); // eski bakiye'ye dönüş yapıldı
                                $cari->borc_bakiye = 0;
                            }

                        } else {
                            $cari->alacak_bakiye -= $cariharaket->tutar; // eski bakiye'ye dönüş yapıldı
                        }











        //
        //        $cari->alacak_bakiye -= $request->altgentoplam;
        //        if ($cari->alacak_bakiye < 0) {
        //            $cari->borc_bakiye += abs($cari->alacak_bakiye);
        //            $cari->alacak_bakiye = 0;
        //        }

                $saved2 = $cari->save();

        //        $cariharaket->tutar = $request->altgentoplam;
                $saved3 = $cariharaket->save();

                $saved = $fatura->save();

                if ($saved and $saved2 and  $saved3)
                    return redirect(route('muhasebe.fatura.gecmis', $fatura->cari_id))->with('success', 'Fatura Eklendi');
                else
                    return redirect(route('muhasebe.fatura.create'))->with('error', 'Bir şeyler ters gitti.');*/
    }

    /**
     * Remove the specified resource from storage
     * .
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $fatura = Fatura::find($id);
        if ($fatura->urun != 'null')
            foreach (\GuzzleHttp\json_decode($fatura->urun) as $uruns) {
                if (isset($uruns->tur)) {
                    $tur = $uruns->tur;
                    if (isset($uruns->myid))
                        $myid = $uruns->myid;
                    if ($tur == 1) {
                        $bakim = BakimModel::find($myid);
                        $bakim->fatura_no = null;
                        $bakim->save();
                    } elseif ($tur == 2) {
                        $parca = ParcaModel::find($myid);
                        $parca->fatura_no = null;
                        $parca->save();
                    }
                }

            }


        $cari = Cari::find($fatura->cari_id);

        $cariharaket = Cariharaket::where('fatura_id', '=', $id)
            ->first();

        if (!$cariharaket->tutar == 0)
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


        $saved2 = $cariharaket->delete();
        $saved3 = $cari->save();


        $saved = $fatura->delete();
        if ($saved and $saved2 and $saved3)
            return redirect(route('muhasebe.fatura.gecmis', $fatura->cari_id))->with('success', 'Fatura Silindi');
        else
            return redirect(route('muhasebe.fatura.create', $fatura->cari_id))->with('error', 'Bir şeyler ters gitti.');
    }


}
