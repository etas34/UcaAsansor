<?php

namespace App\Console\Commands;

use App\AsansorModel;
use App\BakimModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;

class gunSonuBakim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:gunSonuBakim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gün sonu bakımları raporlar';

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
        $bakim_olmayan_aylik=AsansorModel::where('durum','=',1)
            ->where('etiket','!=','Kırmızı')
            ->whereDate('aylik_bakim', '<', Carbon::now()->firstOfMonth())->get();


        $bakim_gunluk=BakimModel::whereDate('created_at', '>=', Carbon::now())->where('durum',1)->get();

        $bakim_gunluk_user=BakimModel::whereDate('created_at', '>=', Carbon::now())
             ->where('durum',1)
            ->select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();


        $atanmıs_bakim_olmayanlar=AsansorModel::where('durum','=',1)
            ->where('etiket','!=','Kırmızı')
            ->whereDate('aylik_bakim', '<', Carbon::now()->firstOfMonth())
            ->whereDate('bu_ay_bakim_tarih', '<=', Carbon::now())
            ->orderBy('bakimci_id')
            ->get();

        $text ="<b>Gün Sonu Bakım Raporu</b>\n"
            ."--------------------------------\n"
            . "Bu Ay Bakım Yapılmayan: ".$bakim_olmayan_aylik->count()."\n"
            . "Bugün Bakım Yapılan: ".$bakim_gunluk->count()."\n"
            ."--------------------------------\n";
        $text .="<b>Bugün Bakım Yapanlar</b>\n";

        foreach ($bakim_gunluk_user as $value)
        {
            $text .="- ".User::find($value['user_id'])->name." : ".$value['total']." Adet\n";

        }

        $text .="--------------------------------\n";
        $text .="<b>Atanmış Fakat Bakım Yapılamamış Asansörler</b>\n";

        foreach ($atanmıs_bakim_olmayanlar as $value)
        {
            $text .=User::find($value['bakimci_id'])->name." : ".$value['apartman']."-".$value['blok']."\n";

        }



        Telegram::sendMessage([
            'chat_id' => Config::get('chat_id.ariza'),
            'parse_mode' => 'HTML',
            'text' => $text,
        ]);
    }
}
