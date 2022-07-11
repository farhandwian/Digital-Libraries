<?php

namespace App\Exports;

use App\Buku;
use App\Biblio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuExport implements FromCollection,WithHeadings
{
    public function headings():array{

        return [
            'No',
            'Judul',
            'ISBN',
            'Penulis',
            'Penerbit',
            'Tahun',
            'Jumlah Buku',
            'Deskripsi',
            'Lokasi',
            'gambar',
            'Created_at',
            'Updated_at'
        ];
    }
    public function collection()
    {
        return Biblio::all();
    }


}
