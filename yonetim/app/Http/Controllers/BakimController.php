<?php

namespace App\Http\Controllers;

use App\ArizaModel;
use App\AsansorModel;
use App\BakimModel;
use App\Exports\BakimExport;
use App\ParcaModel;
use App\smsModel;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\Laravel\Facades\Telegram;
use URL;

class BakimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if ($id == 0) {

            $asansor = AsansorModel::where('durum', '=', 1)
                ->where('etiket', '!=', 'Kırmızı')
                ->where(function ($query) {
                    $query->orwhereDate('aylik_bakim', '<=', Carbon::now()->addMonthNoOverflow(-1)->addWeeks(1));
//                    $query->orwhere('aylik_bakim', null);
                })->get();

        } elseif ($id == 1) {

            $asansor = AsansorModel::where('durum', '=', 1)
                ->where('etiket', '!=', 'Kırmızı')
                ->where(function ($query) {
                    $query->orwhereDate('aylik_bakim', '<', Carbon::now()->firstOfMonth());
                    $query->orwhere('aylik_bakim', null);
                })->get();
        }

        $user = User::where('durum', '=', 1)->get();
        return view('bakim.index', compact('asansor', 'user'));
    }

    public function bakimci_asansor(User $user)
    {
        $asansor = $user->asansors;
        $user = User::where('durum', 1)
            ->get();
        return view('bakim.index', compact('asansor', 'user'));
    }

    public function bakimYap()
    {
        $user = User::where('durum', '=', 1)->get();
        $asansor = AsansorModel::where('durum', '=', 1)
            ->where('etiket', '!=', 'Kırmızı')
            ->get();

        return view('bakim.index', compact('asansor', 'user'));
    }

    public function bakimlar($id)
    {

        if ($id == 0) {
            $bakim = BakimModel::where('durum',1)->get();
        } elseif ($id == 1) {
            $bakim = BakimModel::whereDate('created_at', '>=', Carbon::now()->firstOfMonth())->where('durum',1)->get();
        } elseif ($id == 2) {
            $bakim = BakimModel::whereDate('created_at', '>=', Carbon::now())->where('durum',1)->get();
        }

        return view('bakim.bakimlar', compact('bakim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $asansor = AsansorModel::find($id);
        return view('bakim.create', compact('asansor'));
    }

    public function store(Request $request, $id)
    {
        $parcalar = "";

//        dd($request->file('images'));
//        echo url('/');

        $validatedData = $request->validate([
            'images.*' => 'mimes:jpeg,jpg,png',
        ]);

        DB::beginTransaction();

        try {

        $bakim = new BakimModel();
        $bakim->asansor_id = $id;
//        $bakim->yag = $request->yag;
//        $bakim->makina = $request->makina;
//        $bakim->kabin = $request->kabin;
//        $bakim->pano = $request->pano;
//        $bakim->kuyu = $request->kuyu;
//        $bakim->ekstra = $request->ekstra;
        $bakim->user_id = \Auth::user()->id;


        $images = array();
        if ($files = $request->file('images')) {

            foreach ($files as $key => $file) {
                $extension = $file->extension();
                $name = "bakimid" . $bakim->id . "_" . $key . "." . $extension;


                $img = Image::make($file)->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });


                $img->save('public/images/' . $name);
                $images[] = url('/public/images') . "/" . $name;
            }
        }


        $bakim->images = implode(";", $images);
        $saved=$bakim->save();

        if ($saved)
        {
            $asansor = AsansorModel::find($id);
            $asansor->update(['aylik_bakim' => Carbon::now()->format('Y-m-d')]);

        }




        // Parça Ekleme

        if ($request->parca != null) {

            foreach ($request->parca as $key => $value) {

                $parca = new ParcaModel();
                $parca->bakim_id = $bakim->id;
                $parca->asansor_id = $id;
                $parca->parca = $value['ad'];
                $parca->miktar = $value['miktar'];
                $parca->birim = $value['birim'];
                $parca->tarih = date('Y-m-d');
                $parca->sekil = 'Bakım';
                $parca->user_id = \Auth::user()->id;
                $parca->save();
                $parcalar .= "Parca Adı : " . $value['ad'] . "  Miktar: " . $value['miktar'] . "  Birim: " . $value['birim'] . "\n";


            }


        }






            // telegram
            $asansor = AsansorModel::find($bakim->asansor_id);
            $user = User::find($bakim->user_id);

            $text = "<b>Yeni Bakım Yapıldı</b>\n"
                . "--------------------------------\n"
                . "<b>Apartman :</b>" . $asansor->apartman . "\n"
                . "<b>Blok :</b>" . $asansor->blok . "\n";

            if ($parcalar) $text .= $parcalar;
            $text .= "<b>Bakım Yapan :</b>" . $user->name . "\n";

            Telegram::sendMessage([
                'chat_id' => Config::get('chat_id.bakim'),
                'parse_mode' => 'HTML',
                'text' => $text,
            ]);

            // SMS Gönderimi

            $phone = $asansor['yonetici_tel'];
            $phone='90'.str_replace(str_split('()-\ '), '', $phone);

            $mesaj = "Merhaba " . $asansor['yonetici'] . ", " . $asansor['apartman'] . " " . $asansor['blok'] . "'nin aylık periyodik bakımı yapılmıştır. Asansörünüzün bakım ve arıza geçmişini görmek için http://ucaasansor.net/asansor.php?q=" . $asansor['kimlik'] . " Uca Asansor";

            $sonuc = $this->smsgonder($mesaj, $phone);


            if ($sonuc) {
                $sms = new smsModel();
                $sms->phone = $phone;
                $sms->mesaj = $mesaj;
                $sms->save();

            }

            DB::commit();
            return redirect(route('bakim.index', 1))->with('success', 'Bakım Eklendi');
        }
        catch (\Exception $exception)
        {
            DB::rollback();

            dd($exception);
            return redirect(route('bakim.index', 1))->with('error', 'Bakım Eklenemedi');

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
        $bakim = BakimModel::find($id);
        $parca = ParcaModel::where('bakim_id', $bakim->id)->get();
        $user = User::where('durum', '=', 1)->get();
        return view('bakim.detay', compact('bakim', 'user', 'parca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bakim = BakimModel::find($id);
        $user = User::where('durum', '=', 1)->get();
        return view('bakim.edit', compact('bakim', 'user'));
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

            $bakim = BakimModel::find($id);
            $bakim->yag = $request->yag;
            $bakim->makina = $request->makina;
            $bakim->kabin = $request->kabin;
            $bakim->pano = $request->pano;
            $bakim->kuyu = $request->kuyu;
            $bakim->ekstra = $request->ekstra;
            $bakim->user_id = $request->user_id;
            $bakim->fatura_no = $request->fnumara;
            $bakim->save();
            AsansorModel::find($bakim->asansor_id)->update(['aylik_bakim' => Carbon::now()->format('Y-m-d')]);

            DB::commit();

            return redirect(route('bakim.bakimlar', 0))->with('success', 'Bakım Düzenlendi');
            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return redirect(route('bakim.bakimlar', 0))->with('error', 'Bakım Düzenlenemedi' . $e);
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $bakim = BakimModel::find($id);
            $bakim->durum = 0;
            $bakim->save();
            AsansorModel::find($bakim->asansor_id)->update(['aylik_bakim' => null]);
            ParcaModel::where('bakim_id',$id)->delete();

            DB::commit();


            // telegram
            $asansor = AsansorModel::find($bakim->asansor_id);
            $user = User::find($bakim->user_id);

            $text = "<b>‼️ Dikkat Bakım Silindi</b>\n"
                . "--------------------------------\n"
                . "<b>Apartman :</b>" . $asansor->apartman . "\n"
                . "<b>Blok :</b>" . $asansor->blok . "\n"
                . "<b>Bakımı Silen :</b>" . $user->name . "\n";


            Telegram::sendMessage([
                'chat_id' => Config::get('chat_id.bakim'),
                'parse_mode' => 'HTML',
                'text' => $text,
            ]);

            return back()->with('success', 'Bakım Silindi');
            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Bakım Silinemedi' . $e);
            // something went wrong
        }
    }

    public function export()
    {

        return Excel::download(new BakimExport(), 'bakim_yapilacaklar.xlsx');
    }

    public function smsgonder($message, $phones)
    {

        $sms_msg = array(
            "username" => "908508081889", // https://oim.verimor.com.tr/sms_settings/edit adresinden öğrenebilirsiniz.
            "password" => "UcaAsn2021", // https://oim.verimor.com.tr/sms_settings/edit adresinden belirlemeniz gerekir.
            "source_addr" => 'UCAASANSOR', // Gönderici başlığı, https://oim.verimor.com.tr/headers adresinde onaylanmış olmalı, değilse 400 hatası alırsınız.
//    "valid_for" => "48:00",
//    "send_at" => "2015-02-20 16:06:00",
//    "datacoding" => "0",
            "custom_id" => "1424441160.9331344",
            "messages" => array(
                array(
                    "msg" => $message,
                    "dest" => $phones
                )
            )
        );
        $ch = curl_init('http://sms.verimor.com.tr/v2/send.json');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => json_encode($sms_msg),
        ));
        $http_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            echo "$http_code $http_response\n";
            return false;
        }

        return $http_response;
    }

    static function sendRequest($site_name, $send_xml, $header_type)
    {

        //die('SITENAME:'.$site_name.'SEND XML:'.$send_xml.'HEADER TYPE '.var_export($header_type,true));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site_name);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $send_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_type);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        $result = curl_exec($ch);

        return $result;
    }


    public function bakimci_ata(Request $request)
    {
        if ($request->checkbox) {

            if ($request->bu_ay_bakim_tarih && $request->bakimci_id == '')
                return back()->with('error', 'En az bir tane bakımcı seçiniz');
            else {
                foreach ($request->checkbox as $key => $value) {
                    $asansor = AsansorModel::find($value);
                    $asansor->bu_ay_bakim_tarih = $request->bu_ay_bakim_tarih;
                    $asansor->bakimci_id = $request->bakimci_id;
                    $saved[] = $asansor->save();

                }
                if ((count(array_unique($saved)) === 1)) //check all $saved values.
                    return back()->with('success', 'Seçilen Asansörlere Bakımcı ve Tarih Atandı');
                else
                    return back()->with('error', 'Bir Şeyler Ters Gitti');

            }


        } else
            return back()->with('error', 'En az bir tane asansör seçiniz');
    }
}
