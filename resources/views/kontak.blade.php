<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistem Informasi Geografis</title>
  <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
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

  <div class="kontak">
    <h2>Hubungin Kontak</h2>
    <p>Jika ada kendala / pertanyaan dapat hubungin kontak dibawah</p>
  </div>

  <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
    <div class="card-header">
      Admin 1
    </div>
    <div class="card-body">
      <h5 class="card-title"><a href="https://www.youtube.com/">Whatsapp Admin 1</a></h5>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>