<?php

namespace App\Http\Controllers;

use App;
use App\DurumModel;
use App\GorevModel;
use App\OnemModel;
use App\User;
use App\YorumModel;
use Illuminate\Http\Request;
use Auth;
use Mail;

class GorevController extends Controller
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
            $gorevler=\App\GorevModel::where('sahip_id','=',Auth::user()->id)
                ->where('durum','!=',4)
                ->where('durum','!=',5)
                ->where('atanan_id','!=',Auth::user()->id)
                ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
                ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
                ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
                ->orderBy('id', 'DESC')
                ->get();
        }
        elseif ($id==2)
        {
            $gorevler=\App\GorevModel::where('atanan_id','=',Auth::user()->id)
                ->where('durum','!=',4)
                ->where('durum','!=',5)
                ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
                ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
                ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
                ->orderBy('id', 'DESC')
                ->get();
        }

        elseif ($id==3)
        {
            $gorevler=\App\GorevModel::where(function($query){
                                            $query->where('atanan_id','=',Auth::user()->id)
                                                ->orwhere('sahip_id','=',Auth::user()->id);
                                        })
                ->where('durum','!=',4)
                ->where('durum','!=',5)
                ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
                ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
                ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
                ->orderBy('id', 'DESC')
                ->get();
        }


        return view('gorevler.index',compact('gorevler'));
    }


    public function tamamlanan()
    {

        $gorevler=\App\GorevModel::where('durum','=',4)
            ->where('sahip_id','=',Auth::user()->id)
            ->join('durum_models', 'gorev_models.durum', '=', 'durum_models.id')
            ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
            ->select('gorev_models.*', 'durum_models.name as durum_name', 'onem_models.name as onem_name')
            ->orderBy('id', 'DESC')
            ->get();
        return view('gorevler.tamamlanan',compact('gorevler'));
    }

    public function bildirimler()
    {

        $bildirimler=\App\BildirimModel::where('user_id','=',Auth::user()->id)
            ->join('gorev_models', 'bildirim_models.gorev_id', '=', 'gorev_models.id')
            ->join('bildirim_turs', 'bildirim_models.bildirim_turu', '=', 'bildirim_turs.id')
            ->select('bildirim_models.*', 'gorev_models.baslik as gorev_name', 'bildirim_turs.name as bildirim_name')
            ->orderBy('id', 'DESC')
            ->take(20)
            ->get();
        return view('gorevler.bildirimler',compact('bildirimler'));
    }


    public function arsiv()
    {

        $gorevler=\App\GorevModel::where('durum','=',5)
            ->where('sahip_id','=',Auth::user()->id)
            ->join('onem_models', 'gorev_models.onem_id', '=', 'onem_models.id')
            ->select('gorev_models.*','onem_models.name as onem_name')
            ->orderBy('id', 'DESC')
            ->get();
        return view('gorevler.arsiv',compact('gorevler'));
    }

    public function create()
    {

        $user=User::where('durum','=',1)->get();
        $onem=OnemModel::all();

        return view('gorevler.create',compact('user','onem'));
    }



    public function createYorum(Request $request,$id)
    {
        $yorum=new App\YorumModel();
        $yorum->gorev_id=$id;
        $yorum->user_id=Auth::user()->id;
        $yorum->yorum=$request->yorum;
        $saved=$yorum->save();

        if(!$saved){
            return redirect(route('gorev.detay',$id))->with('error','Yorum Eklenemedi');
        }
        else
        {

            $yorum_user=App\User::find(Auth::user()->id)->name;
            $diger_user="";
            $diger_mail="";
            $diger_userid=0;
            if($yorum->user_id==GorevModel::find($id)->sahip_id)
            {
                $diger_user=GorevModel::find($id)->atananFunc->name;
                $diger_mail=GorevModel::find($id)->atananFunc->email;
                $diger_userid=GorevModel::find($id)->atananFunc->id;
            }
            elseif ($yorum->user_id==GorevModel::find($id)->atanan_id)
            {
                $diger_user=GorevModel::find($id)->sahipFunc->name;
                $diger_mail=GorevModel::find($id)->sahipFunc->email;
                $diger_userid=GorevModel::find($id)->sahipFunc->id;
            }

            if(App\User::find($diger_userid)->sms_bild==1 && App\User::find($diger_userid)->phone!=null)
            {
                $atanan=$diger_user;
                $baslik=GorevModel::find($id)->baslik;
                $phone=App\User::find($diger_userid)->phone;
                $phone='90'.str_replace(str_split('()-\ '), '', $phone);
                $mesaj="Merhaba ".$atanan.",  ".$baslik." ba??l??kl?? g??rev i??in yorum yap??lm????t??r. Detaylar i??in: https://www.ciftcilerelektrik.com.tr/istakip";

                $this->smsgonder($mesaj,$phone);

            }

            if(App\User::find($diger_userid)->mail_bild==1) {
                //mail gonderme
                $data = array
                (
                    'yorum_user' => $yorum_user,
                    'diger_user' => $diger_user,
                    'gorev_baslik' => GorevModel::find($id)->baslik,
                    'yorum' => $request->yorum,
                    'diger_mail' => $diger_mail,
                );

                Mail::send('mail/yorum_create', $data, function ($message) use ($data) {
                    $message->subject('G??rev ????in Yorum Var!');
                    $message->from('info@cmsyazilim.net', '???? Takip Program??');
                    $message->to($data['diger_mail'], $data['diger_user']);
                });


                $bildirim=new App\BildirimModel();
                $bildirim->user_id=$diger_userid;
                $bildirim->gorev_id=$id;
                $bildirim->bildirim_turu=2;
                $bildirim->save();


            }

            return redirect(route('gorev.detay',$id))->with('success','Yorum Eklendi');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gorev=new GorevModel();
        $gorev->baslik=$request->baslik;
        $gorev->icerik=$request->icerik;
        $gorev->sahip_id=Auth::user()->id;
        $gorev->atanan_id=$request->atanan_id;
        $gorev->onem_id=$request->onem_id;
        $gorev->bas_zaman=$request->bas_zaman;
        $gorev->bitis_zaman=$request->bitis_zaman;
        $saved=$gorev->save();

        $gorev_id=$gorev->id;





        if(!$saved){
            return redirect(route('home'))->with('error','G??rev Eklenemedi');
        }
        else
        {
            //sms gonderme
            if(App\User::find($request->atanan_id)->sms_bild==1 && App\User::find($request->atanan_id)->phone!=null)
            {
                $atanan=App\User::find($request->atanan_id)->name;
                $atayan=App\User::find(Auth::user()->id)->name;
                $phone=App\User::find($request->atanan_id)->phone;
                $phone='90'.str_replace(str_split('()-\ '), '', $phone);
                $mesaj="Merhaba ".$atanan.",  ".$atayan." size yeni bir g??rev atam????t??r. Detaylar i??in: https://www.ciftcilerelektrik.com.tr/istakip";

                $this->smsgonder($mesaj,$phone);

            }


            if(App\User::find($request->atanan_id)->mail_bild==1)
            {

                //mail gonderme
                $data = array
                (
                    'atanan_user'=>App\User::find($request->atanan_id)->name,
                    'atayan_user'=>App\User::find(Auth::user()->id)->name,
                    'gorev_baslik'=>$request->baslik,
                    'gorev_icerik'=>$request->icerik,
                    'atanan_mail'=>App\User::find($request->atanan_id)->email,
                );

                Mail::send('mail/gorev_create', $data, function ($message) use ($data) {
                    $message->subject ('Yeni G??rev A????ld??!');
                    $message->from ('info@cmsyazilim.net', '???? Takip Program??');
                    $message->to($data['atanan_mail'], $data['atanan_user']);
                });
            }



            $bildirim=new App\BildirimModel();
            $bildirim->user_id=$request->atanan_id;
            $bildirim->gorev_id=$gorev_id;
            $bildirim->bildirim_turu=1;
            $bildirim->save();

            return redirect(route('home'))->with('success','G??rev Eklendi');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return bool
     */
    public function iliskilimi($gorev_id)
    {
        $gorev=GorevModel::find($gorev_id);
        if($gorev->sahip_id==Auth::user()->id || $gorev->atanan_id==Auth::user()->id  )
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gorev=GorevModel::find($id);
        if($gorev->sahip_id!=Auth::user()->id)
        {

            return redirect(route('home'))->with('error','G??revi Sadece G??rev Atayanlar D??zenleyebilir!');
        }



        $user=User::all();
        $onem=App\OnemModel::all();
        $durum=App\DurumModel::all();

        $yorum = YorumModel::where('gorev_id','=',$id)
            ->join('users', 'yorum_models.user_id', '=', 'users.id')
            ->select('yorum_models.*', 'users.name as user_name')
            ->orderBy('id', 'DESC')
            ->get();




        return view ('gorevler.edit',compact('gorev','user','onem','durum','yorum'));


    }


    public function show($id)
    {
        if(!$this->iliskilimi($id))
        {
            return redirect(route('home'))->with('error','Bu sayfaya yetkiniz yok !');
        }

        $gorev=GorevModel::find($id);
        $user=User::all();
        $onem=App\OnemModel::all();
        $durum=App\DurumModel::all();

        $yorum = YorumModel::where('gorev_id','=',$id)
            ->join('users', 'yorum_models.user_id', '=', 'users.id')
            ->select('yorum_models.*', 'users.name as user_name')
            ->orderBy('id', 'DESC')
            ->get();




        return view ('gorevler.detay',compact('gorev','user','onem','durum','yorum'));


    }



    public function yorumDurum($gorev_id,$user_id,$durum_id)
    {
        $durum=DurumModel::find($durum_id)->name;
        $yorum=new App\YorumModel();
        $yorum->gorev_id=$gorev_id;
        $yorum->user_id=$user_id;
        $yorum->yorum="Durum De??i??ikli??i    :".$durum;
        $saved=$yorum->save();

        if(!$saved){
            return redirect(route('gorev.edit',$gorev_id))->with('error','Yorum Eklenemedi');
        }
        else
        {

            $yorum_user=App\User::find($user_id)->name;
            $diger_user="";
            $diger_mail="";
            if($yorum->user_id==GorevModel::find($gorev_id)->sahip_id)
            {
                $diger_user=GorevModel::find($gorev_id)->atananFunc->name;
                $diger_mail=GorevModel::find($gorev_id)->atananFunc->email;
                $diger_userid=GorevModel::find($gorev_id)->atananFunc->id;
            }
            elseif ($yorum->user_id==GorevModel::find($gorev_id)->atanan_id)
            {
                $diger_user=GorevModel::find($gorev_id)->sahipFunc->name;
                $diger_mail=GorevModel::find($gorev_id)->sahipFunc->email;
                $diger_userid=GorevModel::find($gorev_id)->sahipFunc->id;

            }


            if(App\User::find($diger_userid)->mail_bild==1) {
                //mail gonderme

            $data = array
            (
                'yorum_user'=>$yorum_user,
                'diger_user'=>$diger_user,
                'gorev_baslik'=>GorevModel::find($gorev_id)->baslik,
                'durum'=>$durum,
                'diger_mail'=>$diger_mail,
            );

            Mail::send('mail/durum_yorum', $data, function ($message) use ($data) {
                $message->subject ('G??rev ????in Yorum Var!');
                $message->from ('info@cmsyazilim.net', '???? Takip Program??');
                $message->to($data['diger_mail'], $data['diger_user']);
            });


                $bildirim=new App\BildirimModel();
                $bildirim->user_id=$diger_userid;
                $bildirim->gorev_id=$gorev_id;
                if($durum_id==1)
                {
                    $bildirim->bildirim_turu=3;
                }
                elseif ($durum_id==2)
                {
                    $bildirim->bildirim_turu=4;
                }

                elseif ($durum_id==3)
                {
                    $bildirim->bildirim_turu=5;
                }

                elseif ($durum_id==4)
                {
                    $bildirim->bildirim_turu=6;
                }
                $bildirim->save();

            }
            return true;
        }

    }



    public function update(Request $request, $id)
    {
        // durumda de??i??iklik varsa yoruma ekle ve mail at



        $gorev=GorevModel::find($id);
        $gorev->baslik=$request->baslik;
        $gorev->icerik=$request->icerik;
        $gorev->atanan_id=$request->atanan_id;
        $gorev->onem_id=$request->onem_id;
        $gorev->bas_zaman=$request->bas_zaman;
        $gorev->bitis_zaman=$request->bitis_zaman;


        if($gorev->durum!=$request->durum)
        {
            $this->yorumDurum($id,Auth::user()->id,$request->durum);

        }



        $gorev->durum=$request->durum;
        $saved=$gorev->save();
        if(!$saved){
            return redirect(route('gorev.edit',$id))->with('error','G??rev D??zenlenemedi');
        }
        else
        {
            return redirect(route('gorev.edit',$id))->with('success','G??rev Ba??ar??yla D??zenlendi');
        }

    }


    public function updateDurum(Request $request, $id)
    {
        // durumda de??i??iklik varsa yoruma ekle ve mail at



        $gorev=GorevModel::find($id);
        if($gorev->durum!=$request->durum)
        {
            $this->yorumDurum($id,Auth::user()->id,$request->durum);

        }



        $gorev->durum=$request->durum;
        $saved=$gorev->save();
        if(!$saved){
            return redirect(route('gorev.detay',$id))->with('error','G??rev D??zenlenemedi');
        }
        else
        {
            return redirect(route('gorev.detay',$id))->with('success','G??rev Ba??ar??yla D??zenlendi');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function arsiveEkle($id)
    {
        $update=GorevModel::find($id)->update(['durum' => 5]);

        if(!$update){
            return redirect(route('gorev.tamamlanan'))->with('error','G??rev Ar??ive Eklenemedi');
        }
        else
        {
            return redirect(route('gorev.tamamlanan'))->with('success','G??rev Ar??ive Eklendi');
        }


    }

    public function bildirimOkundu()
    {
        App\BildirimModel::where('user_id',Auth::user()->id)
                            ->update(['okundu' => 1]);

    }

    public function destroy($id)
    {
        $gorev=GorevModel::find($id);
        $deleted=$gorev->delete();
        App\BildirimModel::where('gorev_id',$id)
                                    ->where('user_id',Auth::user()->id)
                                    ->delete();


        if(!$deleted){
            return redirect(route('gorev.tamamlanan'))->with('error','G??rev Silinemedi');
        }
        else
        {
            return redirect(route('gorev.tamamlanan'))->with('success','G??rev Silindi');
        }


    }

    public function smsgonder($message,$phones)
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


}
