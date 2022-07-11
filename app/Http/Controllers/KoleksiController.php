<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Biblio;
use App\Koleksi;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KoleksiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=DB::table('biblio')->select('biblio.judul','koleksi.kode_eksemplar')
        // ->join('koleksi','biblio.id','koleksi.biblio_id')
        // ->where('biblio.penulis','Tere Liye')
        // ->get();
        // echo "<pre>";
        // print_r($data);
        // exit();

      
        // $data=Biblio::crossJoin('koleksi')
        // ->where('penulis','tere liye')
        // ->get();
        //dd($data);
        //$data->where('penulis','tere liye');
        
        // ->select('biblio.judul','koleksi.kode_eksemplar')
        // ->join('koleksi','biblio.id','koleksi.biblio_id')
        // ->where('biblio.penulis','tere liye')
        // ->get();
        // echo "<pre>";
        // print_r($data);
        // exit();
        return view('koleksi.index', [
            'title' => 'Daftar Koleksi',
            'koleksi' => Koleksi::orderBy('updated_at', 'desc')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  Biblio
     * @return \Illuminate\Http\Response
     */
    public function create(Biblio $biblio)
    {

        return view('koleksi.create', [
            'title' => 'Tambah Koleksi',
            'judul' => $biblio->judul,
            'penulis' => $biblio->penulis,
            'biblio_id' => $biblio->id
            // 'buku' => Buku::orderBy('judul','asc')->get(),

        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_reg' => 'required|unique:koleksi',
            'lokasi' => 'required',
            'status' => 'required',
            'kondisi' => 'required',
        ], [
            'required' => 'atribute tidak boleh kosong',
            'unique' => 'atribute sudah terdaftar',
            'max' => 'karakter max 25',
        ]);

        //nambah stok dan jumlah_buku ke biblio
        if ($request->status == 'tersedia') {
            $biblio = Biblio::where('id', $request->biblio_id)->first();
            $biblio->update(['jumlah_buku' => $biblio->jumlah_buku + 1]);
            $biblio->update(['stok' => $biblio->stok + 1]);
        
        }
        // $biblio->save();
        //Biblio::where('id',$request->biblio_id)->update(['jumlah_buku' => $transaksi->koleksi->biblio->jumlah_buku -1]);


        //insert to database buku
        Koleksi::create([
            'biblio_id' => $request->biblio_id,
            'no_reg' => $request->no_reg,
            'lokasi' => $request->lokasi ?? '',
            'status' => $request->status ?? '',
            'kondisi' => $request->kondisi ?? 'bagus',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        //session success 
        return redirect('/buku/biblio')->with('success', 'buku berhasil ditambahkan');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $koleksi = Koleksi::find($id);

        $koleksi->update([
            'no_reg' => $request->no_reg ?? $koleksi->no_reg,
            'lokasi' => $request->lokasi ? $koleksi->lokasi : "null",
            'status' => $request->status ?? $koleksi->status,
            'kondisi' => $request->kondisi ?? $koleksi->kondisi,
        ]);
        return redirect('/buku/koleksi')->with('success', 'koleksi berhasil diupate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $koleksi = Koleksi::find($id);
        $biblio = Biblio::where('id', $koleksi->biblio_id)->first();
        if($biblio->jumlah_buku>0){
            $biblio->update(['jumlah_buku' => $biblio->jumlah_buku -1]);
        }

        if($biblio->stok>0){
            $biblio->update(['stok' => $biblio->stok -1]);
        }
        
        $koleksi->delete();
        return redirect('/buku/koleksi')->with('success', 'data koleksi berhasil dihapus');
    }


    // pencarian
    public function search(Request $request)
    {

        $request->validate([
            'q' => 'required'
        ], [
            'required' => 'atribute tidak boleh kosong'
        ]);
        $cari = $request->q;
        #-----
        $koleksi=Biblio::
        join('koleksi', function ($join) {
            $join->on('biblio.id', '=', 'koleksi.biblio_id');
                 
        })
        ->where('kode_eksemplar', 'LIKE', "%$cari%")->orWhere('penulis', 'LIKE', "%$cari%")->orWhere('judul', 'LIKE', "%$cari%")->orWhere('no_reg', 'LIKE', "%$cari%")->orWhere('lokasi', 'LIKE', "%$cari%")->orWhere('status', 'LIKE', "%$cari%")->orWhere('kondisi', 'LIKE', "%$cari%")
        ->paginate(8);
        // dd($koleksi);
        #-----
        
        // $koleksi = Koleksi::where('kode_eksemplar', 'LIKE', "%$cari%")->orWhere('no_reg', 'LIKE', "%$cari%")->orWhere('lokasi', 'LIKE', "%$cari%")->orWhere('status', 'LIKE', "%$cari%")->orWhere('kondisi', 'LIKE', "%$cari%")->paginate();
        // dd($koleksi);
        return view('koleksi.index_search', [
            'title' => 'Daftar Koleksi',
            'koleksi' => $koleksi
        ]);
    }
}
