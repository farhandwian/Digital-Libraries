<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Riwayat Transaksi';
        $transaksi = Transaksi::with('anggota','koleksi','user','denda')->whereNotIn('status', ['pending','pinjam'])->orderBy('created_at', 'desc')->paginate(6);
        return view('riwayat.index', compact('title', 'transaksi'));
    }

    public function search(Request $request)
    {


        $request->validate([
            'q' => 'required'
        ]);
        //cari dengan kode_transaksi
        $cari = $request->q;

        $title = 'Daftar Transaksi';
        
        $transaksi = Transaksi::where([['status','=','pinjam'],['kode_transaksi', 'LIKE', "%$cari%"]])->orWhere([['status','=','pinjam'],['nama_anggota', 'LIKE', "%$cari%"]])->paginate();
        
        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function showAll(){

    //     $data = [
    //         'title' => 'Riwayat Peminjaman',
    //         'transaksi' => Transaksi::withTrashed()->orderBy('deleted_at','desc')->get()

    //     ];
        
    //     return view('riwayat.showall',$data);
    // }
}
