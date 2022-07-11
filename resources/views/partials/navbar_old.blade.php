<nav class="navbar navbar-expand-md mb-5 py-3 px-5" style="background-color: #5B5EA6;">
    <div class="container-fluid">
        <div class="logo">
			<a class="navbar-brand" href="#"><img src="" alt="RentX" class="ms-4"></a>
		</div>

        <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
            <a class="nav-link text-dark" href="/">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-dark" href="#">Link</a>
            </li>
        </ul>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light me-2">Logout</button>
        </form>
        </div>
    </div>
</nav>
