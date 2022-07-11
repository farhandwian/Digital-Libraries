<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Buku;
use App\Biblio;
use App\Koleksi;
use App\Transaksi;
use App\Denda;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Transaksi::where('anggota_id',2)->count());
        $title = 'Daftar Transaksi';
        $transaksi = Transaksi::with('anggota', 'koleksi', 'user')->where('status', 'pinjam')->orderBy('created_at', 'desc')->paginate(6);
        $transaksi_pending = Transaksi::with('anggota', 'koleksi', 'user')->where('status', 'pending')->orderBy('created_at', 'desc')->paginate(6);
        //dd($transaksi_pending);
        return view('transaksi.index', compact('title', 'transaksi','transaksi_pending'));
    }

    public function checkPinjam($anggota_id){
        //tolak jika anggota sudah pinjam lebih dari 3 buku
        if (Transaksi::where([['anggota_id', '=', $anggota_id], ['status', '=', 'pinjam']])->count() >= 3) {
            session()->flash('fail', 'sorry, anggota sedang meminjam lebih dari 3 buku');

            return redirect('transaksi');
            exit;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('transaksi.create', [
            'title' => 'Tambah Transaksi',
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
        $message = ['required' => 'atribute tidak boleh kosong'];
        $request->validate([
            'nim' => 'required',
            'kode_eksemplar' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        ], $message);

        //cek koleksi dan anggota

        //cek apakah anggota ada didatabase
        if (Anggota::where('nim', $request->nim)->exists() == false) {
            session()->flash('fail', 'sorry,belum terdaftar sebagai anggota');

            return redirect('transaksi');
            exit;
        }


        $koleksi = Koleksi::where('kode_eksemplar', $request->kode_eksemplar)->first();
        //cek apakah koleksi ada di database
        if ($koleksi) {
            if ($koleksi->status == 'dipinjam') {
                session()->flash('fail', 'sorry,Koleksi sedang dipinjam');

                return redirect('transaksi');
                exit;
            }

            if ($koleksi->status == 'hilang') {
                session()->flash('fail', 'sorry,Koleksi ini sudah hilang');

                return redirect('transaksi');
                exit;
            }
        } else {
            session()->flash('fail', 'sorry,Koleksi tidak ada di database');

            return redirect('transaksi');
            exit;
        }

        //ambil anggota id
        $anggota = Anggota::where('nim', $request->nim)->get();

        foreach ($anggota as $val) {
            $anggota_id = $val->id;
            $anggota_nama = $val->nama;
        }

        //tolak jika anggota sudah pinjam lebih dari 3 buku
        // if (Transaksi::where([['anggota_id', '=', $anggota_id], ['status', '=', 'pinjam']])->count() >= 3) {
        //     session()->flash('fail', 'sorry, anggota sedang meminjam lebih dari 3 buku');

        //     return redirect('transaksi');
        //     exit;
        // }
        $this->checkPinjam($anggota_id);

        $koleksi->update(['status'=>"dipinjam"]);
        $transaksi = Transaksi::create([
            'kode_transaksi'=>Str::random(6),
            'anggota_id' => $anggota_id,
            'koleksi_id' => $koleksi->id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'pinjam',
            'nama_anggota'=>$anggota_nama,
            'ket' => $request->ket,
        ]);

        $biblio = Biblio::where('id', $transaksi->koleksi->biblio->id)->first();
        if ($biblio->stok > 0) {
            //jika transaksi dilakukan maka stok buku akan berkurang 
            $biblio->update(['stok' => $transaksi->koleksi->biblio->stok - 1]);
        }
        $biblio->update(['total_dipinjam' => $transaksi->koleksi->biblio->total_dipinjam + 1]);

        //jika transaksi dilakukan maka stok buku akan berkurang 
        //Biblio::where('id', $transaksi->koleksi->biblio->id)->update(['stok' => $transaksi->koleksi->biblio->stok - 1]);
        return redirect('transaksi')->with('success', 'transaksi anda berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $transaksi = Transaksi::with('anggota', 'koleksi', 'user')->find($id);
        // return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', [
            'title' => 'update transaksi',
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $message = ['required' => 'atribute tidak boleh kosong'];
        $request->validate([
            'nim' => 'required',
            'kode_eksemplar' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        ], $message);

        //cek anggota
        if (Anggota::where('nim', $request->nim)->exists() == false) {
            session()->flash('fail', 'sorry,belum terdaftar sebagai anggota');

            return redirect('transaksi');
            exit;
        }
        $koleksi =  Koleksi::where('kode_eksemplar', $request->kode_eksemplar)->first();
        $newKoleksiId = (int)$koleksi->id;
        $newAnggotaId = (int)$request->anggota_id;


        //cek apakah koleksi ada di database
        if ($koleksi) {
            //cek apakah id koleksi baru berbeda dengan yang lama,dan apakah koleksi baru sedang dipinjam
            if ($newKoleksiId !== $transaksi->koleksi_id) {
                if ($koleksi->status == 'dipinjam') {
                    session()->flash('fail', 'sorry,Koleksi sedang dipinjam');

                    return redirect('transaksi');
                    exit;
                }
            }
            //cek apakah id koleksi baru berbeda dengan yang lama,dan apakah koleksi baru hilang
            if ($newKoleksiId !== $transaksi->koleksi_id) {
                if ($koleksi->status == 'hilang') {
                    session()->flash('fail', 'sorry,Koleksi ini sudah hilang');

                    return redirect('transaksi');
                    exit;
                }
            }
        } else {
            session()->flash('fail', 'sorry,Koleksi tidak ada di database');

            return redirect('transaksi');
            exit;
        }


        //ambil anggota id
        $anggota = Anggota::where('nim', $request->nim)->get();

        foreach ($anggota as $val) {
            $anggota_id = $val->id;
            $anggota_nama = $val->nama;
        }

        //cek apakah anggota baru beda dengan anggota lama,dan tolak jika anggota baru sudah pinjam lebih dari 3 buku
        if ($newAnggotaId !== $transaksi->anggota_id) {
            if (Transaksi::where([['anggota_id', '=', $anggota_id], ['status', '=', 'pinjam']])->count() >= 3) {
                session()->flash('fail', 'sorry, anda sedang meminjam lebih dari 3 buku');

                return redirect('transaksi');
                exit;
            }
        }

        //cek apakah id koleksi baru berbeda dengan yang lama
        if ($newKoleksiId !== $transaksi->koleksi_id) {
            //jika update transaksi dilakukan maka stock buku yang baru diupdate akan berkurang  dan stok buku lama akan bertambah
            $biblio = $transaksi->koleksi->biblio->where('id', $koleksi->biblio_id)->first();
            if ($biblio->stok > 0) {
                $biblio->update(['stok' => $koleksi->biblio->stok - 1]);
            }
            $biblio->update(['stok' => $transaksi->koleksi->biblio->stok + 1]);
        }

        //update transaksi
        $transaksi->update([
            'anggota_id' => $anggota_id,
            'koleksi_id' => $koleksi->id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'nama_anggota'=>$anggota_nama,
            'ket' => $request->ket,
        ]);
        return redirect('transaksi')->with('success', 'transaksi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.hanya untuk koleksi dengan status pinjam
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        //ubah status koleksi jadi tersedia
        $transaksi->koleksi->update(['status' => "tersedia"]);
        //dd($transaksi->koleksi->status);
        //tambah stok biblio nya
        $transaksi->koleksi->biblio->update(['stok' => $transaksi->koleksi->biblio->stok + 1]);
        $transaksi->delete();
        return redirect('transaksi')->with('success', 'data berhasil dihapus');
    }

    public function searchPeminjaman(Request $request)
    {


        $request->validate([
            'q' => 'required'
        ]);
        //cari dengan kode_transaksi
        $cari = $request->q;

        $title = 'Daftar Transaksi';

        $transaksi_pending = Transaksi::where([['status','=','pending'],['kode_transaksi', 'LIKE', "%$cari%"]])->orWhere([['status','=','pending'],['nama_anggota', 'LIKE', "%$cari%"]])->paginate();
        $transaksi = Transaksi::with('anggota', 'koleksi', 'user')->where('status', 'pinjam')->orderBy('created_at', 'desc')->paginate(6);
        

        return view('transaksi.index', compact('transaksi','transaksi_pending'));
    }

    public function searchPengembalian(Request $request)
    {


        $request->validate([
            'q' => 'required'
        ]);
        //cari dengan kode_transaksi
        $cari = $request->q;

        $title = 'Daftar Transaksi';
        $transaksi_pending = Transaksi::with('anggota', 'koleksi', 'user')->where('status', 'pending')->orderBy('created_at', 'desc')->paginate(6);
        
        $transaksi = Transaksi::where([['status','=','pinjam'],['kode_transaksi', 'LIKE', "%$cari%"]])->orWhere([['status','=','pinjam'],['nama_anggota', 'LIKE', "%$cari%"]])->paginate();
        
        return view('transaksi.index', compact('transaksi','transaksi_pending'));
    }

    public function action(Request $request, Transaksi $transaksi)
    {

        if ($request->tipe == "kembali") {
            //dd($transaksi);
            $transaksi->status = "kembali";
            $transaksi->save();

            //jika action dilakukan maka ganti status koleksinya 
            $transaksi->koleksi->where('id', $transaksi->koleksi_id)->update(['status' => 'tersedia']);

            //tambah stok nya
            $transaksi->koleksi->biblio->where('id', $transaksi->koleksi->biblio_id)->update(['stok' => $transaksi->koleksi->biblio->stok + 1]);
            return redirect('transaksi')->with('success', 'buku berhasil dikembalikan');
        } else if ($request->tipe == "terlambat") {
            //tampilkan page denda
            return view('transaksi.denda', [
                'title' => 'denda',
                'tipe' => 'terlambat',
                'transaksi' => $transaksi
            ]);
        } else if ($request->tipe == "hilang") {
            //tampilkan page denda
            return view('transaksi.denda', [
                'title' => 'denda',
                'tipe' => "hilang",
                'transaksi' => $transaksi
            ]);
        }else if ($request->tipe == "terima") {

            $anggota_id=Anggota::where('nama',$transaksi->anggota->nama)->first();
            $this->checkPinjam($anggota_id);
            $transaksi->update([
                'status' => 'pinjam',
            ]);
            $transaksi->koleksi->status = "dipinjam";
            $transaksi->koleksi->save();
            //menamah total dipinjam di tabel biblio
            $biblio = Biblio::where('id', $transaksi->koleksi->biblio->id)->first();
            $biblio->update(['total_dipinjam' => $transaksi->koleksi->biblio->total_dipinjam + 1]);
            return redirect('transaksi')->with('success', 'request telah diterima');
            
        } else if ($request->tipe == "tolak") {
            $transaksi->update([
                'status' => 'ditolak',
            ]);
            // kembalikan data-data yang sebelumnya diubah di fungsi ajukan sewa
            $biblio = Biblio::where('id', $transaksi->koleksi->biblio->id)->first();
            

            $transaksi->koleksi->status = "tersedia";
            $transaksi->koleksi->save();
            //delete transaksi
            $this->destroy($transaksi->id);
            return redirect('transaksi')->with('success', 'request telah ditolak');
            
        }
    }

    public function denda(Request $request, Transaksi $transaksi)
    {
        $message = ['required' => 'atribute tidak boleh kosong'];
        $request->validate([
            'jumlah_denda' => 'required',
        ], $message);

        Denda::Create([
            'transaksi_id' => $transaksi->id,
            'jumlah_denda' => $request->jumlah_denda,
            'status' => "lunas"
        ]);

        if ($request->tipe == 'terlambat') {
            $transaksi->status = "terlambat";
            $transaksi->save();

            //jika action dilakukan maka ganti status koleksinya 
            $transaksi->koleksi->update(['status' => 'tersedia']);

            //tambah stok nya
            $transaksi->koleksi->biblio->where('id', $transaksi->koleksi->biblio_id)->update(['stok' => $transaksi->koleksi->biblio->stok + 1]);
        } else if ($request->tipe == 'hilang') {
            $transaksi->status = "hilang";
            $transaksi->save();

            //jika action dilakukan maka ganti status koleksinya 
            $transaksi->koleksi->update(['status' => 'hilang']);

            $biblio = $transaksi->koleksi->biblio->where('id', $transaksi->koleksi->biblio_id)->first();
            //kurangi jumlah buku nya
            if ($biblio->jumlah_buku > 0) {
                $biblio->update(['jumlah_buku' => $transaksi->koleksi->biblio->jumlah_buku - 1]);
            }
            // if ($biblio->stok > 0) {
            //     $biblio->update(['stok' => $transaksi->koleksi->biblio->stok - 1]);
            // }
        }


        return redirect('transaksi')->with('success', 'buku berhasil dikembalikan dan denda berhasil ditambahkan');
    }

    /**
     * Show the jumlah_denda inside detail feature.
     *
     * @param  int  $id is id of specific row in transaksi table
     * @return \Illuminate\Http\Response
     */
    public static function showDenda($id)
    {
        $denda = Denda::where([['transaksi_id', '=', $id], ['status', '=', 'lunas']])->first();
        if ($denda) {
            return $denda->jumlah_denda;
        } else {
            return 0;
        }
    }

    /**
     * ajukanSewa a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajukanSewa(Request $request,Koleksi $koleksi)
    {
        

        //cek koleksi dan anggota



        //cek apakah anggota ada didatabase
        if (Anggota::where('user_id', auth()->user()->id)->exists() == false) {
            // session()->flash('fail', 'sorry,belum terdaftar sebagai anggota');

            return back()->with('fail', 'sorry,anda belum terdaftar sebagai anggota');
            exit;
        }


        $koleksi = Koleksi::where('id', $koleksi->id)->first();       

        $anggota = Anggota::where('user_id', auth()->user()->id)->get();

        foreach ($anggota as $val) {
            $anggota_id = $val->id;
            $anggota_nama = $val->nama;
        }

        //tolak jika anggota telah mengajukan pinjam lebih dari 3 buku dan masih pending
        if (Transaksi::where([['anggota_id', '=', $anggota_id], ['status', '=', 'pending']])->count() >= 3) {
            session()->flash('fail', 'sorry, anda telah mengajukan pinjam lebih dari 3 buku');

            return redirect('transaksi');
            exit;
        }
        //tolak jia nggota sudah meminjam lebih dari 3 buku
        $this->checkPinjam($anggota_id);
        
        //tolak jika anggota sudah pinjam lebih dari 3 buku
        if (Transaksi::where([['anggota_id', '=', $anggota_id], ['status', '=', 'pinjam']])->count() >= 3) {
            return back()->with('fail', 'sorry, anda sedang meminjam lebih dari 3 buku');
            exit;
        }

        // $koleksi->status = "dipesan";
        // $koleksi->save();

        $koleksi->update(['status'=>"dipesan"]);

        $transaksi = Transaksi::create([
            'kode_transaksi'=>Str::random(6),
            'anggota_id' => $anggota_id,
            'koleksi_id' => $koleksi->id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'pending',
            'nama_anggota'=>$anggota_nama,
            'ket' => '',
        ]);

        $biblio = Biblio::where('id', $transaksi->koleksi->biblio->id)->first();
        if ($biblio->stok > 0) {
            //jika transaksi dilakukan maka stok buku akan berkurang 
            $biblio->update(['stok' => $transaksi->koleksi->biblio->stok - 1]);
        }
        //$biblio->update(['total_dipinjam' => $transaksi->koleksi->biblio->total_dipinjam + 1]);

        //jika transaksi dilakukan maka stok buku akan berkurang 
        //Biblio::where('id', $transaksi->koleksi->biblio->id)->update(['stok' => $transaksi->koleksi->biblio->stok - 1]);
        return back()->with('success', 'sewa telah diajukan,harap menemui admin perpustakaan!');
    }
    
}
