@extends('layouts.master')
@section('content')
    <div class="row ">
        <div class="col-md-6 mt-4 mb-2">
            {{-- <a class="btn btn-secondary btn-rounded" data-toggle="modal" data-target="#tambahKoleksi"> Tambah Koleksi</a> --}}
        </div>
        <div class="col-md-6 mt-4 mb-3 d-flex justify-content-end">
            <!-- Search form -->
            <form action="{{ route('buku.searchKoleksi') }}" method="get"
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
                                <th scope="col" class="sort" data-sort="id">id</th>
                                <th scope="col" class="sort" data-sort="judul">judul</th>
                                <th scope="col" class="sort" data-sort="penulis">penulis</th>
                                <th scope="col" class="sort" data-sort="no_reg">Kode Eksemplar</th>
                                <th scope="col" class="sort" data-sort="no_reg">No registrasi</th>
                                <th scope="col" class="sort" data-sort="lokasi">Lokasi</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort" data-sort="status">Kondisi</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($koleksi as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->id }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $item->judul }}
                                    </td>
                                    <td class="budget">
                                        {{ $item->penulis }}
                                    </td>
                                    <td class="budget">
                                        {{ $item->kode_eksemplar }}
                                    </td>
                                    <td class="budget">
                                        {{ $item->no_reg }}
                                    </td>

                                    <td>
                                        <span class="badge badge-dot mr-4">

                                            <span class="status">{{ $item->lokasi }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->status == 'tersedia')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-success"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @elseif($item->status == 'dipesan')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-primary"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @elseif($item->status == 'dipinjam')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @elseif($item->status == 'hilang')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-danger"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="budget">
                                        {{ $item->kondisi }}
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <button class="dropdown-item btn-detail"
                                                    data-target="#detailKoleksi{{ $item->id }}"
                                                    data-toggle="modal">Detail</button>


                                                <button class="dropdown-item btn-edit" data-toggle="modal"
                                                    data-target="#updateKoleksi{{ $item->id }}">Edit</button>

                                                {{-- <button id="openTambahKoleksi" class="dropdown-item btn-edit"
                                                    data-toggle="modal" data-target="#tambahKoleksi"
                                                    data-id="{{ $item->id }}"
                                                    data-judul="{{ $item->biblio->judul }}">Tambah</button> --}}

                                                <form action="{{ route('buku.deleteKoleksi', $item->id) }}" method="post"
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


                                {{-- modal update Koleksi --}}
                                <div class="modal fade" id="updateKoleksi{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="updateKoleksi" aria-hidden="true">
                                    <div class="modal-dialog  mt-5">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Koleksi</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('buku.updateKoleksi', $item->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('post')
                                                    <div class="form-group">
                                                        <label for="">Kode Eksemplar</label>
                                                        <input type="text" name="kode_eksemplar" value="{{ $item->kode_eksemplar }}"
                                                            class="form-control">
                                                        @error('kode_eksemplar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">No Registrasi</label>
                                                        <input type="text" name="no_reg" value="{{ $item->no_reg }}"
                                                            class="form-control">
                                                        @error('no_reg')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">lokasi</label>
                                                        <input type="text" name="lokasi" value="{{ $item->lokasi }}"
                                                            class="form-control">
                                                        @error('lokasi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="" disabled selected>-- Status --</option>
                                                            <option value="tersedia"
                                                                {{ $item->status == 'tersedia' ? 'selected' : '' }}>
                                                                Tersedia</option>
                                                            <option value="dipinjam"
                                                                {{ $item->status == 'dipinjam' ? 'selected' : '' }}>
                                                                Dipinjam</option>
                                                        </select>
                                                        @error('status')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Kondisi</label>
                                                        <input type="text" name="kondisi" value="{{ $item->kondisi }}"
                                                            class="form-control">
                                                        @error('kondisi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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

                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-primary ">simpan</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Detail Koleksi --}}
                                <div class="modal fade" id="detailKoleksi{{ $item->id }}" tabindex="-1"
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
                                                                            {{ $item->judul }}
                                                                        </li>
                                                                        <li class="list-group-item">id koleksi :
                                                                            {{ $item->id }}
                                                                        </li>
                                                                        <li class="list-group-item">Kode Eksemplar :
                                                                            {{ $item->kode_eksemplar }}
                                                                        </li>
                                                                        <li class="list-group-item">No Registrasi :
                                                                            {{ $item->no_reg }}
                                                                        </li>
                                                                        <li class="list-group-item">Status :
                                                                            {{ $item->status }}
                                                                        </li>
                                                                        <li class="list-group-item">Status :
                                                                            {{ $item->kondisi }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-text text-right"><small
                                                                        class="text-muted">{{ $item->penulis }}</small>
                                                                </div>
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

                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{-- pagination --}}
                        @if ($koleksi->lastPage() != 1)
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $koleksi->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $koleksi->lastPage(); $i++)
                                    <li class="page-item {{ $i == $koleksi->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $koleksi->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $koleksi->nextPageUrl() }}">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        @endif

                        @if (count($koleksi) == 0)
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
                text: "Yakin ingin menghapus Koleksi?",
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
                        $('#detailKoleksi').find('.modal-body').html(data);
                        $('#detailKoleksi').show();
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

        })

        $(document).on('click', '#openTambahKoleksi', function() {
            var bookId = $(this).data('id');
            var judulBuku = $(this).data('judul');

            $(".modal-body #bookId").val(bookId);
            $(".modal-body #judulBuku").val(judulBuku);
        });
    </script>
@endpush
