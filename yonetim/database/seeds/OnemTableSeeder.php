<?php

use Illuminate\Database\Seeder;

class OnemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('onem_models')->insert([
            ['name' => "Normal"],['name' => "Önemli"],['name' => "Çok Önemli"]]);
    }
}
