<?php

use App\Biblio;
use App\Koleksi;
use Illuminate\Database\Seeder;

class KoleksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Koleksi::class,10)->create();
        //Koleksi::factory(10)->has(Biblio::factory()->count(10))->create();
    }
}