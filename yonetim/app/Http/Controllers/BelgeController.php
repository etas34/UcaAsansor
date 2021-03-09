<?php

namespace App\Http\Controllers;

use App\BelgeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use function GuzzleHttp\Promise\all;

class BelgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();

        $belge = BelgeModel::all();

        return view('belge.index',compact(array('belge','now')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('belge.create');

    }


    /**
     * Store a newly Belgeeated resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $belge = new BelgeModel();
        $belge->ad = $request->ad;
        $belge->hatirlatma = $request->hatirlatma;
        $belge->gecerlilik = $request->tarih;
        if(($request->file('images'))) {
            $fileName = time() . '.' . $request->images->extension();
            $request->file('images')->move(public_path('images/'), $fileName);
            $belge->image = url('/public/images') . "/" . $fileName;
        }
        $saved = $belge->save();

        if ($saved)
            return redirect(route('belge.index'))->with('success','Belge Eklendi.');
        else
            return redirect(route('belge.index'))->with('error','Bir Şeyler Ters Gitti.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Belge  $belge
     * @return \Illuminate\Http\Response
     */
    public function show(Belge $belge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Belge  $belge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $belge=BelgeModel::find($id);
        if ($belge->image){
            $path_parts = pathinfo($belge->image);
            $extension = $path_parts['extension'];
            return view('belge.edit', compact(array('belge','extension')));
        }
        return view('belge.edit',compact('belge'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Belge  $belge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $belge=BelgeModel::find($id);
        $belge->ad = $request->ad;
        $belge->hatirlatma = $request->hatirlatma;
        $belge->gecerlilik = $request->tarih;
        if($belge->image){

                $path_parts = pathinfo($belge->image);
                $filename = $path_parts['filename'].".".$path_parts['extension'];

                if(\File::exists(public_path("images/$filename"))){

                    \File::delete(public_path("images/$filename"));

                }else{
                    $saved = $belge->save();

                    if ($saved)
                        return redirect(route('belge.index'))->with('Error','Birşeyler Ters Gitti');

                }


        }


        if(($request->file('images'))){
            $fileName = time().'.'.$request->images->extension();
            $request->file('images')->move(public_path('images/'),$fileName);
            $belge->image =  url('/public/images')."/".$fileName;
        }

        $saved = $belge->save();

        if ($saved)
            return redirect(route('belge.index'))->with('success','Belge Başarı İle Düzenlendi.');
        else
            return redirect(route('belge.index'))->with('error','Birşeyler Ters Gitti.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Belge  $belge
     * @return \Il MongoDB
    Random Articlesluminate\Http\Response
     */
    public function destroy($id)
    {
        $belge=BelgeModel::find($id);
        if ($belge->image){
            $path_parts = pathinfo($belge->image);
            $filename = $path_parts['filename'].".".$path_parts['extension'];

            if(\File::exists(public_path("images/$filename"))){

                \File::delete(public_path("images/$filename"));

            }else{
                $belge->delete();
                return redirect(route('belge.index'))->with('error','Yüklenen dosya bulunamadı ama kayıt silindi');

            }
        }


        $saved = $belge->delete();

        if ($saved)
            return redirect(route('belge.index'))->with('success','Kayıt Başarı Ile Silindi.');
        else
            return redirect(route('belge.index'))->with('error','Birşeyler Ters Gitti.');
    }
}
