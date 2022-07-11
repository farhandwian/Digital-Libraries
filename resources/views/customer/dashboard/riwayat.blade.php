@extends('customer.dashboard.layouts.main')

@section('main-content')

<div class="row">
    <!-- left side section -->
    @include('customer.dashboard.layouts.sidebar')

    <!-- right side section -->
    <div class="col p-3">
        <h1 class="fs-3 fw-bold mb-3">Riwayat Peminjaman</h1>
        <div class="border border-secondary rounded px-4 py-3" style="overflow-y: auto; height: 61vh">
            @foreach ($transaksi as $item)

            
            <a href="/buku/biblio/{{$item->koleksi->biblio->id}}" style="text-decoration:none;color:black;">
                <div class="row border border-secondary rounded p-3 mb-3">
                    <div class="col">
                        <div class="row">
                            <p class="fw-bold mb-0">Judul : {{ $item->koleksi->biblio->judul }}</p>
                            <p class="">Penulis : {{ $item->koleksi->biblio->penulis }}</p>
                        </div>
                        <div class="row mt-2">
                            <p class="mb-0">Kode Eksemplar:{{ $item->koleksi->kode_eksemplar }}</p>                        
                            <p class="mb-0">Kode Transaksi:{{ $item->kode_transaksi }}</p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="row">
                            <p class="">Tgl Pinjam: {{ $item->tgl_pinjam }}</p>
                        </div>
                        <div class="row">
                            <p class="">Tgl Kembali: {{ $item->tgl_kembali }}</p>
                        </div>
                        <div class="row">
                            <p class="">Status: {{ $item->status }}</p>
                        </div>
                        {{-- <div class="row invisible">
                            <p>Invisible</p>
                        </div> --}}
    
                    </div>
                </div>
            </a>
            
            @endforeach
        </div>
    </div>
</div>
@endsection
