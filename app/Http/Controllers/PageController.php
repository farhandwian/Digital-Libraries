<?php

namespace App\Http\Controllers;

// use App\Models\Order;
// use App\Models\Review;
// use App\Models\biblio;
use App\Biblio;
use App\Koleksi;
use App\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index() {
        return view('customer.index', [
            'title' => 'Home',
            'buku' =>Biblio::orderBy("total_dipinjam",'desc')->take(10)->get(),
            'bukus' =>Biblio::orderBy("updated_at",'desc')->take(10)->get()
        ]);
    }

    public function search() {
        if (request('sort') == 'rekomendasi') {
            $biblio = Biblio::orderBy('total_dipinjam', 'desc');
        }else if (request('sort') == 'buku-terbaru') {
            $biblio = Biblio::orderBy('created_at', 'desc');
        } else if (request('sort') == 'terbit-terbaru') {
            $biblio = Biblio::orderBy('tahun_terbit', 'desc');
        }else {
            $biblio = Biblio::latest();
        }
        return view('customer.search', [
            'title' => 'Cari',
            'buku' => $biblio->filter(request(['search', 'type']))->paginate(5)->withQueryString()
        ]);
    }

    public function show(Biblio $biblio) {
        //cari koleksi
        return view('customer.buku', [
            'title' => 'Detail Buku',
            'buku' => $biblio,
            'bukus' => Biblio::where("tipe_koleksi",$biblio->tipe_koleksi)->take(10)->get(),
            'koleksi' => Koleksi::where([["biblio_id",'=',$biblio->id],["status","=","tersedia"]])->orderByRaw("FIELD(kondisi, \"sangat bagus\", \"bagus\", \"cukup bagus\")")->take(5)->get(),
            'reviews' => Review::where('biblio_id', $biblio->id)->orderBy('rating', 'desc')->get(),
        ]);
    }

}
