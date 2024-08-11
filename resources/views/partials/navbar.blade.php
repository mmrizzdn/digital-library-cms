<!-- Navigation Bar -->
<nav class="bg-dark container-xxl bd-gutter flex-wrap flex-lg-nowrap">
    <div class="p-3 nav-wrapper overflow-visible d-flex justify-content-between" id="navbar">
        <a class='text-decoration-none' href="{{ route('index') }}">
            <h1 class='fs-3 text-light'>Ammar Digital Library</h1>
        </a>

        <div class="menu-toggle bs justify-content-between d-flex column-gap-4 align-items-center">
            @auth
                <div class="menu-wrapper d-flex p-0 m-0">
                    <ul class="menu d-flex column-gap-5 align-items-center p-0 m-0">
                        <li class="menu-item">
                            <a class="text-light text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown-center position-relative">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fa-solid fa-user me-2"></i>Hi,
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu bg-dark">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-light"><i
                                        class="fa-solid fa-right-from-bracket me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="text-light text-decoration-none" href="{{ route('login.index') }}">Login</a>
                <a class="text-light text-decoration-none" href="{{ route('register.index') }}">Register</a>
            @endauth
        </div>
    </div>
</nav>
