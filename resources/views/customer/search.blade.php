@extends('layouts.main')

@section('main-content')
    <!-- navbar section -->
    @include('partials.navbar')

    <div class="container mt-5">
        <div class="">
            <form action="/search" class="gap-4">
                <div class="form-inline">
                    <input class="form-control mb-2 mr-sm-2" id="search-input" name="search"
                        placeholder="Cari buku yang anda inginkan" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info mb-2">Cari</button>
                </div>
                <div class="form-inline">
                    <ul class="list-group list-group-horizontal gap-2" style="list-style: none; border: none;">
                        <li>
                            <select class="btn btn-info form-select px-5 text-start" name="sort">
                                <option {{ request('sort') == '' ? 'selected' : 'disable' }} value="">Urut
                                    Berdasarkan</option>
                                <option {{ request('sort') == 'rekomendasi' ? 'selected' : '' }} value="rekomendasi">
                                    Rekomendasi</option>
                                <option {{ request('sort') == 'buku-terbaru' ? 'selected' : '' }} value="buku-terbaru">
                                    Buku Terbaru</option>
                                <option {{ request('sort') == 'terbit-terbaru' ? 'selected' : '' }}
                                    value="terbit-terbaru">Terbit Terbaru</option>
                            </select>
                        </li>
                        <li>
                            <select class="btn btn-info form-select px-5 text-start" name="type">
                                <option {{ request('type') == '' ? 'selected' : 'disable' }} value="">Tipe Koleksi
                                </option>
                                <option {{ request('type') == 'fiction' ? 'selected' : '' }} value="fiction">fiction
                                </option>
                                <option {{ request('type') == 'reference' ? 'selected' : '' }} value="reference">reference
                                </option>
                                <option {{ request('type') == 'textbook' ? 'selected' : '' }} value="textbook">textbook
                                </option>
                                <option {{ request('type') == 'non-fiction' ? 'selected' : '' }} value="non-fiction">
                                    non-fiction</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

        <div class="container mt-3">
            @foreach ($buku as $property)
                <a href="/buku/biblio/{{ $property->id }}" class="text-black" style="text-decoration: none;">
                    <div class="card card-browse">
                        <div class="col">
                            <img src="{{ asset('storage/' . $property->gambar) }}" class="card-img-browse" height="208"
                                width="300" style="border-radius: 25px;
                    border: 2px solid white;">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="card-content-star">
                                        <i class="fa-regular fa-star"></i>
                                        <h6 class="card-text browse-rating-text">Detail</h6>
                                    </div>
                                    <div class="card-content-detail">
                                        <p class="card-text card-content-detail-name">
                                            rating:{{ $property->rating }}</p>
                                        <p class="card-text card-content-detail-name">Total
                                            dipinjam:{{ $property->total_dipinjam }}</p>
                                        <p class="card-text card-content-detail-name">Stok
                                            Buku:{{ $property->stok }}</p>    
                                        <p class="card-text card-content-detail-name">Judul :{{ $property->judul }}</p>
                                        <p class="card-text card-content-detail-name">Penulis :{{ $property->penulis }}
                                        </p>
                                        <p class="card-text card-content-detail-name">Tipe Koleksi
                                            :{{ $property->tipe_koleksi }}</p>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="card-content-star">
                                        <i class="fa-regular fa-star"></i>
                                        <h6 class="card-text browse-rating-text">Deskripsi</h6>
                                    </div>
                                    <div class="card-content-detail" id="deskripsiBuku">
                                        <p class="card-text card-content-detail-name">{{ $property->deskripsi }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>


        <div class="d-flex mt-4 justify-content-end">
            {{ $buku->links() }}
        </div>
    </div>

    
    <script>
        window.onload = function() {
            if (window.jQuery) {
                // jQuery is loaded  
                console.log("jQuery has loaded!");
            } else {
                // jQuery is not loaded
                console.log("jQuery has not loaded!");
            }
        }
        
    </script>

    @include('partials.footer')
@endsection
