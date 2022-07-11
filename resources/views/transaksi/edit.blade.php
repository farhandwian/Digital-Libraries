@extends('layouts.master')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="card-header border-0">
                    <h3 class="my-3 text-center">{{ $title }}</h3>
                </div>
                <form action="{{ route('transaksi.update',$transaksi->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>NIM Mahasiswa</label>
                    <input type="text" placeholder="masukkan nim" name="nim"class="form-control" autocomplete="off" value="{{ $transaksi->anggota->nim }}">
                    @error('nim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kode Eksemplar</label>
                    <input type="text" placeholder="masukkan id koleksi" name="kode_eksemplar"class="form-control" autocomplete="off" value="{{ $transaksi->koleksi->kode_eksemplar }}">
                    @error('kode_eksemplar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam"class="form-control" value="{{$transaksi->tgl_pinjam}}">
                    @error('tgl_pinjam')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali"class="form-control" value="{{ $transaksi->tgl_kembali }}">
                    @error('tgl_kembali')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea  name="ket"class="form-control" placeholder="optional" value ="{{ $transaksi->ket }}"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-danger" href="{{ route('transaksi.index') }}">kembali</a>
                    <button type="submit" class="btn btn-primary">simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection

