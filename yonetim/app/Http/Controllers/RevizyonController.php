<?php

namespace App\Http\Controllers;

use App\AsansorModel;
use App\BakimModel;
use App\Exports\RevizyonGecmisExport;
use App\RevizyonModel;
use App\TeklifModel;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RevizyonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $asansor = AsansorModel::where('durum', '=', 1)->get();

        return view('revizyon.index', compact('asansor'));
    }

    public function revizyonYap()
    {

        $asansor = AsansorModel::whereIn('durum', [1, 2])->get();

        return view('revizyon.index', compact('asansor'));
    }


    public function revizyonGereken()
    {

        $revizyon = RevizyonModel::whereIn('revizyon_models.durum', [1, 3])
            ->join('asansor_models', 'revizyon_models.asansor_id', '=', 'asansor_models.id')
            ->select('revizyon_models.*', 'asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok')
            ->get();

        return view('revizyon.gereken', compact('revizyon'));
    }


    public function revizyonGecmis()
    {

        $revizyon = RevizyonModel::where('revizyon_models.durum', '=', 2)->get();

        return view('revizyon.revizyonGecmis', compact('revizyon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $revizyon = RevizyonModel::find($id);
        $asansor = AsansorModel::find($revizyon->asansor_id);
        return view('revizyon.create', compact('asansor', 'revizyon'));
    }

    public function teklifCreate($id)
    {

        $asansor = AsansorModel::find($id);
        return view('revizyon.teklifCreate', compact('asansor'));
    }

    public function teklifSend($id, Request $request)
    {
        $tarih = $request->tarih;
        $rapor_tarihi = $request->rapor_tarihi;
        $apartman = $request->apartman;
        $yonetici = $request->yonetici;
        $yonetici_tel = $request->yonetici_tel;
        $burak = $request->burak;
        $burak_gorev = $request->burak_gorev;
        $burak_tel = $request->burak_tel;
        $burak_mail = $request->burak_mail;
        $urun = $request->urun;
        $alttoplam = $request->alttoplam;
        $altkdv = $request->altkdv;
        $altgentoplam = $request->altgentoplam;

        switch ($request->input('action')) {
            case 'save':
                $teklif = new TeklifModel();
                $teklif->asansor_id = $id;
                $teklif->tarih = $tarih;
                $teklif->rapor_tarihi = $rapor_tarihi;
                $teklif->musteri = $apartman;
                $teklif->musteri_yetkili = $yonetici;
                $teklif->musteri_tel = $yonetici_tel;
                $teklif->sirket_yetkili = $burak;
                $teklif->sirket_gorev = $burak_gorev;
                $teklif->sirket_tel = $burak_tel;
                $teklif->sirket_email = $burak_mail;
                $teklif->urun = json_encode($urun);
                $teklif->toplam = $alttoplam;
                $teklif->kdv = $altkdv;
                $teklif->gentoplam = $altgentoplam;
                $teklif->save();


                $teklifler = TeklifModel::where('teklif_models.durum', '1')
                    ->join('asansor_models', 'teklif_models.asansor_id', '=', 'asansor_models.id')
                    ->select('teklif_models.*', 'asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok', 'teklif_models.pdf')
                    ->get();
                $user = User::where('durum', '=', 1)->get();

                return view('revizyon.sozlesme', compact('teklifler', 'user'));

                break;

            case 'print':

                return view('revizyon.teklifPrint', compact('tarih', 'rapor_tarihi', 'apartman', 'yonetici', 'yonetici_tel', 'burak', 'burak_gorev', 'burak_tel',
                    'burak_mail', 'urun', 'alttoplam', 'altkdv', 'altgentoplam'));
                break;

            case 'pdf':

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        DB::beginTransaction();

        try {

            $revizyon = RevizyonModel::find($id);
            $revizyon->ekstra = $request->ekstra;
            $revizyon->user_id = \Auth::user()->id;
            $revizyon->tarih = $request->tarih;
            $revizyon->durum = 2;
            $revizyon->save();

            DB::commit();

            return redirect(route('revizyon.revizyonGereken'))->with('success', 'Revizyon Eklendi');
            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return redirect(route('revizyon.revizyonGereken'))->with('error', 'Revizyon Eklenemedi');
            // something went wrong
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $revizyon = RevizyonModel::find($id);
        $user = User::where('durum', '=', 1)->get();
        return view('revizyon.detay', compact('revizyon', 'user'));

    }

    public function revizyonlar()
    {

        $revizyon = RevizyonModel::where('durum', '=', 2)->get();

        return view('revizyon.revizyonlar', compact('revizyon'));
    }


    public function sozlesmeBekleyen()
    {

        $teklifler = TeklifModel::where('teklif_models.durum', '1')
            ->join('asansor_models', 'teklif_models.asansor_id', '=', 'asansor_models.id')
            ->select('teklif_models.*', 'asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok', 'teklif_models.pdf')
            ->get();
        $user = User::where('durum', '=', 1)->get();

        return view('revizyon.sozlesme', compact('teklifler', 'user'));
    }

    public function teklifGecmis()
    {

        $teklifler = TeklifModel::whereIn('teklif_models.durum', [2, 3])
            ->join('asansor_models', 'teklif_models.asansor_id', '=', 'asansor_models.id')
            ->select('teklif_models.*', 'asansor_models.kimlik as apt_kimlik', 'asansor_models.apartman as apt_apartman', 'asansor_models.blok as apt_blok', 'teklif_models.pdf')
            ->get();
        $user = User::where('durum', '=', 1)->get();

        return view('revizyon.teklifGecmis', compact('teklifler', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function etiketDegistir(Request $request)
    {

        $asansor = AsansorModel::find($request->asansor_id);
        $asansor->etiket = $request->etiket;
        $asansor->etiket_tarihi = $request->etiket_tarihi;
        if ($request->etiket == 'Kırmızı') {
            $asansor->sozlesme = 'Bekliyor';
        } elseif ($request->etiket == 'Sarı') {
            $asansor->sozlesme = 'Bekliyor';
        }
        $asansor->etiket_deg_tarihi = date('Y-m-d');
        $saved = $asansor->save();


        if (!$saved) {
            return redirect(route('revizyon.revizyonYap'))->with('error', 'Asansör Düzenlenemedi');
        } else {

            return redirect(route('revizyon.revizyonYap'))->with('success', 'Asansör Düzenlendi');
        }


    }


    public function sozlesmeDegistir(Request $request)
    {

        $teklif = TeklifModel::find($request->teklif_id);
        $asansor_id = $teklif->asansor_id;
        $asansor = AsansorModel::find($asansor_id);


        if ($request->sozlesme == 'Onaylandı') {
            $teklif->durum = 2;

            $revizyon = new RevizyonModel();
            $revizyon->asansor_id = $asansor_id;
            $revizyon->teklif_id = $request->teklif_id;
            $revizyon->user_id = $request->user_id;
            $revizyon->pdf = $teklif->pdf;
            $revizyon->save();
        } elseif ($request->sozlesme == 'Reddedildi') {

            $teklif->durum = 3;
        }

        if ($request->pasifCheck == '1') {
            $asansor->durum = 2;
        }
        $saved = $asansor->save();
        $saved2 = $teklif->save();


        if (!$saved || !$saved2) {
            return redirect(route('revizyon.sozlesmeBekleyen'))->with('error', 'Teklif Düzenlenemedi');
        } else {

            return redirect(route('revizyon.sozlesmeBekleyen'))->with('success', 'Teklif Düzenlendi');
        }


    }

    public function pdfGetir($id)
    {
        $teklif = TeklifModel::find($id);


        $path = $teklif->pdf;


        $pathToFile = 'storage/app/' . $path;
        return response()->file($pathToFile);


    }


    public function pdfDegistir(Request $request)
    {

        $teklif = TeklifModel::find($request->teklif_id);

        $file = $request->file('pdf');
        $filename = "teklifid" . $teklif->id . "_" . date("Y-m-d") . "." . $file->getClientOriginalExtension();

        $path = $file->storeAs('pdf', $filename);


        $teklif->pdf = $path;

        $saved = $teklif->save();

        if (!$saved) {
            return redirect(route('revizyon.sozlesmeBekleyen'))->with('error', 'Teklif Düzenlenemedi');
        } else {

            return redirect(route('revizyon.sozlesmeBekleyen'))->with('success', 'Teklif Düzenlendi');
        }


    }


    public function edit($id)
    {

        $revizyon = RevizyonModel::find($id);
        $user = User::where('durum', '=', 1)->get();
        return view('revizyon.edit', compact('revizyon', 'user'));
    }
    public function softDelete($id)
    {

        $revizyon = RevizyonModel::find($id);
        $revizyon->durum = 1;
        $saved = $revizyon->save();

        if ($saved)
            return redirect()->route('revizyon.revizyonGecmis')->with('success', 'Revizyon Silindi');
        else
            return redirect()->route('revizyon.revizyonGecmis')->with('error', 'Bir Şeyler Ters Gitti');

    }

    public function teklifEdit($id)
    {

        $teklif = TeklifModel::find($id);
        $urun = json_decode($teklif->urun);
        return view('revizyon.teklifEdit', compact('teklif', 'urun'));
    }


    public function teklifGoster($id)
    {

        $teklif = TeklifModel::find($id);
        $urun = json_decode($teklif->urun);

        return view('revizyon.teklifGoster', compact('teklif', 'urun'));
    }

    public function teklifSil($id)
    {

        $teklif = TeklifModel::find($id);
        $teklif->durum = 1;
        $saved = $teklif->save();

        if ($saved)
            return redirect()->route('revizyon.teklifGecmis')->with('success', 'Revizyon Silindi');
        else
            return redirect()->route('revizyon.teklifGecmis')->with('error', 'Bir Şeyler Ters Gitti');


    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $revizyon = RevizyonModel::find($id);
            $revizyon->ekstra = $request->ekstra;
            $revizyon->tarih = $request->tarih;
            $revizyon->fatura_no = $request->fatura_no;
            $revizyon->user_id = $request->user_id;
            if ($request->tamamlanamadi == '1') {
                $revizyon->durum = 3;
            }
            $revizyon->save();

            DB::commit();

            return redirect(route('revizyon.revizyonGecmis'))->with('success', 'Revizyon Düzenlendi');
            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return redirect(route('revizyon.revizyonGecmis'))->with('error', 'Revizyon Düzenlenemedi');
            // something went wrong
        }
    }


    public function teklifUpdate(Request $request, $id)
    {

        $tarih = $request->tarih;
        $rapor_tarihi = $request->rapor_tarihi;
        $apartman = $request->apartman;
        $yonetici = $request->yonetici;
        $yonetici_tel = $request->yonetici_tel;
        $burak = $request->burak;
        $burak_gorev = $request->burak_gorev;
        $burak_tel = $request->burak_tel;
        $burak_mail = $request->burak_mail;
        $urun = $request->urun;
        $alttoplam = $request->alttoplam;
        $altkdv = $request->altkdv;
        $altgentoplam = $request->altgentoplam;


        switch ($request->input('action')) {
            case 'save':

                $teklif = TeklifModel::find($id);

                $teklif->tarih = $tarih;
                $teklif->rapor_tarihi = $rapor_tarihi;
                $teklif->musteri = $apartman;
                $teklif->musteri_yetkili = $yonetici;
                $teklif->musteri_tel = $yonetici_tel;
                $teklif->sirket_yetkili = $burak;
                $teklif->sirket_gorev = $burak_gorev;
                $teklif->sirket_tel = $burak_tel;
                $teklif->sirket_email = $burak_mail;
                $teklif->urun = json_encode($urun);
                $teklif->toplam = $alttoplam;
                $teklif->kdv = $altkdv;
                $teklif->gentoplam = $altgentoplam;
                $saved = $teklif->save();


                if ($saved) {
                    return redirect(route('revizyon.sozlesmeBekleyen'))->with('success', 'Teklif Düzenlendi');

                } else {
                    return redirect(route('revizyon.sozlesmeBekleyen'))->with('error', 'Teklif Düzenlenemedi');
                }
                break;

            case 'print':

                return view('revizyon.teklifPrint', compact('tarih', 'rapor_tarihi', 'apartman', 'yonetici', 'yonetici_tel', 'burak', 'burak_gorev', 'burak_tel',
                    'burak_mail', 'urun', 'alttoplam', 'altkdv', 'altgentoplam'));
                break;

            case 'pdf':
                break;
        }


    }


    public function teklifDelete($id)
    {
        $update = TeklifModel::find($id)->update(['durum' => 0]);

        if (!$update) {
            return redirect(route('revizyon.sozlesmeBekleyen'))->with('error', 'Teklif Silinemedi');
        } else {

            return redirect(route('revizyon.sozlesmeBekleyen'))->with('success', 'Teklif Silindi');
        }
    }


    public function exportGecmis()
    {

        return Excel::download(new RevizyonGecmisExport(), 'revizyon_gecmis.xlsx');
    }
}
