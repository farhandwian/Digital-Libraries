<?php

use App\Biblio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BiblioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Biblio::class,10)->create();
    }
}