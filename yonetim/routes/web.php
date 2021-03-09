<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\GorevModel;
use App\YorumModel;
use Telegram\Bot\Laravel\Facades\Telegram;

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('defaults');

Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('/', 'MainController@index')->name('main')->middleware('defaults');

Route::post('/login_man', 'Auth\LoginController@authenticate')->name('login_manuel');


Route::group(['prefix'=>'gorevler','as'=>'gorev.','middleware'=>'defaults'],function (){//middleware yönlendirme işlemi yapar
    Route::post('/create', 'GorevController@store')->name('store');
    Route::get('/create', 'GorevController@create')->name('create');
    Route::get('/tamamlanan', 'GorevController@tamamlanan')->name('tamamlanan');
    Route::get('/arsiv', 'GorevController@arsiv')->name('arsiv');
    Route::get('/bildirimler', 'GorevController@bildirimler')->name('bildirimler');
    Route::get('/{id}', 'GorevController@index')->name('index');
    Route::post('/', 'GorevController@bildirimOkundu')->name('bildirimokundu');
    Route::get('/show/{id}', 'GorevController@show')->name('detay');
    Route::get('/edit/{id}', 'GorevController@edit')->name('edit');
    Route::post('/update/{id}', 'GorevController@update')->name('update');
    Route::post('/update_durum/{id}', 'GorevController@updateDurum')->name('durum_update');
    Route::delete('/delete/{id}', 'GorevController@destroy')->name('delete');
    Route::post('/arsiv/{id}', 'GorevController@arsiveEkle')->name('arsiv_ekle');
    Route::post('/yorum/{id}', 'GorevController@createYorum')->name('yorum_create');
});


Route::group(['prefix'=>'ayarlar','as'=>'ayarlar.','middleware'=>'defaults'],function (){
    Route::get('/', 'AyarlarController@index')->name('index');
    Route::post('/update/{id}', 'AyarlarController@update')->name('update');
});


Route::group(['prefix'=>'takvim','as'=>'takvim.','middleware'=>'defaults'],function (){
    Route::get('/', 'TakvimController@index')->name('index');
    Route::post('/create', 'TakvimController@create')->name('create');
    Route::get('/events', 'TakvimController@events')->name('events');
    Route::post('/delete/{id}', 'TakvimController@destroy')->name('delete');
});

//cache temizleme
Route::get('/reset', function(){
    Artisan::call('config:cache');
    Artisan::call('config:clear');

    Artisan::call('cache:clear');

});

Route::get('/deny', function () {
    return view('deny');
})->middleware('defaults');


Route::get('/deneme', 'ArizaController@deneme');

Route::post('/42yUojv1YQPOssPEpn5i3q6vjdhh7hl7djVW/webhook', function () {
    $update = Telegram::commandsHandler(true);

    if ($update->isType('deneme')) {
//        $query = $update->getCallbackQuery();
//        $data  = $query->getData();
//        $start = strpos($data, ' ');
//
//        $command = ($start !== false) ? substr($data, 1, $start - 1) : substr($data, 1);
//
//        if (in_array($command, $commands)) {
//            $update->put('message', collect([
//                'text' => substr($data, $start + 1),
//                'from' => $query->getMessage()->getFrom(),
//                'chat' => $query->getMessage()->getChat()
//            ]));
//            Telegram::triggerCommand($command, $update);
//        }

        $text='deneme';
        Telegram::sendMessage([
            'chat_id' => Config::get('chat_id.bakim'),
            'parse_mode' => 'HTML',
            'text' => $text,
        ]);

    }

});

Route::group(['prefix'=>'asansor','as'=>'asansor.','middleware'=>'defaults'],function (){
    Route::get('/pasifler', 'AsansorController@pasifler')->name('pasifler');
    Route::get('/create', 'AsansorController@create')->name('create')->middleware('yetki:1');
    Route::post('/create', 'AsansorController@store')->name('store')->middleware('yetki:1');
    Route::get('/{id}', 'AsansorController@index')->name('index');
    Route::get('/export/{id}', 'AsansorController@export')->name('export');
    Route::get('/edit/{id}', 'AsansorController@edit')->name('edit');
    Route::get('/show/{id}', 'AsansorController@show')->name('detay');
    Route::post('/update/{id}', 'AsansorController@update')->name('update')->middleware('yetki:1');
    Route::post('/aktif/{id}', 'AsansorController@aktifeAl')->name('aktifeAl')->middleware('yetki:1');
    Route::post('/pasif/{id}', 'AsansorController@pasifeAl')->name('pasifeAl')->middleware('yetki:1');
    Route::delete('/delete/{id}', 'AsansorController@destroy')->name('delete')->middleware('yetki:1');
});


