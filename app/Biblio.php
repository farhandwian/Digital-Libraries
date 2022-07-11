<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biblio extends Model
{
    protected $table = 'biblio';

    protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')->orWhere('isbn', 'like', '%' . $search . '%')->orWhere('penulis', 'like', '%' . $search . '%')->orWhere('penerbit', 'like', '%' . $search . '%')->orWhere('tahun_terbit', 'like', '%' . $search . '%')->orWhere('tipe_koleksi', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['type'] ?? false, function($query, $type) {
            return $query->where(function($query) use ($type) {
                $query->where('tipe_koleksi', $type);
            });
        });
    }

    public function Koleksi(){

        return $this->hasMany(Koleksi::class);
    }

    public function review(){

        return $this->hasMany(Review::class);
    }
}