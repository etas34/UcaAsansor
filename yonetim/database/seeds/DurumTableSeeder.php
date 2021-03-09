<?php

use Illuminate\Database\Seeder;

class DurumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('durum_models')->insert([
            ['name' => "Açık"],['name' => "İşleme Alındı"],['name' => "Beklemede"],['name' => "Tamamlandı"]]);
    }
}
