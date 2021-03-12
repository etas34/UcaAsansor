<?php

namespace App\Http\Controllers;

use App\AsansorModel;
use App\BolgeModel;
use Illuminate\Http\Request;

class BolgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bolge = BolgeModel::where('durum','=',1)
            ->orderBy('ad','asc')
        ->get();
        return view('bolge.index',compact('bolge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bolge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bolge = new BolgeModel();
        $bolge->ad = $request->name;
        $saved = $bolge->save();

        if ($saved)
            return redirect(route('bolge.index'))->with('success', 'Bolge Kaydı Başarı İle Oluşturuldu');
        else
            return redirect(route('bolge.index'))->with('error', 'Birşeyler Ters Gitti.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BolgeModel  $bolge
     * @return \Illuminate\Http\Response
     */
    public function show(BolgeModel $bolge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BolgeModel  $bolge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bolge = BolgeModel::find($id);
        return view('bolge.edit',compact('bolge'));
    }
    /**
     * Update the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BolgeModel  $bolge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $bolge = BolgeModel::find($id);
        $bolge->ad = $request->name;
        $saved = $bolge->save();

        if ($saved)
            return redirect(route('bolge.index'))->with('success', 'Bolge Kaydı Başarı İle Düzenlendi');
        else
            return redirect(route('bolge.index'))->with('error', 'Birşeyler Ters Gitti.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BolgeModel  $bolge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asansor = AsansorModel::where('bolge_id','=',$id)
            ->get();
        foreach ($asansor as $key=>$value){
            $value->bolge_id = null;
            $value->save();
        }


        $bolge = BolgeModel::find($id);
        $saved = $bolge->delete();
//        $saved = $bolge->save();

        if ($saved)
            return redirect(route('bolge.index'))->with('success', 'Bolge Kayıtı Başarı İle Silindi');
        else
            return redirect(route('bolge.index'))->with('error', 'Birşeyler Ters Gitti.');
    }
}
