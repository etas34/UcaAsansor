<?php

namespace App\Console\Commands;

use App\ArizaModel;
use App\AsansorModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;

class ArizaGeciken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:ArizaGeciken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arıza Geciken';

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

        $ariza_geciken=ArizaModel::where('created_at', '<=', Carbon::now()->subMinutes(60))
            ->where('durum','=',1)
            ->where('buyuk_ariza',null)
            ->get();

        $text ="<b>‼️ Dikkat Geciken Arıza </b>\n"
            ." (1 Saat Üzeri) \n"
            ."--------------------------------\n"
            . "Arıza Kaydı Açık Olanlar: ".$ariza->count()."\n"
            . "Geciken Arızalar: ".$ariza_geciken->count()."\n"
            ."--------------------------------\n";
        $text .="<b>Gecikme Süreleri</b>\n";

        foreach ($ariza_geciken as $value)
        {
            $text .="- ".AsansorModel::find($value['asansor_id'])->apartman." : ".Carbon::createFromTimeStamp(strtotime($value->created_at))->diffForHumans(null, true)."\n";

        }




        if ($ariza_geciken->count()>0)
        {
            Telegram::sendMessage([
                'chat_id' => Config::get('chat_id.ariza'),
                'parse_mode' => 'HTML',
                'text' => $text,
            ]);

        }
    }
}
