@extends('layouts.main')

@section('main-content')
    <!-- navbar section -->
    @include('partials.navbar')


    <div class="d-flex justify-content-center py-4">
        <div class="py-1">
          <h3>Buku Yang diajukan pinjam</h3>
        </div>
        
      </div>
      <div class="container">
          <div class="table-responsive">
              <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                      <tr>
                          <th scope="col" class="sort" data-sort="Judul">Kode Transaksi</th>
                          <th scope="col" class="sort" data-sort="Judul">Judul</th>
                          <th scope="col" class="sort" data-sort="Penulis">Penulis</th>
                          <th scope="col" class="sort" data-sort="Penerbit">No eksemplar</th>
                          <th scope="col" class="sort" data-sort="Stok">Tanggal pinjam</th>
                          <th scope="col" class="sort" data-sort="Stok">Tanggal kembali</th>
                          <th scope="col"></th>
                      </tr>
                  </thead>
                  <tbody class="list">
                      @foreach ($transaksi_pending as $item)
                          <tr>
                              <td>
                                  {{ $item->kode_transaksi }}
                              </td>
                              <th scope="row">
                                  <div class="media align-items-center">
                                      <div class="media-body">
                                          <span class="name mb-0 text-sm">{{ $item->koleksi->biblio->judul }}</span>
                                      </div>
                                  </div>
                              </th>
                              <td class="budget">
                                  {{ $item->koleksi->biblio->penulis }}
                              </td>
                              <td>
                                  {{ $item->koleksi->kode_eksemplar }}
                              </td>
                              <td>
                                  {{ $item->tgl_pinjam }}
                              </td>
                              <td>
                                  {{ $item->tgl_kembali }}
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
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
      </div>

    <div class="d-flex justify-content-center py-4">
      <div class="py-1">
        <h3>Buku Yang dipinjam</h3>
      </div>
      
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="Judul">Kode Transaksi</th>
                        <th scope="col" class="sort" data-sort="Judul">Judul</th>
                        <th scope="col" class="sort" data-sort="Penulis">Penulis</th>
                        <th scope="col" class="sort" data-sort="Penerbit">No eksemplar</th>
                        <th scope="col" class="sort" data-sort="Stok">Tanggal pinjam</th>
                        <th scope="col" class="sort" data-sort="Stok">Tanggal kembali</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>
                                {{ $item->kode_transaksi }}
                            </td>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{ $item->koleksi->biblio->judul }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="budget">
                                {{ $item->koleksi->biblio->penulis }}
                            </td>
                            <td>
                                {{ $item->koleksi->kode_eksemplar }}
                            </td>
                            <td>
                                {{ $item->tgl_pinjam }}
                            </td>
                            <td>
                                {{ $item->tgl_kembali }}
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
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
    </div>

    <!-- footer section  -->
    @include('partials.footer')
@endsection
