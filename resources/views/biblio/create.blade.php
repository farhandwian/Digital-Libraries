@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header border-0">
                        <h3 class="my-3 text-center">{{ $title }}</h3>
                    </div>
                    <form action="{{ route('buku.storeBiblio') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" name="judul" value="{{ old('judul') }}"
                                @error('judul') is-invalid @enderror class="form-control">
                            @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">ISBN</label>
                            <input type="number" name="isbn" value="{{ old('isbn') }}" class="form-control">
                            @error('isbn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" name="penulis" value="{{ old('penulis') }}" class="form-control">
                            @error('penulis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="form-control">
                            @error('penerbit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Terbit</label>
                            <input type="number" min="0" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                class="form-control">
                            @error('tahun_terbit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tipe Koleksi</label>
                            <select name="tipe_koleksi" class="form-control">
                                {{old('tipe_koleksi')}}
                                <option value="" disabled selected>-- tipe koleksi --</option>
                                <option value="fiction">fiction</option>
                                <option value="reference">reference</option>
                                <option value="textbook">textbook</option>
                                <option value="non-fiction">non-fiction</option>
                            </select>
                            @error('tipe_koleksi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Total Buku</label>
                            <input type="number" min="0" name="jumlah_buku" value="{{ old('jumlah_buku') }}"
                                class="form-control">
                            @error('jumlah_buku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Buku Yang Tersedia</label>
                            <input type="number" min="0" name="stok" value="{{ old('stok') }}"
                                class="form-control">
                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" value="{{ old('deskripsi') }}" class="form-control"></textarea>
                        </div>
                        {{-- <div class="form-group">
                    <label for="">Lokasi</label>
                    <select name="lokasi" class="form-control">
                        <option value="" disabled selected>-- Pilih Rak --</option>
                        <option value="rak1">Rak 1</option>
                        <option value="rak2">Rak 2</option>
                        <option value="rak3">Rak 3</option>
                    </select>
                    @error('lokasi')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                        <div class="form-group">

                            <img width="150" height="150" />
                            <input type="file" name="gambar" id="" class="uploads form-control mt-2"
                                value="{{ old('gambar') }}">
                            @error('gambar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary ">simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
