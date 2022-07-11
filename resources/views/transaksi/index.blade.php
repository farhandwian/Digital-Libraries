@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 mt-4 mb-2">
            <a href="{{ route('transaksi.create') }}" class="btn btn-secondary ">Tambah Transaksi</a>
        </div>
        <div class="col-md-6 mt-4 mb-3 d-flex justify-content-end">
            <!-- Search form -->
            <form action="{{ route('transaksi.searchPeminjaman') }}" method="get"
                class="navbar-search navbar-search-light form-inline mr-sm-3 " id="navbar-search-main">

                <input type="text" placeholder="search untuk peminjaman"
                    class="form-control bg-white @error('q') is-invalid @enderror" name="q" autocomplete="off" autofocus>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="my-3 text-center">Daftar Peminjaman</h3>
                    <div class="success" data-flash="{{ session()->get('success') }}"></div>
                    <div class="fail" data-flash="{{ session()->get('fail') }}"></div>
                    <div class="hapus" data-flash="{{ session()->get('success') }}"></div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="Nama">Kode</th>
                                <th scope="col" class="sort" data-sort="Nama">Nama</th>
                                <th scope="col" class="sort" data-sort="Nim">Nim</th>
                                <th scope="col" class="sort" data-sort="ID Koleksi">Eksemplar</th>
                                {{-- <th scope="col" class="sort" data-sort="Nama Buku">Nama Buku</th> --}}
                                <th scope="col" class="sort" data-sort="Tanggal Pinjam">Tanggal Pinjam</th>
                                <th scope="col" class="sort" data-sort="Tanggal Kembali">Tanggal Kembali</th>
                                <th scope="col" class="sort" data-sort="Status">Status</th>
                                <th scope="col" class="sort text-center" data-sort="Aksi">Aksi</th>
                                    
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($transaksi_pending as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->kode_transaksi }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->anggota->nama }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $item->anggota->nim }}
                                    </td>
                                    <td>
                                        {{-- echo '<img src="{{ $item->kode_transaksi_pending }}/png;base64,' . DNS1D::getBarcodePNG('4', 'EAN13') . '" alt="barcode" width="100" height="100"   />'; --}}
                                        <span class="status">{{ $item->koleksi->kode_eksemplar }}</span>
    
                                    </td>
                                    {{-- <td>
                                        {{ $item->koleksi->biblio->judul }}
                                    </td> --}}
                                    <td>
                                        {{ $item->tgl_pinjam }}
                                    </td>
                                    <td>
                                        {{ $item->tgl_kembali }}
                                    </td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @endif
    
                                    </td>
                                    <td>
                                        {{-- <div class="d-flex justify-content-start">
                                            <form action="{{route("transaksi_pending.action",$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="tipe"value="kembali">
                                                <button type="submit" class="btn btn-success btn-sm">Kembali</button>
                                            </form>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <form action="{{route("transaksi_pending.action",$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="tipe" value="terlambat">
                                                <button type="submit" class="btn btn-warning btn-sm">Terlambat</button>
                                            </form>
                                        </div>  
                                        <div class="d-flex justify-content-start">
                                            <form action="{{route("transaksi_pending.action",$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="tipe" value="hilang">
                                                <button type="submit" class="btn btn-danger btn-sm">Hilang</button>
                                            </form>    
                                        </div> --}}
    
                                        <div class="d-flex justify-content-around">
                                            <div class="col-3">
                                                <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="tipe"value="terima">
                                                    <button type="submit" class="btn btn-success btn-sm">terima</button>
                                                </form>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="tipe" value="tolak">
                                                    <button type="submit" class="btn btn-warning btn-sm">tolak</button>
                                                </form>
                                            </div>
                                          </div>
                                        {{-- <form action="{{route("transaksi.action")}}">
                                            <input type="hidden" name="tipe"value="kembali">
                                            <button type="button" class="btn btn-success btn-sm">K</button>
                                        </form>
                                        <form action="{{route("transaksi.action")}}">
                                            <input type="hidden" name="tipe" value="terlambat">
                                            <button type="button" class="btn btn-warning btn-sm">T</button>
                                        </form>
                                        <form action="{{route("transaksi.action")}}">
                                            <input type="hidden" name="tipe" value="hilang">
                                            <button type="button" class="btn btn-danger btn-sm">H</button>
                                        </form> --}}
                                        
                                    </td>
    
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <button class="dropdown-item btn-detail" data-target="#detailtransaksi_pending{{ $item->id }}"
                                                    data-toggle="modal">Detail</button>
    
                                                @if ($item->status == 'pending')
                                                    <form action="{{route('transaksi.edit',$item->id)}}">
                                                        <button class="dropdown-item btn-edit">Edit</button>
                                                    </form>
                                                    {{-- <form action="{{ route('transaksi.destroy', $item->id) }}"
                                                        method="post" id="delete{{ $item->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="dropdown-item" type="button"
                                                            onclick="deletetransaksi({{ $item->id }})">Hapus</button>
                                                    </form> --}}
                                                @endif
    
                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- modal detail transaksi --}}
                                <div class="modal fade" id="detailtransaksi_pending{{ $item->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content  mt-5">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail transaksi</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card mb-3">
                                                    <div class="row g-0">
                                                        <div class="col-md-12">
                                                            <div class="card-body">
                                                                <div class="card-text">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">Kode Transaksi:
                                                                            {{ $item->kode_transaksi }}</li>
                                                                        <li class="list-group-item">Nama:
                                                                            {{ $item->anggota->nama }}</li>
                                                                        <li class="list-group-item">Nim :
                                                                            {{ $item->anggota->nim }}</li>
                                                                        <li class="list-group-item">Jurusan :
                                                                            {{ $item->anggota->jurusan }}</li>
                                                                        <li class="list-group-item">No HP :
                                                                            {{ $item->anggota->no_hp }}</li>
                                                                        <li class="list-group-item">Waktu Pinjam :
                                                                            {{ $item->tgl_pinjam }}</li>
                                                                        <li class="list-group-item">Waktu Kembali :
                                                                            {{ $item->tgl_kembali }}</li>
                                                                        <li class="list-group-item">Buku :
                                                                            {{ $item->koleksi->biblio->judul }}</li>
                                                                        <li class="list-group-item">Kode Eksemplar :
                                                                            {{ $item->koleksi->kode_eksemplar }}</li>
                                                                        @if ($item->koleksi->biblio->gambar)
                                                                            <li class="list-group-item">Gambar : <img
                                                                                    src="{{ 'storage/' . $item->koleksi->biblio->gambar }}"
                                                                                    width="80" height="80"></li>
                                                                        @endif
                                                                        @if ($item->ket)
                                                                            <li class="list-group-item mt-3">Note :
                                                                                {{ $item->ket }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                {{-- <div class="card-text text-right"><small
                                                                        class="text-muted">tes</small>
                                                                </div> --}}
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
                        @if ($transaksi_pending->lastPage() != 1)
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $transaksi_pending->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $transaksi_pending->lastPage(); $i++)
                                    <li class="page-item {{ $i == $transaksi_pending->currentPage() ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ $transaksi_pending->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $transaksi_pending->nextPageUrl() }}">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
    
                        @if (count($transaksi_pending) == 0)
                            <div class="text-center"> Tidak ada data!</div>
                        @endif
    
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-4 mb-2">
            
        </div>
        <div class="col-md-6 mt-4 mb-3 d-flex justify-content-end">
            <!-- Search form -->
            <form action="{{ route('transaksi.searchPengembalian') }}" method="get"
                class="navbar-search navbar-search-light form-inline mr-sm-3 " id="navbar-search-main">

                <input type="text" placeholder="search untuk pengembalian"
                    class="form-control bg-white @error('q') is-invalid @enderror" name="q" autocomplete="off" autofocus>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="my-3 text-center">Daftar Pengembalian</h3>
                    <div class="success" data-flash="{{ session()->get('success') }}"></div>
                    <div class="fail" data-flash="{{ session()->get('fail') }}"></div>
                    <div class="hapus" data-flash="{{ session()->get('success') }}"></div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="Nama">Kode</th>
                                <th scope="col" class="sort" data-sort="Nama">Nama</th>
                                <th scope="col" class="sort" data-sort="Nim">Nim</th>
                                <th scope="col" class="sort" data-sort="ID Koleksi">Eksemplar</th>
                                {{-- <th scope="col" class="sort" data-sort="Nama Buku">Nama Buku</th> --}}
                                <th scope="col" class="sort" data-sort="Tanggal Pinjam">Tanggal Pinjam</th>
                                <th scope="col" class="sort" data-sort="Tanggal Kembali">Tanggal Kembali</th>
                                <th scope="col" class="sort" data-sort="Status">Status</th>
                                <th scope="col" class="sort text-center" data-sort="Aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($transaksi as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->kode_transaksi }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->anggota->nama }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $item->anggota->nim }}
                                    </td>
                                    <td>
                                        {{-- echo '<img src="{{ $item->kode_transaksi }}/png;base64,' . DNS1D::getBarcodePNG('4', 'EAN13') . '" alt="barcode" width="100" height="100"   />'; --}}
                                        <span class="status">{{ $item->koleksi->kode_eksemplar }}</span>

                                    </td>
                                    {{-- <td>
                                        {{ $item->koleksi->biblio->judul }}
                                    </td> --}}
                                    <td>
                                        {{ $item->tgl_pinjam }}
                                    </td>
                                    <td>
                                        {{ $item->tgl_kembali }}
                                    </td>
                                    <td>
                                        @if ($item->status == 'pinjam')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @elseif($item->status == 'terlambat')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-danger"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @elseif($item->status == 'hilang')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-danger"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @elseif($item->status == 'kembali')
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-success"></i>
                                                <span>{{ $item->status }}</span>
                                            </span>
                                        @endif

                                    </td>
                                    <td>
                                        {{-- <div class="d-flex justify-content-start">
                                            <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="tipe"value="kembali">
                                                <button type="submit" class="btn btn-success btn-sm">Kembali</button>
                                            </form>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="tipe" value="terlambat">
                                                <button type="submit" class="btn btn-warning btn-sm">Terlambat</button>
                                            </form>
                                        </div>  
                                        <div class="d-flex justify-content-start">
                                            <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="tipe" value="hilang">
                                                <button type="submit" class="btn btn-danger btn-sm">Hilang</button>
                                            </form>    
                                        </div> --}}

                                        <div class="d-flex justify-content-between">
                                            <div class="col-3">
                                                <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="tipe"value="kembali">
                                                    <button type="submit" class="btn btn-success btn-sm">Kembali</button>
                                                </form>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="tipe" value="terlambat">
                                                    <button type="submit" class="btn btn-warning btn-sm">Terlambat</button>
                                                </form>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{route("transaksi.action",$item->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="tipe" value="hilang">
                                                    <button type="submit" class="btn btn-danger btn-sm">Hilang</button>
                                                </form>
                                            </div>
                                          </div>
                                        {{-- <form action="{{route("transaksi.action")}}">
                                            <input type="hidden" name="tipe"value="kembali">
                                            <button type="button" class="btn btn-success btn-sm">K</button>
                                        </form>
                                        <form action="{{route("transaksi.action")}}">
                                            <input type="hidden" name="tipe" value="terlambat">
                                            <button type="button" class="btn btn-warning btn-sm">T</button>
                                        </form>
                                        <form action="{{route("transaksi.action")}}">
                                            <input type="hidden" name="tipe" value="hilang">
                                            <button type="button" class="btn btn-danger btn-sm">H</button>
                                        </form> --}}
                                        
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <button class="dropdown-item btn-detail" data-target="#detailTransaksi{{ $item->id }}"
                                                    data-toggle="modal">Detail</button>

                                                @if ($item->status == 'pinjam')
                                                    <form action="{{route('transaksi.edit',$item->id)}}">
                                                        <button class="dropdown-item btn-edit">Edit</button>
                                                    </form>
                                                    <form action="{{ route('transaksi.destroy', $item->id) }}"
                                                        method="post" id="delete{{ $item->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="dropdown-item" type="button"
                                                            onclick="deleteTransaksi({{ $item->id }})">Hapus</button>
                                                    </form>
                                                @endif

                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- modal detail transaksi --}}
                                <div class="modal fade" id="detailTransaksi{{ $item->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content  mt-5">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card mb-3">
                                                    <div class="row g-0">
                                                        <div class="col-md-12">
                                                            <div class="card-body">
                                                                <div class="card-text">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">Kode Transaksi:
                                                                            {{ $item->kode_transaksi }}</li>
                                                                        <li class="list-group-item">Nama:
                                                                            {{ $item->anggota->nama }}</li>
                                                                        <li class="list-group-item">Nim :
                                                                            {{ $item->anggota->nim }}</li>
                                                                        <li class="list-group-item">Jurusan :
                                                                            {{ $item->anggota->jurusan }}</li>
                                                                        <li class="list-group-item">No HP :
                                                                            {{ $item->anggota->no_hp }}</li>
                                                                        <li class="list-group-item">Waktu Pinjam :
                                                                            {{ $item->tgl_pinjam }}</li>
                                                                        <li class="list-group-item">Waktu Kembali :
                                                                            {{ $item->tgl_kembali }}</li>
                                                                        <li class="list-group-item">Buku :
                                                                            {{ $item->koleksi->biblio->judul }}</li>
                                                                        <li class="list-group-item">Kode Eksemplar :
                                                                            {{ $item->koleksi->kode_eksemplar }}</li>
                                                                        @if ($item->koleksi->biblio->gambar)
                                                                            <li class="list-group-item">Gambar : <img
                                                                                    src="{{ 'storage/' . $item->koleksi->biblio->gambar }}"
                                                                                    width="80" height="80"></li>
                                                                        @endif
                                                                        @if ($item->ket)
                                                                            <li class="list-group-item mt-3">Note :
                                                                                {{ $item->ket }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                {{-- <div class="card-text text-right"><small
                                                                        class="text-muted">tes</small>
                                                                </div> --}}
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
                        @if ($transaksi->lastPage() != 1)
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $transaksi->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $transaksi->lastPage(); $i++)
                                    <li class="page-item {{ $i == $transaksi->currentPage() ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ $transaksi->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $transaksi->nextPageUrl() }}">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        @endif

                        @if (count($transaksi) == 0)
                            <div class="text-center"> Tidak ada data!</div>
                        @endif

                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('modal')
    {{-- modal edit transaksi --}}
    <div class="modal fade" id="editTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // modal edit transaksi 
        $('.btn-edit').click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: `http://localhost:8000/transaksi/${id}/edit`,
                method: 'GET',
                success: function(data) {
                    $('#editTransaksi').find('.modal-body').html(data);
                    $('#editTransaksi').show();
                }
            });
        })
        // modal detail transaksi 
        $('.btn-detail').click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: `http://localhost:8000/transaksi/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#detailTransaksi').find('.modal-body').html(data);
                    $('#detailTransaksi').show();
                }
            });
        })

        //sweetalert delete
        function deleteTransaksi(id) {
            Swal.fire({
                title: 'PERINGATAN!',
                text: "Yakin ingin menghapus Transaksi?",
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
        $(document).ready(function() {



            //session success dan berhasil hapus
            let success = $('.success').data('flash');
            if (success) {
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: success,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            //session gagal meminjam
            let fail = $('.fail').data('flash');
            if (fail) {
                Swal.fire({
                    position: 'center',
                    type: 'warning',
                    title: fail,
                    showConfirmButton: true,
                    // timer: 2000
                });
            }
        })
    </script>
@endpush
