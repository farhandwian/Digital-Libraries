<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;
    
    protected $table = 'transaksi';

    protected $guarded = []; 

    public function anggota(){

        return $this->belongsTo(Anggota::class);
    }

    public function buku(){

        return $this->belongsTo(Buku::class);
    }

    public function koleksi(){

        return $this->belongsTo(koleksi::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function denda(){
        return $this->hasMany(Denda::class);
    }
}
