<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Anggota;
use App\User;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    //
    public function index(){
        //cari anggota
        $anggota = Anggota::firstWhere('user_id',auth()->user()->id);
        return view('customer.dashboard.dipinjam', [
            'title' => 'Dashboard User',
            'transaksi' => Transaksi::where([['anggota_id','=',$anggota->id],['status','=','pinjam']])->orderBy('updated_at', 'desc')->paginate(6),
        ]);
    }

    public function ajukanPinjam(){
        //cari anggota
        $anggota = Anggota::firstWhere('user_id',auth()->user()->id);
        return view('customer.dashboard.ajukanPinjam', [
            'title' => 'Dashboard User',
            'transaksi' => Transaksi::where([['anggota_id','=',$anggota->id],['status','=','pending']])->orderBy('updated_at', 'desc')->paginate(6)
        ]);
    }

    public function riwayat(){
        //cari anggota
        $anggota = Anggota::firstWhere('user_id',auth()->user()->id);
        return view('customer.dashboard.riwayat', [
            'title' => 'Dashboard User',
            'transaksi' => Transaksi::where([['anggota_id','=',$anggota->id]])->whereNotIn('status', ['pending','pinjam'])->orderBy('updated_at', 'desc')->paginate(6)
        ]);
    }
}
