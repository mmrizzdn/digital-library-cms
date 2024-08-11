<nav class="d-flex flex-column flex-shrink-0 p-3 bg-dark fixed-top" style="width: 280px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">{{ $sideBar }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-white active">
                <i class="bi bi-speedometer"></i>
                Dashboard
            </a>
        </li>
    </ul>
    <hr>
    @auth
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/40" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong>{{ auth()->user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item btn">
                            <a class="text-decoration-none text-light">Logout</a>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @endauth
</nav>
