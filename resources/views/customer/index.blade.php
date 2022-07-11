@extends('layouts.main')

@section('main-content')
    <!-- navbar section -->
    @include('partials.navbar')

        <div class="container mt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center align-items-center"
                    style="background-image:url('{{ asset('template/img/home.jfif') }}'); background-size: 100% 100%;width: 1000px;height: 500px;border-radius: 25px;">
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 style="color: #6B5B95"><b>Digital</b> Libraries</h1>
                            <h3>Aplikasi Manajemen Perpustakaan</h3>
                            <p>
                                <h6>Digital Libraries adalah aplikasi untuk memudahkan 2 pihak,yaitu pihak admin dan pihak customer.
                                    Admin akan lebih mudah dalam mengelola data buku,mengelola anggota,dan mengelola sirkulasi buku.
                                    Customer akan bisa mencari buku dengan lebih muda,meminjam buku dengan lebih mudah,dan mengecek sirkulasi bukunya.
                                </h6>
                            </p>
                        </div>
                    </div>
                    {{-- <div class="p-2 bd-highlight">
                        <h1>Digital Libraries:</h1>
                    </div>
                    <h5>Aplikasi ini dibuat untuk memudahkan proses-proses dalam perpustakaan</h5> --}}

                    {{-- <div class="p-2 bd-highlight"><h2>Aplikasi ini dibuat untuk memudahkan pustakawan untuk manajemen buku</h2></div> --}}
                    {{-- <div class="p-2 bd-highlight"><h2>Aplikasi ini juga dibuat untuk memudahkan mahasiswa meminjam serta mengembalikan buku</h2></div> --}}
                </div>
            </div>
        </div>    

        <div class="container mt-1">
            <div class="landing-page-search">
                <div style="padding:20px; background-color:#dddef0; border-radius: 25px;
                border: 2px solid white;">
                    <h4>Cari Buku</h4>

                    <form action="/search" class="form-inline">
                        <input class="form-control mb-2 mr-sm-2" id="search-input" name="search"
                            placeholder="Cari buku yang anda inginkan" value="{{ request('search') }}" required>
                        <button type="submit" class="btn btn-info mb-2">Cari</button>
                    </form>
                </div>
            </div>
        </div>

        
        <section class="bg-light">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Rekomendasi Buku</h1>
                    <p>
                        Buku-Buku dengan total pinjam yang paling banyak akan ditampilkan disini
                    </p>
                </div>
            </div>
            <div class="container mt-5">
                <div class="landing-page-recommendation">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            {{-- slide 1 --}}
                            <div class="swiper-slide">
                                @foreach ($buku->take(5) as $item)
                                    <a href="buku/biblio/{{ $item->id }}" class="text-black" style="text-decoration: none;">
                                        <div class="card"
                                            style="border-radius: 25px;border: 2px solid #6B5B95;">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="" alt="House"
                                                height="190" width="190"
                                                style="border-radius: 25px;
                                                border: 2px solid white;">
                                            <div class="card-body">
                                                <p class="card-text">{{ $item->judul }}</p>
                                                <li class="fa fa-star star-checked">{{$item->rating}} | {{$item->total_dipinjam}} kali dipinjam</li>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
        
                            {{-- <div class="swiper-slide">
                                @foreach ($buku->take(5) as $item)
                                    <a href="buku/biblio/{{ $item->id }}" class="text-black" style="text-decoration: none;">
                                        <div class="card" style="border-radius: 25px;border: 2px solid #6B5B95;">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="House" alt="House"
                                                style="border-radius: 25px; border: 2px solid white; width: 100%; height: 15vw;object-fit: cover;">
                                            <div class="card-body">
                                                <p class="card-text">{{ $item->judul }}</p>
                                                <li class="fa fa-star star-checked">{{$item->rating}}</li>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div> --}}
        
                            
        
                            {{-- slide 2 --}}
                            <div class="swiper-slide">
                                @foreach ($buku->skip(5) as $item)
                                    <a href="buku/biblio/{{ $item->id }}" class="text-black" style="text-decoration: none;">
                                        <div class="card"
                                            style="border-radius: 25px;
                                    border: 2px solid #6B5B95;">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="" alt="House"
                                                height="190" width="190"
                                                style="border-radius: 25px;
                                            border: 2px solid white;">
                                            <div class="card-body">
                                                <p class="card-text">{{ $item->judul }}</p>
                                                <li class="fa fa-star star-checked">{{$item->rating}} | {{$item->total_dipinjam}} kali dipinjam</li>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
        
                            {{-- slide 3 --}}
                            {{-- <div class="swiper-slide">Slide 3</div> --}}
                        </div>
                        <!-- If we need pagination -->
                        <div class="pt-8 swiper-pagination"></div>
        
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>   
        </section>

        <section class="" style="background-color:white">
            <div class="row text-center py-3 mt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Buku Terbaru</h1>
                    <p>
                        Buku-Buku yang paling baru dimasukan ke perpustakaan akan ditampilkan disini
                    </p>
                </div>
            </div>
            <div class="container mt-5">
                <div class="landing-page-recommendation">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            {{-- slide 1 --}}
                            <div class="swiper-slide">
                                @foreach ($bukus->take(5) as $item)
                                    <a href="buku/biblio/{{ $item->id }}" class="text-black" style="text-decoration: none;">
                                        <div class="card"
                                            style="border-radius: 25px;border: 2px solid #6B5B95;">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="" alt="House"
                                                height="190" width="190"
                                                style="border-radius: 25px;
                                                border: 2px solid white;">
                                            <div class="card-body">
                                                <p class="card-text">{{ $item->judul }}</p>
                                                <li class="fa fa-star star-checked">{{$item->rating}} | {{$item->total_dipinjam}} kali dipinjam</li>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>                           
                            {{-- slide 2 --}}
                            <div class="swiper-slide">
                                @foreach ($bukus->skip(5) as $item)
                                    <a href="buku/biblio/{{ $item->id }}" class="text-black" style="text-decoration: none;">
                                        <div class="card"
                                            style="border-radius: 25px;
                                    border: 2px solid #6B5B95;">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="" alt="House"
                                                height="190" width="190"
                                                style="border-radius: 25px;
                                            border: 2px solid white;">
                                            <div class="card-body">
                                                <p class="card-text">{{ $item->judul }}</p>
                                                <li class="fa fa-star star-checked">{{$item->rating}} | {{$item->total_dipinjam}} kali dipinjam</li>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
        
                            {{-- slide 3 --}}
                            {{-- <div class="swiper-slide">Slide 3</div> --}}
                        </div>
                        <!-- If we need pagination -->
                        <div class="pt-8 swiper-pagination"></div>
        
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>   
        </section>
        
        <br />

        <section class="bg-light">
            <div class="row text-center py-3 mt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Genre Buku</h1>
                    
                </div>
            </div>
            <div class="container mt-5">
                <div class="row mb-5">
                    <div class="col-md">
                        <a href="/search?type=reference" class="text-black" style="text-decoration: none;">
                            <img src="{{ asset('template/img/bookgenre/reference.jfif') }}" alt="Reference" class="rounded w-100"
                                height="200">
                            <p class="text-center fw-bold fs-4">Reference</p>
                        </a>
                    </div>
                    <div class="col-md">
                        <a href="/search?type=fiction" class="text-black" style="text-decoration: none;">
                            <img src="{{ asset('template/img/bookgenre/fiction.jfif') }}" alt="Fiction" class="rounded w-100"
                                height="200">
                            <p class="text-center fw-bold fs-4">Fiction</p>
                        </a>
                    </div>
                    <div class="col-md">
                        <a href="/search?type=non-fiction" class="text-black" style="text-decoration: none;">
                            <img src="{{ asset('template/img/bookgenre/non-fiction.jfif') }}" alt="Non-fiction"
                                class="rounded w-100" height="200">
                            <p class="text-center fw-bold fs-4">Non-fiction</p>
                        </a>
                    </div>
                    <div class="col-md">
                        <a href="/search?type=textbook" class="text-black" style="text-decoration: none;">
                            <img src="{{ asset('template/img/bookgenre/text-book.jfif') }}" alt="Text-book" class="rounded w-100"
                                height="200">
                            <p class="text-center fw-bold fs-4">Text-book</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>    

        
    

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>

    <!-- footer section  -->
    @include('partials.footer')
@endsection
