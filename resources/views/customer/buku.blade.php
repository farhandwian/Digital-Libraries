@extends('layouts.main')

@section('main-content')
    <!-- navbar section -->
    @include('partials.navbar')
    
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Open Content || detail product -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ asset('storage/' . $buku->gambar) }}" alt="Card image cap"
                            id="product-detail">
                    </div>

                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{ $buku->judul }}</h1>
                            {{-- <p class="h3 py-2">$25.00</p> --}}
                            <p class="py-2">
                                @if($buku->rating>0)
                                    @for ($i = 0; $i < $buku->rating; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                @else
                                        <i class="fa fa-star text-warning"></i>
                                @endif
                                
                                
                                <span class="list-inline-item text-dark">{{$buku->rating}} | {{$buku->total_reviewer}} komentar | {{$buku->total_dipinjam}} kali dipinjam</span>
                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Penulis:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{ $buku->penulis }}</strong></p>
                                </li>
                            </ul>


                            <h6>Deskripsi:</h6>
                            <p>{{ $buku->deskripsi }}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Penerbit dan Tahun Terbit :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted">
                                        <strong>{{ $buku->penerbit }},{{ $buku->tahun_terbit }}</strong>
                                    </p>
                                </li>
                            </ul>

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Genre:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{ $buku->tipe_koleksi }}</strong></p>
                                </li>
                            </ul>

                            <h6>Koleksi yang tersedia:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col">Kode Eksemplar</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">no reg</th>
                                        <th scope="col">kondisi</th>
                                        @auth
                                            @if(auth()->user()->level === 'user')
                                                <th scope="col">Aksi</th>
                                            @endif
                                        @endauth        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($koleksi as $p)
                                        <tr>
                                            
                                            <td>{{ $p->kode_eksemplar }}</td>
                                            <td>{{ $p->lokasi }}</td>
                                            <td>{{ $p->no_reg }}</td>
                                            <td>{{ $p->kondisi }}</td>
                                            @auth
                                                @if(auth()->user()->level === 'user')
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v" style="color:rgb(205, 181, 236);"></i>
                                                            </a>
                                                        
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            {{-- <li><a class="dropdown-item" href="{{ route('cart.add',['product'=>$product->id]) }}">Tambah ke keranjang</a></li> --}}
                                                            {{-- href="{{route(transaksi.ajukanSewa,$p->id)}}" --}}
                                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ajukanSewa">Ajukan Pinjam</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endauth        
                                            <td></td>
                                            
                                            
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="ajukanSewa" tabindex="-1" aria-labelledby="ajukanSewaLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="ajukanSewaLabel">Durasi Pinjam</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="{{route('transaksi.ajukanSewa',$p->id)}}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Tanggal Pinjam</label>
                                                        <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_pinjam" value="{{old('tgl_pinjam')}}">
                                                        {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Tanggal Kembali</label>
                                                        <input type="date" class="form-control" id="exampleInputPassword1" name="tgl_kembali" value="{{old('tgl_kembali')}}">
                                                    </div>
                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </tbody>
                            </table>
                            {{-- @if(session()->get('succes')) --}}
                            {{-- <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                
                                <div>
                                    <i class="fa-solid fa-check"></i> An example warning alert with an icon
                                </div>
                              </div> --}}
                            
                              @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              @elseif(session()->has('fail'))  
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-diamond-exclamation"></i>{{ session('fail') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Open Content || review -->
    
    <!-- Close Content -->

    <section class="py-5">
        <div class="container">
            <div class="row mt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3>Review</h3>
                    @if (App\Http\Controllers\ReviewController::checkReview($buku))
                        <button class="btn btn-wide" data-bs-target="#reviewBiblio"
                            data-bs-toggle="modal" style="background-color:rgb(220, 203, 241);">Tambahkan Ulasan</button>
                    @endif
                </div>
                <div class="container detail-container p-3" style="overflow-y: auto; height: 41vh; background-color: #fbfafc;
                padding: 20px;
                border-radius: 25px;
                border: 2px solid #e2dbe7;">
                    @if ($reviews->count())
                        @foreach ($reviews as $review)
                            <div class="review row border rounded-pill p-2 mb-2">
                                <div class="col-md-4 d-flex align-items-center">
                                    <i class="iconify detail-profile-icon" data-icon="healthicons:ui-user-profile"></i>
                                    <div class="container">
                                        <p class="mb-auto">{{ $review->anggota->nama }}</p>
                                        <p class="mb-auto">{{ $review->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-8 review-border">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <span class="fa fa-star text-warning"></span>
                                    @endfor
                                    <p>{{ $review->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mb-3 fs-5">Tidak ditemukan ulasan.</p>
                    @endif
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="reviewBiblio" tabindex="-1" aria-labelledby="reviewBiblio"
        aria-hidden="true">
        <div class="modal-dialog  mt-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="/buku/biblio/review/{{ $buku->id }}" method="post">
                        @csrf
                        <div class="login-bg">
                            <label for="comment" class="form-label">Komentar</label>
                            <textarea class="form-control" name="comment" id="comment" placeholder="Tulis komentar anda">{{ old('comment') }}</textarea>
                            <br>
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="star-rating">
                                {{ old('rating') }}
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                            <br>
                            <button type='submit' class="btn btn-primary mt-2">Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Start Article || related products-->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Produk Terkait</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">

                @foreach ($bukus as $p)
                    <div class="p-2 pb-3">
                        <div class="product-wap card rounded-6">
                            <div class="card rounded-6">
                                <img class="card-img rounded-6" src="{{ asset('storage/' . $p->gambar) }}"
                                    height="300" width="300">
                                <div
                                    class="card-img-overlay rounded-6 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn text-white" style="background-color:#5B5EA6;" href="/buku/biblio/{{$p->id}}"><i
                                                    class="far fa-heart"></i></a></li>
                                        <li><a class="btn text-white mt-2" style="background-color:#5B5EA6;" href="/buku/biblio/{{$p->id}}"><i
                                                    class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="/buku/biblio/{{$p->id}}" class="h3 text-decoration-none">{{ $p->judul }} by
                                    {{ $p->penulis }}</a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li></li>
                                    <li class="pt-2">
                                        <span
                                            class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


        </div>
    </section>
    <!-- End Article -->


    <!-- Start Script -->
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/templatemo.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- End Script -->

    <!-- Start Slider Script -->
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>

    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        })
    </script>
    <!-- End Slider Script -->

    <!-- footer section  -->
    @include('partials.footer')
@endsection
