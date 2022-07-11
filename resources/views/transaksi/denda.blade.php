@extends('layouts.master')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="card-header border-0">
                    <h3 class="my-3 text-center">{{ $title }}</h3>
                </div>
                <form action="{{ route('transaksi.denda',$transaksi->id) }}" method="post">
                @csrf
                <input type="hidden" name='tipe' value="{{$tipe}}">
                <div class="form-group">
                    <label>Jumlah denda</label>
                    <input type="number" placeholder="masukkan jumlah denda" name="jumlah_denda"class="form-control" autocomplete="off" value="{{ old('jumlah_denda') }}">
                    @error('jumlah_denda')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="">status</label>
                    <select name="status" class="form-control">
                        <option value="" disabled selected>-- Status --</option>
                        <option value="lunas">Sudah Bayar</option>
                        <option value="hutang">Belum Bayar</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
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

