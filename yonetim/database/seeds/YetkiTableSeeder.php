<?php

use Illuminate\Database\Seeder;

class YetkiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('yetki_models')->insert([
            ['name' => "Asansör Ekle-Sil İşlemleri"],['name' => "Arıza İşlermleri"],['name' => "Bakım İşlermleri"],['name' => "Revizyon İşlermleri"],['name' => "Kullanıcı İşlermleri"]]);
    }
}
