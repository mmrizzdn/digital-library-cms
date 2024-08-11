@extends('layouts.dashboard')

@section('container')
    <div style="padding-left: 280px; width: 100%;">
        <div class="flex-grow-1">
            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <div class="">
                        <h1 class="fs-3"><strong>Content Management System</strong></h1>
                    </div>
                </div>
            </nav>

            {{-- Content --}}
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-3 mt-3 mb-3 border-bottom">
                <div class="p-4">
                    <h1 class="h3 mb-2">Halo, {{ auth()->user()->name }}</h1>
                    <p>Selamat datang di CMS kamu!</p>
                </div>

                <div class="buttons">
                    <!-- Add book -->
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addBook">
                        Tambah Buku
                    </button>

                    <div class="modal fade" id="addBook" tabindex="-1" aria-labelledby="addBook" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                @if ($errors->any())
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var myModal = new bootstrap.Modal(document.getElementById('addBook'));
                                            myModal.show();
                                        });
                                    </script>
                                @endif
                                <form action="{{ route('add.book') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addBook">Tambah Buku</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="title">Judul</label>
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                                    name="title" value="{{ old('title') }}" required>
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="category_id">Kategori</label>
                                                <select class="form-select" id="category_id" name="category_id"
                                                    aria-label="select-category" required>
                                                    <option value="" selected>Pilih Kategori</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="cover" class="form-label">Sampul</label>
                                                <input class="form-control @error('cover') is-invalid @enderror"
                                                    type="file" id="cover" name="cover" accept="image/*" required>
                                                @error('cover')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="description">Deskripsi</label>
                                                <input type="text"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    id="description" name="description" value="{{ old('description') }}"
                                                    required>
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="amount">Jumlah</label>
                                                <input type="number"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="amount" name="amount" value="{{ old('amount') }}" required>
                                                @error('amount')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="file" class="form-label">File</label>
                                                <input class="form-control @error('file') is-invalid @enderror"
                                                    type="file" id="file" name="file" accept="application/pdf"
                                                    required>
                                                @error('file')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @if (auth()->user()->role === 'admin')
                                                <div class="form-group mb-3">
                                                    <label for="user_id">User</label>
                                                    <select class="form-select" id="user_id" name="user_id"
                                                        aria-label="select-user" required>
                                                        <option value="" selected>Pilih User</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}"
                                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-dark">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Add category --}}
                    @if (auth()->user()->role === 'admin')
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addCategory">
                            Tambah Kategori
                        </button>
                        <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategory"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('add.category') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="addCategory">Tambah Kategori</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="name">Nama</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name" name="name" value="{{ old('name') }}"
                                                        required>
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-dark">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div class="d-flex px-3 my-2 column-gap-3 justify-content-between">
                <div class="d-flex">
                    <form method="GET" action="{{ route('dashboard.index') }}">
                        <div class="form-group mb-3">
                            <label for="category">Filter Berdasarkan Kategori</label>
                            <select id="category" name="category" class="form-select"
                                style="min-width:200px; width: auto;">
                                <option value="">Semua</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark text-light">Filter</button>
                    </form>
                    @if (auth()->user()->role === 'admin')
                        <div class="mx-2">
                            <button type="button" class="btn btn-dark w-auto" data-bs-toggle="modal"
                                data-bs-target="#updateCategory">
                                Update Kategori
                            </button>
                            <div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="updateCategory"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('update.category') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="updateCategory">Update Kategori</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="id">Kategori</label>
                                                        <select class="form-select" id="id" name="id"
                                                            aria-label="select-category" required>
                                                            <option value="" selected>Pilih Kategori</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ old('id') == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="name">Kategori Baru</label>
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name" value="{{ old('name') }}"
                                                            required>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-dark">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger w-auto" data-bs-toggle="modal"
                                data-bs-target="#deleteCategory">
                                Hapus Kategori
                            </button>
                            <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="deleteCategory"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('delete.category') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteCategory">Hapus Kategori</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="id">Kategori</label>
                                                        <select class="form-select" id="id" name="id"
                                                            aria-label="select-category" required>
                                                            <option value="" selected>Pilih Kategori</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ old('id') == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-dark">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col d-flex justify-content-end align-items-end">
                    <a href="{{ route('export.book') }}" class="btn btn-dark text-light w-auto flex-end">Expor ke
                        Excel</a>
                </div>
            </div>
            <div class="table-wrapper px-3 mx-3 mb-3 border border-dark-subtle rounded">
                <table class="table table-hover">
                    <thead class="table">
                        <tr>
                            <th class="text-center" scope="col">No.</th>
                            <th class="text-center" scope="col">Judul</th>
                            <th class="text-center" scope="col">Kategori</th>
                            <th class="text-center" scope="col">Cover</th>
                            <th class="text-center" scope="col">Deskripsi</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">File</th>
                            @if (auth()->user()->role === 'admin')
                                <th class="text-center" scope="col">Oleh</th>
                            @endif
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $book->title }}</td>
                                <td class="text-center">{{ $book->category->name }}</td>
                                <td class="text-center"><img width="100px"
                                        src="{{ url('') }}/{{ $book->cover }}" class="rounded"
                                        alt="{{ $book->title }}">
                                </td>
                                <td class="text-center">{{ $book->description }}</td>
                                <td class="text-center">{{ $book->amount }}</td>
                                <td class="text-center"><a
                                        href="{{ url('') }}/{{ $book->file }}">{{ $book->title }}.pdf</a>
                                </td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="text-center">{{ $book->user->name }}</td>
                                @endif
                                <td>
                                    <div class="buttons d-flex justify-content-evenly">
                                        <button class="view btn btn-dark m-1" data-bs-toggle="modal"
                                            data-bs-target="#updateBook"><i class="bi bi-pencil-fill"></i></button>
                                        <div class="modal fade" id="updateBook" tabindex="-1"
                                            aria-labelledby="updateBook" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('update.book', $book->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="addBook">Update Buku</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <div class="form-group mb-3">
                                                                    <label for="title">Judul</label>
                                                                    <input type="text"
                                                                        class="form-control @error('title') is-invalid @enderror"
                                                                        id="title" name="title"
                                                                        value="{{ $book->title ?? old('title') }}">
                                                                    @error('title')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="category_id">Kategori</label>
                                                                    <select class="form-select" id="category_id"
                                                                        name="category_id" aria-label="select-category">
                                                                        <option value="{{ $book->category->id }}"
                                                                            selected>Pilih Kategori
                                                                        </option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}"
                                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                                {{ $category->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('category_id')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="cover"
                                                                        class="form-label">Sampul</label>
                                                                    <input
                                                                        class="form-control @error('cover') is-invalid @enderror"
                                                                        type="file" id="cover" name="cover"
                                                                        accept="image/*">
                                                                    @error('cover')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="description">Deskripsi</label>
                                                                    <input type="text"
                                                                        class="form-control @error('description') is-invalid @enderror"
                                                                        id="description" name="description"
                                                                        value="{{ $book->description ?? old('description') }}">
                                                                    @error('description')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="amount">Jumlah</label>
                                                                    <input type="number"
                                                                        class="form-control @error('amount') is-invalid @enderror"
                                                                        id="amount" name="amount"
                                                                        value="{{ $book->amount ?? old('amount') }}">
                                                                    @error('amount')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="file" class="form-label">File</label>
                                                                    <input
                                                                        class="form-control @error('file') is-invalid @enderror"
                                                                        type="file" id="file" name="file"
                                                                        accept="application/pdf">
                                                                    @error('file')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-dark">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('delete.book', $book->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger m-1"><i
                                                    class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
