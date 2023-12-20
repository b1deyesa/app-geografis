<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistem Informasi Geografis</title>
  <link rel="stylesheet" href="{{ asset('css/tambah-umkm.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
        <div class="container py-2">
            <a class="navbar-brand" href="{{ route('index') }}"><img width="60" src="{{ asset('img/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->role == 'admin')
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @endif
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('umkm-tambah') }}">Tambah UMKM</a>
                    </li>
                @endauth
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                </li>
                @guest
                <li class="nav-item mx-2">
                    <a class="nav-link px-3 bg-info rounded-pill" href="{{ route('login-regist') }}">Login / Regist</a>
                </li>
                @endguest
                @auth
                    <li class="nav-item mx-2">
                    <a class="nav-link px-3 bg-danger text-light rounded-pill" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container col-md-5 mt-5">
        <a href="{{ route('index') }}" class="btn btn-outline-secondary m-0 mb-5">< Kembali</a>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        
        @if(session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{ session()->get('success') }}
            </div>
        </div>
        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            Tunggu beberapa saat, data akan dikonfirmasi oleh admin.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        
        <form method="POST" action="{{ route('umkm-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col mb-3">
                <label for="nama_umkm" class="form-label">Nama UMKM</label>
                <input type="text" id="nama_umkm" name="nama_umkm" class="form-control @error('nama_umkm') is-invalid @enderror" value="{{ old('nama_umkm') }}">
                @error('nama_umkm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col mb-3">
                <label for="pemilik_umkm" class="form-label">Pemilik UMKM</label>
                <input type="text" id="pemilik_umkm" name="pemilik_umkm" class="form-control @error('pemilik_umkm') is-invalid @enderror" value="{{ old('pemilik_umkm') }}">
                @error('pemilik_umkm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}">
                @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col mb-3">
                <label for="alamat_umkm" class="form-label">Alamat UMKM</label>
                <input type="text" id="alamat_umkm" name="alamat_umkm" class="form-control @error('alamat_umkm') is-invalid @enderror" value="{{ old('alamat_umkm') }}">
                @error('alamat_umkm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" id="longitude" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}">
                @error('longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}">
                @error('latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>        
            <div class="col mb-3">
                <label for="gambar" class="form-label">Pilih Gambar:</label>
                <input class="form-control" type="file" id="gambar" name="gambar" value="{{ old('gambar') }}">
                @error('gambar')
                    <div class="invalid-feedback">error</div>
                @enderror
            </div>
            <div class="col mt-4">
                <button type="submit" class="btn btn-primary float-end">Tambah</button>
            </div>
            <br><br><br><br>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>