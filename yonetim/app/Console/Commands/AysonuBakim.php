<?php

namespace App\Console\Commands;

use App\ArizaModel;
use App\AsansorModel;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class AysonuBakim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjob:aySonuBakim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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



        DB::table('asansor_models')->update(['bu_ay_bakim_tarih' => null]);


    }
}
