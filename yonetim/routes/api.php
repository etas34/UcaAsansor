<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/asansor/{id1}/{id2}', function ($id1, $id2) {
    $foto = "";
    $ariza_parca = "";
    $bakim_parca = "";
    $kimlik = $id1 . '/' . $id2;
    $asansor = \App\AsansorModel::where('kimlik', $kimlik)
        ->first();

    if ($asansor) {
        $bakim = \App\BakimModel::where('asansor_id', $asansor->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($bakim->isNotEmpty())
        {
            foreach ($bakim as $key => $value)
            {
                $value["bakimci"] = \App\User::find($value->user_id)
                    ->name;
                $value["tarih"] = date_format($value->created_at, 'd/m/Y H:i');
                $value['bakim_parca'] =  $bakim_parca = \App\ParcaModel::where('bakim_id', $value->id)
                    ->get();
            }
            $foto = \App\BakimModel::where('asansor_id', $asansor->id)
                    ->orderBy('created_at', 'DESC')
                    ->first()
                    ->images ?? '';
        }
        $ariza = \App\ArizaModel::where('asansor_id', $asansor->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($ariza->isNotEmpty())
        {
            foreach ($ariza as $key => $value)
            {
                $value["ariza_gideren"] = \App\User::find($value->user_id)
                    ->name;
                $value["tarih"] = date_format($value->created_at, 'd/m/Y H:i');
                $value['ariza_parca'] =  $ariza_parca = \App\ParcaModel::where('ariza_id', $value->id)
                    ->get();
            }
        }

        $asansor['bolge'] = \App\BolgeModel::find($asansor->bolge_id)->ad ?? '';
        return response()->json([
            'code' => 200,
            'asansor' => $asansor,
            'bakim' => $bakim,
            'ariza' => $ariza,
            'foto' => $foto,

        ], 200);
    }

    return response()->json([404 => 'Kayıt Bulunamadı, Bunun İçin Üzgünüm'], 404);

})->name('asansor');
