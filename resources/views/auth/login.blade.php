<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{ $title }}</title>
</head>

<body>
    <nav class="bg-dark container-xxl bd-gutter flex-wrap flex-lg-nowrap">
        <div class="p-3 nav-wrapper overflow-visible d-flex justify-content-between" id="navbar">
            <a class='text-decoration-none' href="{{ route('index') }}">
                <h1 class='fs-3 text-light'>Ammar Digital Library</h1>
            </a>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex align-items-center">
                    <h2 class="mr-auto">Masuk</h2>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Belum punya akun? <a href="{{ route('register') }}"
                                class="text-decoration-none text-primary">Buat sekarang</a></p>
                    </div>
                    <button type="submit" class="btn btn-dark mb-2">Masuk</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>