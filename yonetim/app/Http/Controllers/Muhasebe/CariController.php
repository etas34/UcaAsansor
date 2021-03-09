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
use Dompdf\Exception;
use Illuminate\Http\Request;

class CariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cari = Cari::where('durum', '=', '1')->get();
        return view('muhasebe.cari.index', compact('cari'));
    }


    public function cariasansor()
    {
        $cari = Cari::where('durum', '=', 1)->get();
        $asansor = AsansorModel::where('durum', '=', '1')->get();
        return view('muhasebe.cari.cariasansor', compact('asansor', 'cari'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cariasansorupdate(Request $request)
    {
//        dd($request->cari);

        $checkbox = $request->checkbox;
        if ($checkbox) {
            foreach ($checkbox as $cb) {

                $asansor = AsansorModel::find($cb);
                $asansor->cari_id = $request->cari;
                $saved = $asansor->save();
            }
            if ($saved)
                return redirect(route('muhasebe.cari.cariasansor'))->with('success', 'Cari Hesap Kayıtı Başarı İle Atandı');
            else
                return redirect(route('muhasebe.cari.cariasansor'))->with('error', 'Birşeyler Ters Gitti.');

        } else
            return redirect(route('muhasebe.cari.cariasansor'))->with('error', 'En Az Bir Seçim Yapın ');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {

        $start = new Carbon('first day of this month');
        $end = new Carbon('now');
        $faturaTop = Fatura::whereBetween('created_at',[$start,$end])
        ->sum('gentoplam');

        $parcalar = ParcaModel::where('cari_id', '!=', '')
            ->whereNull('fatura_no')
            ->join('asansor_models', 'parca_models.asansor_id', '=', 'asansor_models.id')
            ->select('parca_models.*', 'asansor_models.cari_id', 'asansor_models.apartman', 'asansor_models.blok')
            ->count();

        $bakimlar = BakimModel::where('cari_id', '!=', '')
            ->whereNull('fatura_no')
            ->join('asansor_models', 'bakim_models.asansor_id', '=', 'asansor_models.id')
            ->select('bakim_models.*', 'asansor_models.apartman', 'asansor_models.cari_id', 'asansor_models.blok', 'asansor_models.bakim_ucreti')
            ->count();


        $toplamBorcBakiye = Cari::where('durum','=',1)
            ->sum('borc_bakiye');
        $toplamAlacakBakiye = Cari::where('durum','=',1)
            ->sum('alacak_bakiye');
        $topTahsilat = Cariharaket::where('tur','=',1)
        ->whereBetween('created_at',[$start,$end])
        ->sum('tutar');
//        dd($topTahsilat);



    $cari = Cari::where('durum','=',1)
        ->get();

        return view('muhasebe.index', compact('toplamBorcBakiye', 'toplamAlacakBakiye', 'parcalar', 'bakimlar','faturaTop','topTahsilat'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tahsilatindex()
    {
        $cari = Cari::where('durum', '=', '1')->get();
        return view('muhasebe.cari.tahsilat', compact('cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('muhasebe.cari.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cari = new Cari();
        $cari->cari_unvan = $request->cari_unvan;
        $cari->adres = $request->adres;
        $cari->telefon = $request->tel;
        $cari->ilgili_kisi = $request->ilgili_kisi;
        if (!isset($request->alacak_bakiye))
            $cari->alacak_bakiye = 0;
        else
            $cari->alacak_bakiye = $request->alacak_bakiye;
        if (!isset($request->borc_bakiye))
            $cari->borc_bakiye = 0;
        else
            $cari->borc_bakiye = $request->borc_bakiye;
        $cari->vergi_dairesi = $request->vergi_dairesi;
        $cari->vergi_numarasi = $request->vergi_numarasi;
        $saved = $cari->save();
        if ($saved)
            return redirect(route('muhasebe.cari.index'))->with('success', 'Cari Hesap Kayıtı Başarı İle Oluşturuldu');
        else
            return redirect(route('muhasebe.cari.index'))->with('error', 'Birşeyler Ters Gitti.');
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
        $cari = Cari::find($id);
        return view('muhasebe.cari.edit', compact('cari'));

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
        $cari = Cari::find($id);
        $cari->cari_unvan = $request->cari_unvan;
        $cari->adres = $request->adres;
        $cari->telefon = $request->tel;
        $cari->ilgili_kisi = $request->ilgili_kisi;
        if (!isset($request->alacak_bakiye))
            $cari->alacak_bakiye = 0;
        else
            $cari->alacak_bakiye = $request->alacak_bakiye;
        if (!isset($request->borc_bakiye))
            $cari->borc_bakiye = 0;
        else
            $cari->borc_bakiye = $request->borc_bakiye;
        $cari->vergi_dairesi = $request->vergi_dairesi;
        $cari->vergi_numarasi = $request->vergi_numarasi;
        $saved = $cari->save();
        if ($saved)
            return redirect(route('muhasebe.cari.index'))->with('success', 'Cari Hesap Kayıtı Başarı İle Düzenlendi');
        else
            return redirect(route('muhasebe.cari.index'))->with('error', 'Birşeyler Ters Gitti.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asansor = AsansorModel::where('cari_id', '=', $id);
        foreach ($asansor as $key => $asansors) {
            $asansors->cari_id = null;
            $asansor->save();
        }


        $cari = Cari::find($id);
        $cari->durum = 0;
        $saved = $cari->save();
        if ($saved)
            return redirect(route('muhasebe.cari.index'))->with('success', 'Cari Hesap Kaydı Başarı İle Silindi');
        else
            return redirect(route('muhasebe.cari.index'))->with('error', 'Birşeyler Ters Gitti.');
    }
}