Route::group(['prefix'=>'parca','as'=>'parca.','middleware'=>'defaults'],function (){
    Route::get('/', 'ParcaController@index')->name('index');
    Route::get('/parcaExport', 'ParcaController@export')->name('export');
    Route::get('/parca-gecmis', 'ParcaController@gecmis')->name('gecmis');
    Route::get('/create/{id}', 'ParcaController@create')->name('create');
    Route::post('/create/{id}', 'ParcaController@store')->name('store');
    Route::get('/edit/{id}', 'ParcaController@edit')->name('edit');
    Route::get('/show/{id}', 'ParcaController@show')->name('detay');
    Route::post('/update/{id}', 'ParcaController@update')->name('update');
    Route::delete('/delete/{id}', 'ParcaController@destroy')->name('delete')->middleware('yetki:7');
});

Route::group(['prefix'=>'bakim','as'=>'bakim.','middleware'=>'defaults'],function (){
    Route::get('/bakimyap', 'BakimController@bakimYap')->name('bakimYap');
    Route::get('/export', 'BakimController@export')->name('export');
    Route::get('/bakimlar/{id}', 'BakimController@bakimlar')->name('bakimlar');
    Route::get('/{id}', 'BakimController@index')->name('index');
    Route::get('/bakimci-asansor/{user}', 'BakimController@bakimci_asansor')->name('bakimci_asansor');
    Route::get('/create/{id}', 'BakimController@create')->name('create')->middleware('yetki:3');
    Route::get('/edit/{id}', 'BakimController@edit')->name('edit');
    Route::get('/show/{id}', 'BakimController@show')->name('detay');
    Route::post('/bakimci-ata', 'BakimController@bakimci_ata')->name('bakimci_ata')->middleware('yetki:8');
    Route::post('/create/{id}', 'BakimController@store')->name('store')->middleware('yetki:3');
    Route::post('/update/{id}', 'BakimController@update')->name('update')->middleware('yetki:1');
    Route::delete('/delete/{id}', 'BakimController@destroy')->name('delete')->middleware('yetki:1');
});
Route::group(['prefix'=>'revizyon','as'=>'revizyon.','middleware'=>'defaults'],function (){
    Route::get('/', 'RevizyonController@index')->name('index');
    Route::get('/revizyonyap', 'RevizyonController@revizyonYap')->name('revizyonYap');
    Route::get('/revizyongereken', 'RevizyonController@revizyonGereken')->name('revizyonGereken');
    Route::get('/revizyonGecmis', 'RevizyonController@revizyonGecmis')->name('revizyonGecmis');
    Route::get('/revizyonlar', 'RevizyonController@revizyonlar')->name('revizyonlar');
    Route::get('/sozlesme', 'RevizyonController@sozlesmeBekleyen')->name('sozlesmeBekleyen');
    Route::get('/teklifGecmis', 'RevizyonController@teklifGecmis')->name('teklifGecmis');
    Route::get('/export', 'RevizyonController@exportGecmis')->name('exportGecmis');
    Route::get('/pdfGetir/{id}', 'RevizyonController@pdfGetir')->name('pdfGetir');
    Route::get('/teklifCreate/{id}', 'RevizyonController@teklifCreate')->name('teklifCreate');
    Route::post('/teklifSend/{id}', 'RevizyonController@teklifSend')->name('teklifSend');
    Route::post('/etiket', 'RevizyonController@etiketDegistir')->name('etiketDegistir')->middleware('yetki:4');
    Route::post('/sozlesme', 'RevizyonController@sozlesmeDegistir')->name('sozlesmeDegistir')->middleware('yetki:4');
    Route::post('/pdf', 'RevizyonController@pdfDegistir')->name('pdfDegistir')->middleware('yetki:4');
    Route::get('/create/{id}', 'RevizyonController@create')->name('create')->middleware('yetki:4');
    Route::post('/create/{id}', 'RevizyonController@store')->name('store')->middleware('yetki:4');
    Route::get('/edit/{id}', 'RevizyonController@edit')->name('edit')->middleware('yetki:4');
    Route::get('/teklifGoster/{id}', 'RevizyonController@teklifGoster')->name('teklifGoster')->middleware('yetki:4');
    Route::get('/teklifEdit/{id}', 'RevizyonController@teklifEdit')->name('teklifEdit')->middleware('yetki:4');
    Route::get('/show/{id}', 'RevizyonController@show')->name('detay')->middleware('yetki:4');
    Route::post('/update/{id}', 'RevizyonController@update')->name('update')->middleware('yetki:4');
    Route::post('/teklifUpdate/{id}', 'RevizyonController@teklifUpdate')->name('teklifUpdate')->middleware('yetki:4');
    Route::delete('/delete/{id}', 'RevizyonController@destroy')->name('delete')->middleware('yetki:4');
    Route::delete('/teklifDelete/{id}', 'RevizyonController@teklifDelete')->name('teklifDelete')->middleware('yetki:4');
});



