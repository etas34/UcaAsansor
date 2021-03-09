<?php

namespace App\Http\Controllers;

use App\AsansorModel;
use App\smsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $phone=str_replace(str_split('()-'), ' ', $phone);
        $mesaj=$request->mesaj;
        $path="";


        if($request->hasFile('pdf'))
        {
            $file=$request->file('pdf');

            $filename="smsPDF_".Carbon::now()->timestamp.".".$file->getClientOriginalExtension();

            $path=$file->storeAs('pdf',$filename);

            $mesaj.=" https://ciftcilerasansor.com.tr/yonetim/storage/app/pdf/".$filename;

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
        $asansor=AsansorModel::where('durum','=', 1)
           ->select('yonetici_tel')->distinct()->get();

        foreach ($asansor as $value)
        {
            $phone=$value->yonetici_tel;
            $phone=str_replace(str_split('()-'), ' ', $phone);
            $mesaj=$request->mesaj;



            $sonuc=$this->smsgonder($mesaj,$phone);

            if($sonuc)
            {
                $sms=new smsModel();
                $sms->phone=$phone;
                $sms->mesaj=$mesaj;
                $sms->save();

            }

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
        $sms=smsModel::all();


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

    public function smsgonder($message,$number)
    {


        $username   = '5465510345';
        $password   = 'Ciftciler!2019';
        $orgin_name = 'CIFTCILER';
        $date=date('d/m/Y H:i');

        $xml = "		 <request>
   			 <authentication>
   				 <username>{$username}</username>
   				 <password>{$password}</password>
   			 </authentication>

   			 <order>
   	    		 <sender>{$orgin_name}</sender>
   	    		 <sendDateTime>{$date}</sendDateTime>
   	    		 <message>
   	        		 <text>{$message}</text>
   	        		 <receipents>
   	            		 <number>{$number}</number>
   	        		 </receipents>
   	    		 </message>
   			 </order>
   		 </request>";


        $result=self::sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));

        $xml=new \SimpleXMLElement($result);

        if($xml->status->code=='200')
        {
            return true;
        }
        else
        {
            return false;
        }

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
