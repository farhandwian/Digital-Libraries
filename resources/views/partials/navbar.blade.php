 <!-- Start Top Nav -->
 <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-block" style="background-color:#5B5EA6;"
     id="templatemo_nav_top">
     <div class="container text-light">
         <div class="w-100 d-flex justify-content-between">
             <div>
                 <i class="fa fa-envelope mx-2"></i>
                 <a class="navbar-sm-brand text-light text-decoration-none"
                     href="mailto:info@company.com">info@company.com</a>
                 <i class="fa fa-phone mx-2"></i>
                 <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
             </div>
             <div>
                 <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                         class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                 <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                         class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                 <a class="text-light" href="https://twitter.com/" target="_blank"><i
                         class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                 <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                         class="fab fa-linkedin fa-sm fa-fw"></i></a>
             </div>
         </div>
     </div>
 </nav>
 <!-- Close Top Nav -->


 <!-- Header -->
 <nav class="navbar navbar-expand-lg navbar-light shadow">
     <div class="container d-flex justify-content-between align-items-center">

         <a class="navbar-brand logo h1 align-self-center" href="/" style="color:#5B5EA6;">
             <img src="{{ asset('template/img/brand/logo.png') }}" alt="" width="70px" height="70px">
             DL
         </a>

         <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
             data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
             aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
             id="templatemo_main_nav">
             <div class="flex-fill">
                 <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                     <li class="nav-item">
                         <a class="nav-link" href="/" style=":hover{color:red;}">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="about.html">About</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="/search">Buku</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="contact.html">Contact</a>
                     </li>
                 </ul>
             </div>
             <div class="navbar align-self-center d-flex">
                 <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                     <div class="input-group">
                         <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                         <div class="input-group-text">
                             <i class="fa fa-fw fa-search"></i>
                         </div>
                     </div>
                 </div>

                 {{-- <a class="nav-icon position-relative text-decoration-none" href="#">
                     <i class="fa fa-fw fa-user text-dark mr-3"></i>
                     <span
                         class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                 </a> --}}

                 @auth
                     <div class="dropdown">
                         <a href="" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle"
                             id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                             <strong>Welcome back, {{ auth()->user()->name }}!</strong>
                         </a>
                         <ul class="dropdown-menu dropdown-menu-white text-black text-small shadow" aria-labelledby="dropdownUser1">
                             <!-- disini pake if buyer atau seller bro -->
                             @if (auth()->user()->level === 'admin')
                                 <li><a class="dropdown-item" href="/dashboard">Dashboard Admin</a></li>
                             @elseif(auth()->user()->level === 'user' && App\Http\Controllers\AnggotaController::checkAnggota())
                                 <li><a class="dropdown-item" href="{{route('dashboardUser.index')}}">Dashboard</a></li>
                             @endif
                             <li>
                                 <hr class="dropdown-divider">
                             </li>
                             <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                             </li>
                         </ul>
                     </div>
                 @else
                     <a href="/login"><button type="button" class="btn btn-info me-3">Login</button></a>
                     <a href="/register"><button type="button" class="btn btn-outline-info">Register</button></a>
                 @endauth
             </div>
         </div>

     </div>
 </nav>
 <!-- Close Header -->
