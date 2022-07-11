<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Biblio;
use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Biblio::class, function (Faker $faker) {
    return [
        //
        'judul' => $faker->word(),
        'isbn' => Str::random(6),
        'penulis' => $faker->name(),
        'penerbit' => $faker->name(),
        'tahun_terbit' => $faker->numberBetween(2000-2022),
        'jumlah_buku' => mt_rand(1,10),
        'deskripsi' => $faker->paragraph,
    ];
});