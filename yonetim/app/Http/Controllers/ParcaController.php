<?php

namespace App\Http\Controllers;

use App\AsansorModel;
use App\Exports\ParcaExport;
use App\ParcaModel;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ParcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $asansor=AsansorModel::where('durum','=',1)->get();

        return view('parca.index',compact('asansor'));
    }


    public function gecmis()
    {
        $parca=ParcaModel::where('durum','=',1)
                ->orderBy('tarih','desc')->get();

        return view('parca.gecmis',compact('parca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $asansor=AsansorModel::find($id);

        return view('parca.create',compact('asansor'));
    }


    public function store($id,Request $request)
    {
        foreach ($request->parca as $key=>$value)
        {

            $parca=new ParcaModel();
            $parca->asansor_id=$id;
            $parca->parca=$value['ad'];
            $parca->miktar=$value['miktar'];
            $parca->birim=$value['birim'];
            $parca->tarih=$request->tarih;
            $parca->sekil=$request->sekil;
            $parca->user_id = \Auth::user()->id;
            $saved=$parca->save();



        }


        if($saved ){
            return redirect(route('parca.gecmis'))->with('success','Parça Eklendi');
        }
        else
        {

            return redirect(route('parca.gecmis'))->with('error','Parça Eklenemedi');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export()
    {

        return Excel::download(new ParcaExport(), 'parca_degisim.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $parca=ParcaModel::find($id);
        $user= \App\User::where('durum','=',1)->get();

        return view('parca.edit',compact('parca','user'));
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

        $parca=ParcaModel::find($id);
        $parca->tarih=$request->tarih;
        $parca->parca=$request->parca;
        $parca->miktar=$request->miktar;
        $parca->birim=$request->birim;
        $parca->sekil=$request->sekil;
        $parca->user_id=$request->user_id;
        $parca->fatura_no=$request->fatura_no;
        $saved=$parca->save();

        if($saved ){
            return redirect(route('parca.gecmis'))->with('success','Parça Düzenlendi');
        }
        else
        {

            return redirect(route('parca.gecmis'))->with('error','Parça Düzenlenemedi');
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
        $update=ParcaModel::find($id)->update(['durum' => 0]);

        if(!$update){
            return redirect(route('parca.gecmis'))->with('error','Parça Silinemedi');
        }
        else
        {

            return redirect(route('parca.gecmis'))->with('success','Parça Silindi');
        }
    }
}
