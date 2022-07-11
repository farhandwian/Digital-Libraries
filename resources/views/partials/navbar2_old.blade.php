<nav class="navbar navbar-expand-md py-3 px-5" style="background-color: #5B5EA6;">
    <div class="container-fluid">
		<div class="logo">
			<a class="navbar-brand" href="/"><img src="/img/logo.png" alt="RentX" class="ms-4" height="30"></a>
		</div>

		<div class="collapse navbar-collapse" id="navbarsExample04">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">
				<li class="nav-item">
					<a class="nav-link text-white" href="/">Home</a>
				</li>
			</ul>
            @auth
			<div class="dropdown">
				<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
					data-bs-toggle="dropdown" aria-expanded="false">
					<strong>Welcome back, {{ auth()->user()->name }}!</strong>
				</a>
				<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
					<!-- disini pake if buyer atau seller bro -->
                    @if (auth()->user()->level === 'admin')
                        <li><a class="dropdown-item" href="#">Dashboard Admin</a></li>
                    @else
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        @if (auth()->user()->level === 'user')
                            <li><a class="dropdown-item" href="#">Dashboard Seller</a></li>
                        @endif
                    @endif
					<li>
						<hr class="dropdown-divider">
					</li>
					<li>
						{{-- <form action="/logout" method="post">
							@csrf
							<button type="submit" class="dropdown-item">Logout</button>
						</form> --}}
					</li>
				</ul>
			</div>
            @else
			<a href="#"><button type="button" class="btn btn-info me-3">Login</button></a>
			<a href="#"><button type="button" class="btn btn-outline-light">Register</button></a>
            @endauth
		</div>
    </div>
</nav>
