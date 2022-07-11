<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Biblio;
use App\Koleksi;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Koleksi::class, function (Faker $faker) {
    $biblio = Biblio::pluck('id')->toArray();
    return [
        'biblio_id'=>$faker->randomElement($biblio),
        'no_reg' => Str::random(6),
        'lokasi' => $faker->word(),
        'status' => $faker->randomElement(['tersedia','dipinjam','hilang']),
    ];
});