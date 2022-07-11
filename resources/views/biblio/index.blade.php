@extends('layouts.master')
@section('content')
    <div class="row ">
        <div class="col-md-6 mt-4 mb-2">
            <a class="btn btn-secondary btn-rounded" href="{{ route('buku.createBiblio') }}"> Tambah Biblio</a>
        </div>
        <div class="col-md-6 mt-4 mb-3 d-flex justify-content-end">
            <!-- Search form -->
            <form action="{{ route('buku.searchBiblio') }}" method="get"
                class="navbar-search navbar-search-light form-inline mr-sm-3 " id="navbar-search-main">

                <input type="text" placeholder="masukkan pencarian"
                    class="form-control bg-white @error('q') is-invalid @enderror" name="q" autocomplete="off" autofocus>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>

            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="my-3 text-center">{{ $title }}</h3>
                    <div class="success" data-flash="{{ session()->get('success') }}"></div>
                    <div class="failed" data-flash="{{ session()->get('failed') }}"></div>
                    <div class="hapus" data-flash="{{ session()->get('success') }}"></div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="Judul">Judul</th>
                                <th scope="col" class="sort" data-sort="Penulis">Penulis</th>
                                <th scope="col" class="sort" data-sort="Penerbit">Penerbit</th>
                                <th scope="col" class="sort" data-sort="Tahun Terbit">Tahun Terbit</th>
                                <th scope="col" class="sort" data-sort="Tipe Koleksi">Tipe Koleksi</th>
        
                                <th scope="col" class="sort" data-sort="Stok">Jumlah buku</th>
                                <th scope="col" class="sort" data-sort="Stok">Stok</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($buku as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->judul }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $item->penulis }}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-warning"></i>
                                            <span class="status">{{ $item->penerbit }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        {{ $item->tahun_terbit }}
                                    </td>
                                    <td>
                                        {{ $item->tipe_koleksi }}
                                    </td>
                                    <td>
                                        {{ $item->jumlah_buku }}
                                    </td>
                                    <td>
                                        {{ $item->stok }}
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <button class="dropdown-item btn-detail"
                                                    data-target="#detailBiblio{{ $item->id }}"
                                                    data-toggle="modal">Detail</button>

                                                <form action="{{ route('buku.editBiblio', $item->id) }}">
                                                <button class="dropdown-item btn-edit">Edit</button>
                                                </form>

                                                <form action="{{ route('buku.createKoleksi', $item->id) }}">
                                                    <button id="openTambahKoleksi" class="dropdown-item btn-edit">Tambah
                                                        Koleksi</button>
                                                </form>

                                                <form action="{{ route('buku.deleteBiblio', $item->id) }}" method="post"
                                                    id="delete{{ $item->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item" type="button"
                                                        onclick="deleteBuku({{ $item->id }})">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            
                                {{-- Modal Detail Buku --}}
                                <div class="modal fade" id="detailBiblio{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content  mt-5">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card mb-3">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            @if ($item->gambar)
                                                                <img width="150" height="150"
                                                                    @if ($item->gambar) src="{{ asset('storage/' . $item->gambar) }}" @endif />
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <div class="card-text">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">
                                                                            <h2>{{ $item->judul }}</h2>
                                                                        </li>
                                                                        <li class="list-group-item">Penerbit :
                                                                            {{ $item->penerbit }}
                                                                        </li>
                                                                        <li class="list-group-item">Tahun :
                                                                            {{ $item->tahun_terbit }}
                                                                        </li>
                                                                        <li class="list-group-item">Tipe Koleksi :
                                                                            {{ $item->tipe_koleksi }}
                                                                        </li>
                                                                        <li class="list-group-item">ISBN :
                                                                            {{ $item->isbn }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-text text-right"><small
                                                                        class="text-muted">penulis:{{ $item->penulis }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-0 border border-light rounded">
                                                        <div class="card ">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Deskripsi</h5>
                                                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                                                <p class="card-text">{{ $item->deskripsi }}</p>
                                                                {{-- <a href="#" class="card-link">Card link</a>
                                                      <a href="#" class="card-link">Another link</a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{-- pagination --}}
                        @if ($buku->lastPage() != 1)
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $buku->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $buku->lastPage(); $i++)
                                    <li class="page-item {{ $i == $buku->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $buku->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $buku->nextPageUrl() }}">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        @endif

                        @if (count($buku) == 0)
                            <div class="text-center"> Tidak ada data!</div>
                        @endif

                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
@endsection

@push('script')
    <script>
        //show gambar
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $(".uploads").change(readURL)
            $("#f").submit(function() {
                return false
            })
        })

        //delete buku
        function deleteBuku(id) {

            Swal.fire({
                title: 'PERINGATAN!',
                text: "Yakin ingin menghapus Biblio?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'cancel',
            }).then((result) => {
                if (result.value) {
                    $('#delete' + id).submit();
                }
            })
        }

        $(document).on("click", ".passingID", function() {
            var ids = $(this).data('id');
            $(".modal-body #idkl").val(ids);
        });

        $(document).ready(function() {

            //detail buku
            $('.btn-detail').on('click', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: `http://localhost:8000/buku-detail/${id}`,
                    method: 'GET',
                    success: function(data) {
                        $('#detailBiblio').find('.modal-body').html(data);
                        $('#detailBiblio').show();
                    }
                })
            })

            //edit buku
            $('.btn-edit').on('click', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: `http://localhost:8000/buku/${id}/edit`,
                    method: 'GET',
                    success: function(data) {
                        $('#editBuku').find('.modal-body').html(data);
                        $('#editBuku').show();
                    }
                })
            })
            //session flash success 
            let success = $('.success').data('flash');
            if (success) {
                Swal.fire({

                    position: 'center',
                    type: 'success',
                    title: success,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            let failed = $('.failed').data('flash');
            if (failed) {
                Swal.fire({

                    position: 'center',
                    type: 'error',
                    title: failed,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            //session flash hapus 
            let hapus = $('.hapus').data('flash');
            if (hapus) {
                Swal.fire({

                    position: 'center',
                    type: 'success',
                    title: hapus,
                    showConfirmButton: false,
                    timer: 2000
                })
            }

            // $('#submitUpdateBiblio').click(function(e) {
            //     e.preventDefault();
            //     let id = $("#biblio_id").val();
            //     console.log(id);

            //     // $.ajaxSetup({
            //     //     headers: {
            //     //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //     //     }
            //     // });

            //     console.log('tes')
            //     $.ajax({
            //         url: '/update-biblio/'+id,
            //         method: 'post',
            //         data: {
            //             judul: jQuery('#judul').val(),
            //             isbn: jQuery('#isbn').val(),
            //             penulis: jQuery('#penulis').val(),
            //             penerbit: jQuery('#penerbit').val(),
            //             tahun_terbit: jQuery('#tahun_terbit').val(),
            //             jumlah_buku: jQuery('#jumlah_buku').val(),
            //         },
            //         success: function(result) {
            //             if (result.errors) {
            //                 $('.alert-danger').html('');
            //                 console.log('tes2')
            //                 $.each(result.errors, function(key, value) {
            //                     $('.alert-danger').show();
            //                     $('.alert-danger').append('<li>' + value + '</li>');
            //                 });
            //             } else {
            //                 $('.alert-danger').hide();
            //                 $('#open').hide();
            //                 $('#myModal').modal('hide');
            //             }
            //         }
            //     });
            // });
        })

        $(document).on('click', '#openTambahKoleksi', function() {
            var bookId = $(this).data('id');
            var judulBuku = $(this).data('judul');
            var penulis = $(this).data('penulis');


            $(".modal-body #bookId").val(bookId);
            $(".modal-body #judulBuku").val(judulBuku);
            $(".modal-body #penulisBuku").val(penulis);
        });
    </script>
@endpush
