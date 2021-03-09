<?php

namespace App\Console\Commands;

use App\ArizaModel;
use App\AsansorModel;
use App\RevizyonModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Telegram\Bot\Laravel\Facades\Telegram;

class gunSonuEtiket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:gunSonuEtiket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gün sonu Değişen Etiketleri Gösterir';

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

        $etiket=AsansorModel::where('durum','=',1)
            ->whereDate('etiket_deg_tarihi', '>=', Carbon::now())->get();

        $revizyon=RevizyonModel::where('durum','=',2)
            ->whereDate('tarih','>=',Carbon::now())->get();

        $text ="<b>Gün Sonu Revizyon Raporu</b>\n"
            ."--------------------------------\n"
            . "Bugün Etiket Değişenler: ".$etiket->count()."\n"
            . "Bugün Revizyon Yapılan Asansörler: ".$revizyon->count()."\n\n";
            if ($etiket->count()>0)
            {
                $text .="<b>Etiket Değişen Asansörler</b>\n"
                    ."--------------------------------\n";
                foreach ($etiket as $value)
                {
                    $text .="- ".$value['apartman']." ".$value['blok']." : <b>".$value['etiket']."</b>\n";

                }
            }
        if ($revizyon->count()>0)
        {
            $text .="\n<b>Revizyon Yapılan Asansörler</b>\n"
                ."--------------------------------\n";
            foreach ($revizyon as $value)
            {
                $text .="- ".AsansorModel::find($value['asansor_id'])->apartman." ".AsansorModel::find($value['asansor_id'])->blok." : <b>".User::find($value['user_id'])->name."</b>\n";

            }
        }


        if ($etiket->count()>0 || $revizyon->count()>0  )
        {
            Telegram::sendMessage([
                'chat_id' => Config::get('chat_id.ariza'),
                'parse_mode' => 'HTML',
                'text' => $text,
            ]);

        }


    }
}
