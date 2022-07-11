<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'review';

    protected $guarded = [];

    public function biblio(){

        return $this->belongsTo(Biblio::class);
    }

    public function anggota(){

        return $this->belongsTo(Anggota::class);
    }
}
