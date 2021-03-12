<?php

namespace App\Http\Controllers;

use App\AsansorModel;
use App\smsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $asansor=AsansorModel::all();


        return view('sms.index',compact('asansor'));
    }


    public function create()
    {
        return view('sms.create');
    }


    public function toplusms()
    {
        return view('sms.toplu');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phone=$request->phone;
        $phone='90'.str_replace(str_split('()-\ '), '', $phone);
        $mesaj=$request->mesaj;
        $path="";



        $url = URL::to('/storage/app/pdf');

        if($request->hasFile('pdf'))
        {
            $file=$request->file('pdf');

            $filename="smsPDF_".Carbon::now()->timestamp.".".$file->getClientOriginalExtension();

            $path=$file->storeAs('pdf',$filename);

            $mesaj.=" ".$url."/".$filename;

        }



        $sonuc=$this->smsgonder($mesaj,$phone);


        if($sonuc)
        {
            $sms=new smsModel();
            $sms->phone=$phone;
            $sms->mesaj=$mesaj;
            $sms->pdf=$path;
            $sms->save();

            return redirect(route('sms.gecmis'))->with('success','Mesaj Gönderildi');
        }
        else
        {

            return redirect(route('sms.create'))->with('error','Mesaj Gönderilemedi');
        }



    }


    public function toplusms_gonder(Request $request)
    {
        $phones=array();
        $asansor=AsansorModel::where('durum','=', 1)
           ->select('yonetici_tel')->distinct()->get();

        foreach ($asansor as $value)
        {
            $phone=$value->yonetici_tel;
            $phone='90'.str_replace(str_split('()-\ '), '', $phone);
            $phones[]=$phone;

        }


        $mesaj=$request->mesaj;
        $sonuc=$this->smsgonder($mesaj,$phones);

        if($sonuc)
        {
            $sms=new smsModel();
            $sms->phone='Tüm Yöneticilere';
            $sms->mesaj=$mesaj;
            $sms->save();

        }

        return redirect(route('sms.gecmis'))->with('success','Mesaj Gönderildi');



    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gecmis()
    {
        $sms=smsModel::orderBy('created_at','desc')->get();


        return view('sms.gecmis',compact('sms'));

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function smsgonder($message,$phones)
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

    static function sendRequest($site_name,$send_xml,$header_type) {

        //die('SITENAME:'.$site_name.'SEND XML:'.$send_xml.'HEADER TYPE '.var_export($header_type,true));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$site_name);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        $result = curl_exec($ch);

        return $result;
    }
}
