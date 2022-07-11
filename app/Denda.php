<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    //
    protected $table = 'denda';

    protected $guarded = [];

    public function transaksi(){

        return $this->belongsTo(Transaksi::class);
    }
}
