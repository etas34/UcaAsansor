<?php

use Illuminate\Database\Seeder;

class BildirimTursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bildirim_turs')->insert([
            ['name' => "Yeni Görev Açıldı"],['name' => "Yorum Yapıldı"],['name' => "Açık"],['name' => "İşleme Alındı"],['name' => "Beklemede"],['name' => "Tamamlandı"]]);

    }
}
