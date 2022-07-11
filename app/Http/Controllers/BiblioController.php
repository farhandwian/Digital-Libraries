<?php

namespace App\Http\Controllers;

use App\Biblio;
use App\Buku;
use App\Koleksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BiblioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('biblio.index', [
            'title' => 'Daftar Buku',
            'buku' => Biblio::orderBy('updated_at', 'desc')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('biblio.create', [
            'title' => 'Tambah Biblio',
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
        // try {
        //     $request->validate([
        //         'judul' => 'required|max:25|unique:biblio',
        //         'isbn' => 'required|unique:biblio',
        //         'penulis' => 'required',
        //         'penerbit' => 'required',
        //         'tahun_terbit' => 'required',
        //         'jumlah_buku' => 'required',
        //         // 'gambar' => 'required|image|mimes:jpg,jpeg,png,svg'

        //     ], [
        //         'required' => 'atribute tidak boleh kosong',
        //         'unique' => 'atribute sudah terdaftar',
        //         'max' => 'karakter max 25',
        //         'image' => 'atribute harus gambar',
        //         // 'mimes' => 'atribute harus format jpg,jpeg,png atau svg'
        //     ]);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     return redirect('/create-biblio')->with('failed', $e->getMessage());
        // }


        $request->validate([
            'judul' => 'required|max:25|unique:biblio',
            'isbn' => 'required|unique:biblio',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            // 'gambar' => 'required|image|mimes:jpg,jpeg,png,svg'

        ], [
            'required' => 'atribute tidak boleh kosong',
            'unique' => 'atribute sudah terdaftar',
            'max' => 'karakter max 25',
            'image' => 'atribute harus gambar',
            // 'mimes' => 'atribute harus format jpg,jpeg,png atau svg'
        ]);

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
            'tipe_koleksi' => $request->tipe_koleksi,
            'jumlah_buku' => $request->jumlah_buku?$request->jumlah_buku:0,
            'stok' => $request->jumlah_buku?$request->stok:0, 
            'deskripsi' => $request->deskripsi ?? '',
            'gambar' => $fileName ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        //session success 
        return redirect('/buku/biblio')->with('success', 'buku berhasil ditambahkan');
    }


    public function edit(Biblio $biblio){
        return view('biblio.edit', [
            'title' => 'Edit Biblio',
            'item' => $biblio
        ]);
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
        $request->validate([
            'judul' => 'required|max:25|',
            'isbn' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            // 'gambar' => 'required|image|mimes:jpg,jpeg,png,svg'

        ], [
            'required' => 'atribute tidak boleh kosong',
            'unique' => 'atribute sudah terdaftar',
            'max' => 'karakter max 25',
            'image' => 'atribute harus gambar',
            // 'mimes' => 'atribute harus format jpg,jpeg,png atau svg'
        ]);

        // $validator = Validator::make($request->all(), [
        //     'judul' => 'required|max:25|unique:biblio',
        //     'isbn' => 'required|unique:biblio',
        //     'penulis' => 'required',
        //     'penerbit' => 'required',
        //     'tahun_terbit' => 'required',
        //     'jumlah_buku' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()->all()]);
        // }
        $buku = Biblio::find($id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            Storage::delete($buku->gambar);
            $fileName = $file->store('gambar-buku');
        } else {
            $fileName = $buku->gambar;
        }

        $buku->update([
            'judul' => $request->judul ?? $buku->judul,
            'isbn' => $request->isbn ?? $buku->isbn,
            'penulis' => $request->penulis ?? $buku->penulis,
            'penerbit' => $request->penerbit ?? $buku->penerbit,
            'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
            'tipe_koleksi' => $request->tipe_koleksi,
            'jumlah_buku' => $request->jumlah_buku?$request->jumlah_buku:0,
            'stok' => $request->jumlah_buku?$request->stok:0,
            'gambar' => $fileName ?? $request->file('gambar'),
            'updated_at' => Carbon::now()
        ]);
        return redirect('/buku/biblio')->with('success', 'buku berhasil diupate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $buku = Biblio::find($id);
        Storage::delete($buku->gambar);
        $buku->delete();
        return redirect('/buku/biblio')->with('success', 'data biblio berhasil dihapus');
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
        $buku = Biblio::where('judul', 'LIKE', "%$cari%")->orWhere('penulis', 'LIKE', "%$cari%")->paginate();

        return view('biblio.index', [
            'title' => 'Daftar Buku',
            'buku' => $buku
        ]);
    }
}
