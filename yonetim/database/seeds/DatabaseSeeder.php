<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(OnemTableSeeder::class);
        $this->call(DurumTableSeeder::class);
        $this->call(YetkiTableSeeder::class);
        $this->call(BildirimTursSeeder::class);

    }
}
