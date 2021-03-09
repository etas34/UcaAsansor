<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => "Eyüp Taş",
            'email' => 'etas3@msn.com',
            'password' => bcrypt('1'),
                'yetki'=>'1,2,3,4,5'],
            ['name' => "Süleyman Çiftçi",
                'email' => 'eyup.tas@ciftcilerelektrik.com.tr',
                'password' => bcrypt('1'),
                'yetki'=>'1,2,3,4,5']
        ]);
    }
}
