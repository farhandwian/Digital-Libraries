<?php

namespace App\Http\Controllers;

use App\Biblio;
use App\Buku;
use App\Koleksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBiblio()
    {
        return view('buku.indexBiblio',[
            'title' => 'Daftar Buku',
            'buku' => Biblio::orderBy('penulis','asc')->paginate(4)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexKoleksi()
    {
        return view('buku.indexKoleksi',[
            'title' => 'Daftar Koleksi',
            'koleksi' => Koleksi::orderBy('updated_at','desc')->paginate(4)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBiblio(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|max:25|unique:biblio',
                'isbn' => 'required|unique:biblio',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required',
                'jumlah_buku' => 'required',
                // 'gambar' => 'required|image|mimes:jpg,jpeg,png,svg'
            
            ],[
                'required' => 'atribute tidak boleh kosong',
                'unique' => 'atribute sudah terdaftar',
                'max' => 'karakter max 25',
                'image' => 'atribute harus gambar',
                // 'mimes' => 'atribute harus format jpg,jpeg,png atau svg'
            ]);            
        } catch (\Illuminate\Validation\ValidationException $e){
            return redirect('/buku/biblio')->with('failed',$e->getMessage());
        }
        //request file gambar jika ada tambahkan dan jika kosong
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = $file->store('gambar-buku');
        }
        
        //insert to database buku
       
        Biblio::create([
            'judul' => $request->judul,
            'isbn' => $request->isbn ?? '',
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi ?? '',
            'gambar' => $fileName ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        //session success 
        return redirect('/buku/biblio')->with('success','buku berhasil ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeKoleksi(Request $request)
    {
        $request->validate([
            'no_reg' => 'required|unique:koleksi',
            'lokasi' => 'required',
            'status' => 'required',
        ],[
            'required' => 'atribute tidak boleh kosong',
            'unique' => 'atribute sudah terdaftar',
            'max' => 'karakter max 25',
        ]);
        
        //insert to database buku
       Koleksi::create([
            'biblio_id' => $request->bookId,
            'no_reg' => $request->no_reg,
            'lokasi' => $request->lokasi ?? '',
            'status' => $request->status ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        //session success 
        return redirect('/buku/biblio')->with('success','buku berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBiblio(Request $request, $id)
    {   
        $buku = Biblio::find($id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            Storage::delete($buku->gambar);
            $fileName = $file->store('gambar-buku');
        }else{
            $fileName = $buku->gambar;
        }

        $buku->update([
            'judul' => $request->judul ?? $buku->judul,
            'isbn' => $request->isbn ?? $buku->isbn,
            'penulis' => $request->penulis ?? $buku->penulis,
            'penerbit' => $request->penerbit ?? $buku->penerbit,
            'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku ?? $buku->jumlah_buku,
            // 'lokasi' => $request->lokasi ?? $buku->lokasi,
            'gambar' => $fileName ?? $request->file('gambar'),
            'updated_at' => Carbon::now()
        ]);
        return redirect('/buku/biblio')->with('success','buku berhasil diupate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKoleksi(Request $request, $id)
    {   
        $koleksi = Koleksi::find($id);

        $koleksi->update([
            'no_reg' => $request->no_reg ?? $koleksi->no_reg,
            'lokasi' => $request->lokasi ? $koleksi->lokasi:"null",
            'status' => $request->status ?? $koleksi->status,
        ]);
        return redirect('/buku/koleksi')->with('success','koleksi berhasil diupate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBiblio($id)
    {
        $buku = Biblio::find($id);
        Storage::delete($buku->gambar);
        $buku->delete();
        return redirect('/buku/biblio')->with('success','data biblio berhasil dihapus');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteKoleksi($id)
    {
        $koleksi = Koleksi::find($id);
        $koleksi->delete();
        return redirect('/buku/koleksi')->with('success','data koleksi berhasil dihapus');

    }

    // pencarian
    public function searchBiblio(Request $request){

        $request->validate([
            'q' => 'required'
        ],[
            'required' => 'atribute tidak boleh kosong'
        ]);
        $cari = $request->q;
        $buku = Biblio::where('judul','LIKE',"%$cari%")->orWhere('penulis','LIKE',"%$cari%")->paginate();

        return view('buku.indexBiblio',[
            'title' => 'Daftar Buku',
            'buku' => $buku
        ]);
    }

    // pencarian
    public function searchKoleksi(Request $request){

        $request->validate([
            'q' => 'required'
        ],[
            'required' => 'atribute tidak boleh kosong'
        ]);
        $cari = $request->q;
        $koleksi = Koleksi::where('id','LIKE',"%$cari%")->orWhere('no_reg','LIKE',"%$cari%")->paginate();

        return view('buku.indexKoleksi',[
            'title' => 'Daftar Koleksi',
            'koleksi' => $koleksi
        ]);
    }
}