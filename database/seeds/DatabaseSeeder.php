<?php

use Illuminate\Database\Seeder;
use App\Biblio;
use App\Koleksi;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AnggotaSeeder::class);
        // $this->call(BiblioSeeder::class);
        // $this->call(KoleksiSeeder::class);
        factory(Biblio::class,5)->create();
        factory(Koleksi::class,5)->create();
    }
}
