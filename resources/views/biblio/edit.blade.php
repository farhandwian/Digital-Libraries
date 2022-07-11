@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header border-0">
                        <h3 class="my-3 text-center">{{ $title }}</h3>
                    </div>
                    <form action="{{ route('buku.updateBiblio', $item->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="hidden" id="biblio_id" value="{{ $item->id }}">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" name="judul" value="{{ $item->judul }}" class="form-control">
                            @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">ISBN</label>
                            <input type="text" name="isbn" value="{{ $item->isbn }}" class="form-control">
                            @error('isbn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" name="penulis" value="{{ $item->penulis }}" class="form-control">
                            @error('penulis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" name="penerbit" value="{{ $item->penerbit }}" class="form-control">
                            @error('penerbit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Terbit</label>
                            <input type="number" min="0" name="tahun_terbit" value="{{ $item->tahun_terbit }}"
                                class="form-control">
                            @error('tahun_terbit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tipe Koleksi</label>
                            <select name="tipe_koleksi" class="form-control">
                                <option value="" disabled selected>-- tipe koleksi --</option>
                                <option value="fiction"{{ $item->tipe_koleksi == 'fiction' ? 'selected' : '' }}>fiction</option>
                                <option value="reference"{{ $item->tipe_koleksi == 'reference' ? 'selected' : '' }}>reference</option>
                                <option value="textbook"{{ $item->tipe_koleksi == 'textbook' ? 'selected' : '' }}>textbook</option>
                                <option value="non-fiction"{{ $item->tipe_koleksi == 'non-fiction' ? 'selected' : '' }}>non-fiction</option>
                            
                            </select>
                            @error('tipe_koleksi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Total Buku</label>
                            <input type="number" min="0" name="jumlah_buku" value="{{ $item->jumlah_buku }}"
                                class="form-control">
                            @error('jumlah_buku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Buku Yang Tersedia</label>
                            <input type="number" min="0" name="stok" value="{{ $item->stok }}"
                                class="form-control">
                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" value="{{ $item->deskripsi }}" class="form-control"></textarea>
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
                            {{-- <input type="hidden" name="oldImage" value="{{$item->gambar}}"> --}}
                            <img src="{{ asset('storage/' . $item->gambar) }}" width="150" height="150" />
                            <input type="file" name="gambar" id="" class="uploads form-control mt-2"
                                value="{{ $item->gambar }}">
                            @error('gambar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary" id="submitUpdateBiblio">simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
