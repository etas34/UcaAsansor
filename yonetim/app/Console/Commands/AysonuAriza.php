<?php

namespace App\Console\Commands;

use App\ArizaModel;
use App\AsansorModel;
use App\User;
use Carbon\Carbon;
use Config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;

class AysonuAriza extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:aySonuAriza';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ay sonu Gece ve Haftasonu Arızalarını raporlar';

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

        $start = new Carbon('first day of last month');
        $start->startOfMonth();
        $end = new Carbon('last day of last month');
        $end->endOfMonth();

        $arizalar=ArizaModel::where('durum','=',2)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->where(function($query) {
                $query->WHERETIME('created_at','>','18:30:00' )
                    ->orwhereRaw('WEEKDAY(ariza_models.created_at) = 6');
            })
            ->orderBy('user_id')

            ->get();

        // telegram

        $text ="<b>Geçen Ay, Gece veya Haftasonu Arızaya Gidenler</b>\n"
            ."--------------------------------\n";

        foreach ($arizalar as $value)
        {
            $text .="- ".User::find($value['user_id'])->name." : ".AsansorModel::find($value['asansor_id'])->apartman."-".AsansorModel::find($value['asansor_id'])->blok." (".$value['updated_at'].")\n";

        }


        Telegram::sendMessage([
            'chat_id' => Config::get('chat_id.ariza'),
            'parse_mode' => 'HTML',
            'text' => $text,
        ]);
    }
}
