<div class="col-3 p-3">
    <!-- identity section -->
    <div class="row mb-3">
        <div class="col">
            <img src="{{asset('/template/img/blank-profile-picture.png')}}" class="rounded img-fluid" alt="Avatar">
        </div>
        <div class="col">
            <div class="row mt-1">
                <p class="fw-bold mb-0">{{ auth()->user()->name }}</p>
                <p class="">{{ auth()->user()->email }}</p>
            </div>
            <div class="row-1">
                <a href="#"><button class="btn btn-outline-primary">Edit Profile</button></a>
            </div>
        </div>
    </div>
    <!-- option section -->
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-house"></i>
        </div>
        <div class="col">
            <a href="{{route('dashboardUser.index')}}" class="text-black" style="text-decoration: none;"><p>Buku Yang Dipinjam</p></a>
        </div>
    </div>
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div class="col">
            <a href="{{route('dashboardUser.ajukanPinjam')}}" class="text-black" style="text-decoration: none;"><p>Buku Yang Diajukan Pinjam</p></a>
        </div>
    </div>
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div class="col">
            <a href="{{route('dashboardUser.riwayat')}}" class="text-black" style="text-decoration: none;"><p>Riwayat Peminjaman</p></a>
        </div>
    </div>
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <div class="col">
            <a href="#" class="text-black" style="text-decoration: none;"><p>Favorit</p></a>
        </div>
    </div>
</div>