Route::group(['prefix'=>'belge','as'=>'belge.','middleware'=>'defaults'],function (){
    Route::get('/', 'BelgeController@index')->name('index')->middleware('yetki:7');
    Route::get('/create/', 'BelgeController@create')->name('create')->middleware('yetki:7');
    Route::get('/edit/{id}', 'BelgeController@edit')->name('edit')->middleware('yetki:7');
    Route::post('/create/', 'BelgeController@store')->name('store')->middleware('yetki:7');
    Route::post('/update/{id}', 'BelgeController@update')->name('update')->middleware('yetki:7');
    Route::delete('/delete/{id}', 'BelgeController@destroy')->name('delete')->middleware('yetki:7');
});


Route::group(['prefix'=>'ariza','as'=>'ariza.','middleware'=>'defaults'],function (){
    Route::get('/', 'ArizaController@index')->name('index');
    Route::get('/arizalar', 'ArizaController@arizalar')->name('arizalar');
    Route::get('/gecmis', 'ArizaController@gecmis')->name('gecmis');
    Route::get('/mesailer', 'ArizaController@mesailer')->name('mesailer');
    Route::get('/mesaiExport', 'ArizaController@mesaiExport')->name('mesaiExport');
    Route::get('/gecmisArizalar/{id}', 'ArizaController@gecmisArizalar')->name('gecmisArizalar');
    Route::get('/create/{id}', 'ArizaController@create')->name('create')->middleware('yetki:2');
    Route::post('/create/{id}', 'ArizaController@store')->name('store')->middleware('yetki:2');
    Route::get('/edit/{id}', 'ArizaController@edit')->name('edit');
    Route::get('/gider/{id}', 'ArizaController@gider')->name('gider');
    Route::get('/gecmis/{id}', 'ArizaController@gecmisEdit')->name('gecmisEdit');
    Route::post('/update/{id}', 'ArizaController@update')->name('update')->middleware('yetki:2');
    Route::post('/updateGider/{id}', 'ArizaController@updateGider')->name('updateGider')->middleware('yetki:2');
    Route::post('/gecmisUpdate/{id}', 'ArizaController@gecmisUpdate')->name('gecmisUpdate')->middleware('yetki:2');
    Route::delete('/delete/{id}', 'ArizaController@destroy')->name('delete')->middleware('yetki:2');
});


Route::group(['prefix'=>'user','as'=>'user.','middleware'=>'defaults'],function (){
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create')->middleware('yetki:5');
    Route::post('/create/', 'UserController@store')->name('store')->middleware('yetki:5');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('yetki:5');
    Route::get('/show/{id}', 'UserController@show')->name('detay')->middleware('yetki:5');
    Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('yetki:5');
    Route::delete('/delete/{id}', 'UserController@destroy')->name('delete')->middleware('yetki:5');
});



Route::group(['prefix'=>'sms','as'=>'sms.','middleware'=>'defaults'],function (){
    Route::get('/', 'SMSController@index')->name('index');
    Route::get('/create', 'SMSController@create')->name('create')->middleware('yetki:6');
    Route::post('/create/', 'SMSController@store')->name('store')->middleware('yetki:6');
    Route::get('/toplusms', 'SMSController@toplusms')->name('toplusms')->middleware('yetki:6');
    Route::post('/toplusms/', 'SMSController@toplusms_gonder')->name('toplusms_gonder')->middleware('yetki:6');
    Route::get('/gecmis', 'SMSController@gecmis')->name('gecmis')->middleware('yetki:6');
    Route::get('/edit/{id}', 'SMSController@edit')->name('edit');
    Route::get('/show/{id}', 'SMSController@show')->name('detay');
    Route::post('/update/{id}', 'SMSController@update')->name('update')->middleware('yetki:6');
    Route::delete('/delete/{id}', 'SMSController@destroy')->name('delete')->middleware('yetki:6');

});

