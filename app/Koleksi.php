<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    //
    protected $table = 'koleksi';

    protected $guarded = [];

    public function biblio(){

        return $this->belongsTo(Biblio::class);
    }

    public function transaksi(){

        return $this->hasOne(Transaksi::class);
    }
}