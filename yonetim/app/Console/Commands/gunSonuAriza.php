<?php

namespace App\Console\Commands;

use App\ArizaModel;
use App\AsansorModel;
use App\BakimModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;

class gunSonuAriza extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:gunSonuAriza';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gün sonu Arızaları raporlar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $ariza=ArizaModel::where('durum','=',1)->get();

        $ariza_bugun=ArizaModel::whereDate('created_at', '>=', Carbon::now())->get();

        $ariza_gecmis=ArizaModel::whereDate('created_at', '>=', Carbon::now())
                                ->where('durum','=',2)->get();

        $ariza_gunluk_user=ArizaModel::whereDate('created_at', '>=', Carbon::now())
            ->where('durum','=',2)
            ->select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();

        $text ="<b>Gün Sonu Arıza Raporu</b>\n"
            ."--------------------------------\n"
            . "Arıza Kaydı Açık Olanlar: ".$ariza->count()."\n"
            . "Bugün Arıza Çıkan: ".$ariza_bugun->count()."\n"
            . "Bugün Arıza Giderilen: ".$ariza_gecmis->count()."\n"
            ."--------------------------------\n";
        $text .="<b>Bugün Arıza Giderenler</b>\n";

        foreach ($ariza_gunluk_user as $value)
        {
            $text .="- ".User::find($value['user_id'])->name." : ".$value['total']." Adet\n";

        }





        Telegram::sendMessage([
            'chat_id' => Config::get('chat_id.ariza'),
            'parse_mode' => 'HTML',
            'text' => $text,
        ]);
    }
}