Route::group(['prefix'=>'bolge','as'=>'bolge.','middleware'=>'defaults'],function (){
        Route::get('/', 'BolgeController@index')->name('index');
        Route::get('/create', 'BolgeController@create')->name('create');
        Route::get('/edit/{id}', 'BolgeController@edit')->name('edit');
        Route::post('/update/{id}', 'BolgeController@update')->name('update');
        Route::post('/create', 'BolgeController@store')->name('store');
        Route::post('/delete/{id}', 'BolgeController@destroy')->name('delete');

});


/*
 * Muhasebe İçin Routes'ler
 */

Route::group(['prefix'=>'muhasebe','as'=>'muhasebe.','middleware'=>'defaults'],function (){
    Route::get('/home', 'Muhasebe\CariController@home')->name('home');


    Route::group(['prefix'=>'cari','as'=>'cari.','middleware'=>'yetki:8'],function (){
        Route::get('/', 'Muhasebe\CariController@index')->name('index');
        Route::get('/cariasansor', 'Muhasebe\CariController@cariasansor')->name('cariasansor');
        Route::get('/create/', 'Muhasebe\CariController@create')->name('create');
        Route::get('/edit/{id}', 'Muhasebe\CariController@edit')->name('edit');
        Route::post('/delete/{id}', 'Muhasebe\CariController@destroy')->name('delete');
        Route::post('/create/', 'Muhasebe\CariController@store')->name('store');
        Route::post('/update/{id}', 'Muhasebe\CariController@update')->name('update');
        Route::post('/cariasansor', 'Muhasebe\CariController@cariasansorupdate')->name('cariasansorupdate');
    });
    Route::group(['prefix'=>'cariharaket','as'=>'cariharaket.','middleware'=>'yetki:8'],function (){
        Route::get('/', 'Muhasebe\CariharaketController@index')->name('index');
        Route::get('/tarihGecmis', 'Muhasebe\CariharaketController@tarihGecmis')->name('tarihGecmis');
        Route::get('/gecmis/{id}', 'Muhasebe\CariharaketController@gecmis')->name('gecmis');
        Route::get('/tumgecmis', 'Muhasebe\CariharaketController@tumgecmis')->name('tumgecmis');
        Route::get('/create/{id}', 'Muhasebe\CariharaketController@create')->name('create');
        Route::get('/edit/{id}', 'Muhasebe\CariharaketController@edit')->name('edit');
        Route::post('/delete/{id}', 'Muhasebe\CariharaketController@destroy')->name('delete');
        Route::post('/sozlesmeDegistir', 'Muhasebe\CariharaketController@sozlesmeDegistir')->name('sozlesmeDegistir');
        Route::post('/create/{id}', 'Muhasebe\CariharaketController@store')->name('store');
        Route::post('/update/{id}', 'Muhasebe\CariharaketController@update')->name('update');
    });
    Route::group(['prefix'=>'fatura','as'=>'fatura.','middleware'=>'yetki:8'],function (){
        Route::get('/', 'Muhasebe\FaturaController@index')->name('index');
        Route::get('/gecmis/{id}', 'Muhasebe\FaturaController@gecmis')->name('gecmis');
        Route::get('/tumgecmis', 'Muhasebe\FaturaController@tumgecmis')->name('tumgecmis');
        Route::get('/faturabakim', 'Muhasebe\FaturaController@faturabakim')->name('faturabakim');
        Route::get('/faturaparca', 'Muhasebe\FaturaController@faturaparca')->name('faturaParca');
        Route::get('/create/{id}', 'Muhasebe\FaturaController@create')->name('create');
        Route::get('/edit/{id}', 'Muhasebe\FaturaController@edit')->name('edit');
        Route::get('/faturaPrint/{id}', 'Muhasebe\FaturaController@faturaPrint')->name('faturaPrint');
        Route::post('/delete/{id}', 'Muhasebe\FaturaController@destroy')->name('delete');
        Route::post('/create/{id}', 'Muhasebe\FaturaController@store')->name('store');
        Route::post('/update/{id}', 'Muhasebe\FaturaController@update')->name('update');
    });

});
