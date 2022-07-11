@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header border-0">
                        <h3 class="my-3 text-center">{{ $title }}</h3>
                    </div>
                    <form action="{{ route('buku.storeKoleksi') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="hidden" name="biblio_id" value="{{$biblio_id}}" />
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" disabled name="judul" value="{{$judul}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" disabled name="penulis" value="{{$penulis}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kode Eksemplar</label>
                            <input type="text" name="kode_eksemplar" value="{{ old('kode_eksemplar') }}" class="form-control">
                            @error('kode_eksemplar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">No registrasi</label>
                            <input type="text" name="no_reg" value="{{ old('no_reg') }}" class="form-control">
                            @error('no_reg')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control">
                            @error('lokasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">status</label>
                            <select name="status" class="form-control">
                                {{old('status')}}
                                <option value="" disabled selected>-- Status --</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="dipinjam">Dipinjam</option>
                                <option value="hilang">Tidak tersedia</option>
                            </select>
                            @error('status')
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
