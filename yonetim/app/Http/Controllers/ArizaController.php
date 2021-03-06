<?php

namespace App\Http\Controllers;

use App\ArizaModel;
use App\AsansorModel;
use App\BakimModel;
use App\BelgeModel;
use App\Exports\MesaiExport;
use App\Exports\ParcaExport;
use App\ParcaModel;
use App\User;
use App\smsModel;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\InputMedia\InputMediaPhoto;
use URL;

class ArizaController extends Controller
{
    public function deneme()
    {
        $mesaj='asdasdasd';
        $phone='905465510345,905394776525';

        $sonuc=$this->smsgonder($mesaj,$phone);

        dd($sonuc);
    }

    public function index()
    {

        $asansor = AsansorModel::where('asansor_models.durum', '=', 1)
            ->select('asansor_models.*', DB::raw("(select count(*) from ariza_models
                    where ariza_models.asansor_id=asansor_models.id group by asansor_id) as ariza_sayisi"))
            ->orderBy('ariza_sayisi', 'desc')
            ->get();

        return view('ariza.index', compact('asansor'));
    }

    public function arizalar()
    {

        $ariza = ArizaModel::where('durum', '=', 1)->get();

        return view('ariza.arizalar', compact('ariza'));
    }


    public function gecmis()
    {

        $ariza = ArizaModel::where('durum', '=', 2)
            ->orderBy('updated_at', 'desc')->get();

        return view('ariza.gecmis', compact('ariza'));
    }

    public function mesailer()
    {


        $start = new Carbon('first day of last month');
        $start->startOfMonth();
        $end = new Carbon('last day of last month');
        $end->endOfMonth();

        $arizalar = ArizaModel::where('durum', '=', 2)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->where(function ($query) {
                $query->WHERETIME('created_at', '>', '18:30:00')
                    ->orwhereRaw('WEEKDAY(ariza_models.created_at) = 6');
            })
            ->orderBy('user_id')
            ->get();

        return view('ariza.mesailer', compact('arizalar'));
    }


    public function create($id)
    {

        $asansor = AsansorModel::find($id);
        $user = User::where('durum', '=', 1)->get();
        return view('ariza.create', compact('asansor', 'user'));
    }


    public function store(Request $request, $id)
    {
        $ariza = new ArizaModel();
        $ariza->asansor_id = $id;
        $ariza->icindebiri = $request->icindebiri;
        $ariza->fotosel = $request->fotosel;
        $ariza->lamba = $request->lamba;
        $ariza->calismiyor = $request->calismiyor;
        $ariza->sesgeliyor = $request->sesgeliyor;
        $ariza->kapisurtme = $request->kapisurtme;
        $ariza->disinda = $request->disinda;
        $ariza->user_id = $request->atanan_id;
        $ariza->ariza_not = $request->ariza_not;
        $saved = $ariza->save();

        if ($saved) {


            // telegram
            $asansor = AsansorModel::find($id);
            $user = User::find($ariza->user_id);


            $url = URL::to('/ariza/gider/' . $ariza->id);
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => '???' . 'Ar??za Gider', 'url' => $url]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);


            $text = "<b>Yeni Ar??za Kayd??</b>\n"
                . "--------------------------------\n"
                . "<b>Apartman :</b>" . $asansor->apartman . "\n"
                . "<b>Blok :</b>" . $asansor->blok . "\n"
                . "<b>Adres :</b>" . $asansor->adres . "\n"
                . "<b>Y??netici :</b>" . $asansor->yonetici . "\n"
                . "<b>Y??netici Tel : </b>\t" . $this->clean_tel($asansor->yonetici_tel) . "\n\n"
                . '???' . "<b>Ar??za Detaylar??</b>\n"
                . "--------------------------------\n";
            if ($ariza->icindebiri == 1) {
                $text .= "-Asans??r ????inde Birisi Kalm????\n";
            }
            if ($ariza->fotosel == 1) {
                $text .= "-Fotosel Ar??zas??\n";
            }
            if ($ariza->calismiyor == 1) {
                $text .= "-Asans??r ??al????m??yor, Ba??ka Bilgi Verilmedi\n";
            }
            if ($ariza->lamba == 1) {
                $text .= "-Kabin ????i Lamba S??rekli Yan??yor\n";
            }
            if ($ariza->sesgeliyor == 1) {
                $text .= "-Ses Geliyor\n";
            }
            if ($ariza->kapisurtme == 1) {
                $text .= "-Kap?? S??rtmesi\n";
            }
            if ($ariza->disinda != null) {
                $text .= "-" . $ariza->disinda . "\n";
            }
            if ($ariza->user_id != null) {
                $text .= "\n<b>?????????????Atanan Ki??i</b>\n";
                $text .= "--------------------------------\n";
                $text .= $user->name . "\n";
            }


            Telegram::sendMessage([
                'chat_id' => Config::get('chat_id.ariza'),
                'parse_mode' => 'HTML',
                'text' => $text,
                'reply_markup' => $encodedKeyboard
            ]);


            return redirect(route('ariza.arizalar'))->with('success', 'Ar??za Eklendi');
        } else {

            return redirect(route('ariza.index'))->with('error', 'Ar??za Eklenemedi');
        }

    }

    public function gecmisEdit($id)
    {


        $ariza = ArizaModel::find($id);
        $user = User::where('durum', '=', 1)->get();
        $parca = ParcaModel::where('ariza_id', $id)->get();
        return view('ariza.gecmisedit', compact('ariza', 'user', 'parca'));

    }

    public function gecmisArizalar($id)
    {


        $ariza = AsansorModel::join('ariza_models', 'asansor_id', '=', 'asansor_models.id')
            ->select('asansor_models.apartman', 'asansor_models.blok', 'ariza_models.*')
            ->where('asansor_models.id', '=', $id)
            ->get();


        return view('ariza.gecmisArizalar', compact('ariza'));

    }


    public function edit($id)
    {
        $ariza = ArizaModel::find($id);
        $user = User::where('durum', '=', 1)->get();

        return view('ariza.edit', compact('ariza', 'user'));

    }


    public function gider($id)
    {
        $ariza = ArizaModel::find($id);

        if ($ariza->durum == 2) {
            return redirect(route('ariza.gecmis'))->with('success', 'Bu ar??za Giderilmi??');
        } else {
            return view('ariza.gider', compact('ariza'));
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //ar??za bittikten sonra
    {

        $ariza = ArizaModel::find($id);
        $ariza->icindebiri = $request->icindebiri;
        $ariza->fotosel = $request->fotosel;
        $ariza->lamba = $request->lamba;
        $ariza->calismiyor = $request->calismiyor;
        $ariza->sesgeliyor = $request->sesgeliyor;
        $ariza->kapisurtme = $request->kapisurtme;
        $ariza->disinda = $request->disinda;
        $ariza->user_id = $request->atanan_id;
        $ariza->ariza_not = $request->ariza_not;
        if ($request->buyuk_ariza == 1) {
            $ariza->buyuk_ariza = "B??y??k Ar??za";
        }
        $saved = $ariza->save();

        if ($saved) {

            return redirect(route('ariza.arizalar'))->with('success', 'Ar??za Kaydedildi');
        } else {

            return redirect(route('ariza.arizalar'))->with('error', 'Ar??za Kaydedilemedi');
        }
    }


    public function smsgonder($message, $phones)
    {
        $sms_msg = array(
            "username" => "908508081889", // https://oim.verimor.com.tr/sms_settings/edit adresinden ????renebilirsiniz.
            "password" => "UcaAsn2021", // https://oim.verimor.com.tr/sms_settings/edit adresinden belirlemeniz gerekir.
            "source_addr" => 'UCAASANSOR', // G??nderici ba??l??????, https://oim.verimor.com.tr/headers adresinde onaylanm???? olmal??, de??ilse 400 hatas?? al??rs??n??z.
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


    public function updateGider(Request $request, $id)
    {
        $parcalar = "";

        $ariza = ArizaModel::find($id);
        $ariza->user_id = \Auth::user()->id;
        $ariza->ariza_not = $request->ariza_not;
        if ($request->buyuk_ariza == 1) {
            $ariza->buyuk_ariza = "B??y??k Ar??za";
            $ariza->durum = 1;
        } else {
            $ariza->durum = 2;
        }
        $saved = $ariza->save();

        if ($saved) {
            // Par??a Ekleme

            if ($request->parca != null) {
                foreach ($request->parca as $key => $value) {

                    $parca = new ParcaModel();
                    $parca->ariza_id = $ariza->id;
                    $parca->asansor_id = $ariza->asansor_id;
                    $parca->parca = $value['ad'];
                    $parca->miktar = $value['miktar'];
                    $parca->birim = $value['birim'];
                    $parca->tarih = date('Y-m-d');
                    $parca->sekil = 'Ar??za';
                    $parca->user_id = \Auth::user()->id;
                    $parca->save();
                    $parcalar .= "Parca Ad?? : " . $value['ad'] . "  Miktar: " . $value['miktar'] . "  Birim: " . $value['birim'] . "\n";
                }


            }
            // telegram
            $asansor = AsansorModel::find($ariza->asansor_id);
            $user = User::find($ariza->user_id);
            $y??neticiMesaj = "mesaj g??nderilmedi";

            // SMS G??nderimi
            if (isset($request->CbMesaj)) {
                $phone = $request->yonetici_tel;
                $phone='90'.str_replace(str_split('()-\ '), '', $phone);

                $mesaj = $request->mesaj;

                $sonuc = $this->smsgonder($mesaj, $phone);

                if ($sonuc) {
                    $y??neticiMesaj = $this->clean_tel($asansor->yonetici_tel) . "=> $mesaj";
                    $sms = new smsModel();
                    $sms->phone = $phone;
                    $sms->mesaj = $mesaj;
                    $sms->save();

                }
            }


            if ($request->buyuk_ariza == 1) {
                $text = '??????' . "<b>Ar??za Giderilemedi</b>\n"
                    . "--------------------------------\n"
                    . "<b>Apartman :</b>" . $asansor->apartman . "\n"
                    . "<b>Blok :</b>" . $asansor->blok . "\n"
                    . "<b>Adres :</b>" . $asansor->adres . "\n"
                    . "<b>Y??netici :</b>" . $asansor->yonetici . "\n"
                    . "<b>Y??netici Tel : </b>\t" . $this->clean_tel($asansor->yonetici_tel) . "\n\n"
                    . '???' . "<b>Ar??za Detaylar??</b>\n"
                    . "--------------------------------\n";
                if ($ariza->icindebiri == 1) {
                    $text .= "-Asans??r ????inde Birisi Kalm????\n";
                }
                if ($ariza->fotosel == 1) {
                    $text .= "-Fotosel Ar??zas??\n";
                }
                if ($ariza->calismiyor == 1) {
                    $text .= "-Asans??r ??al????m??yor, Ba??ka Bilgi Verilmedi\n";
                }
                if ($ariza->lamba == 1) {
                    $text .= "-Kabin ????i Lamba S??rekli Yan??yor\n";
                }
                if ($ariza->sesgeliyor == 1) {
                    $text .= "-Ses Geliyor\n";
                }
                if ($ariza->kapisurtme == 1) {
                    $text .= "-Kap?? S??rtmesi\n";
                }
                if ($ariza->disinda != null) {
                    $text .= "-" . $ariza->disinda . "\n";
                }
                if ($ariza->user_id != null) {
                    $text .= "\n<b>?????????????Ar??zaya Giden Ki??i</b>\n";
                    $text .= "--------------------------------\n";
                    $text .= $user->name . "\n";
                }
                if ($ariza->ariza_not != null) {
                    $text .= "\n<b>??????Ar??zac?? Notu</b>\n";
                    $text .= "--------------------------------\n";
                    $text .= $ariza->ariza_not . "\n";

                }
                if ($parcalar) {
                    $text .= "\n<b>???? De??i??en Par??alar</b>\n";
                    $text .= "--------------------------------\n";
                    $text .= $parcalar . "\n";
                }

                $text .= "\n<b>???? SMS Bilgilendirme</b>\n";
                $text .= "--------------------------------\n";
                $text .= $y??neticiMesaj;

            } else {
                ///////////////////////////////////////////////////*********************////////////////////////////////////


                // $y??neticiMesaj ="mesaj g??nderilmedi.".$request->CbMesaj;


                $text = "<b>???????????? Ar??za Giderildi ????????????</b>\n"
                    . "--------------------------------\n"
                    . "<b>Apartman :</b>" . $asansor->apartman . "\n"
                    . "<b>Blok :</b>" . $asansor->blok . "\n"
                    . "<b>Adres :</b>" . $asansor->adres . "\n"
                    . "<b>Y??netici :</b>" . $asansor->yonetici . "\n"
                    . "<b>Y??netici Tel : </b>\t" . $this->clean_tel($asansor->yonetici_tel) . "\n\n"
                    . '???' . "<b>Ar??za Detaylar??</b>\n"
                    . "--------------------------------\n";
                if ($ariza->icindebiri == 1) {
                    $text .= "-Asans??r ????inde Birisi Kalm????\n";
                }
                if ($ariza->fotosel == 1) {
                    $text .= "-Fotosel Ar??zas??\n";
                }
                if ($ariza->calismiyor == 1) {
                    $text .= "-Asans??r ??al????m??yor, Ba??ka Bilgi Verilmedi\n";
                }
                if ($ariza->lamba == 1) {
                    $text .= "-Kabin ????i Lamba S??rekli Yan??yor\n";
                }
                if ($ariza->sesgeliyor == 1) {
                    $text .= "-Ses Geliyor\n";
                }
                if ($ariza->kapisurtme == 1) {
                    $text .= "-Kap?? S??rtmesi\n";
                }
                if ($ariza->disinda != null) {
                    $text .= "-" . $ariza->disinda . "\n";
                }
                if ($ariza->ariza_not != null) {
                    $text .= "\n<b>??????Ar??zac?? Notu</b>\n";
                    $text .= "--------------------------------\n";
                    $text .= $ariza->ariza_not . "\n";
                }
                if ($parcalar) {
                    $text .= "\n<b>???? De??i??en Par??alar</b>\n";
                    $text .= "--------------------------------\n";
                    $text .= $parcalar . "\n";
                }
                if ($ariza->user_id != null) {
                    $text .= "\n<b>???? Ar??za Raporu</b>\n";
                    $text .= "--------------------------------\n";
                    $text .= "<b>Ar??zay?? Gideren :</b>" . $user->name . "\n";
                    $text .= "<b>M??dahale S??resi :</b>" . \Carbon\Carbon::createFromTimeStamp(strtotime($ariza->created_at))->diffForHumans(\Carbon\Carbon::createFromTimeStamp(strtotime($ariza->updated_at)), true) . "\n";

                }

                $text .= "\n<b>???? SMS Bilgilendirme</b>\n";
                $text .= "--------------------------------\n";
                $text .= $y??neticiMesaj;

            }


            Telegram::sendMessage([
                'chat_id' => Config::get('chat_id.ariza'),
                'parse_mode' => 'HTML',
                'text' => $text,
            ]);

//veri taban?? kayd?? , y??neticiye sms g??derildiyse telegram da bildirim

            return redirect(route('ariza.arizalar'))->with('success', 'Ar??za Kaydedildi');
        } else {

            return redirect(route('ariza.arizalar'))->with('error', 'Ar??za Kaydedilemedi');
        }
    }

    public function gecmisUpdate(Request $request, $id)
    {

        $ariza = ArizaModel::find($id);
        $ariza->user_id = $request->atanan_id;
        $ariza->ariza_not = $request->ariza_not;
        $ariza->durum = 2;
        $saved = $ariza->save();

        if ($saved) {

            return redirect(route('ariza.gecmis'))->with('success', 'Ar??za D??zenlendi');
        } else {

            return redirect(route('ariza.gecmis'))->with('error', 'Ar??za D??zenlenemedi');
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
        $update = ArizaModel::find($id)->update(['durum' => 0]);

        if (!$update) {
            return redirect(route('ariza.arizalar'))->with('error', 'Ar??za Kayd?? Silinemedi');
        } else {

            return redirect(route('ariza.arizalar'))->with('success', 'Ar??za Kayd?? Silindi');
        }
    }


    function clean_tel($string)
    {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = "0" . $string;
        return preg_replace('/[^0-9]/', '', $string); // Removes special chars.
    }


    public function mesaiExport()
    {

        return Excel::download(new MesaiExport(), 'mesai.xlsx');
    }
}
