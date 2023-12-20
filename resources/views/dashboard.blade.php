<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistem Informasi Geografis</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.7/datatables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
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
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('dashboard') }}">Verifikasi</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('umkm') }}">UMKM</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link px-3 bg-danger text-light rounded-pill" href="{{ route('logout') }}">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <table id="example" class="table table-striped-row table-bordered text-1" style="width: 100%; font-size: .75em">
      <thead class="align-middle table-info">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Map</th>
          <th class="text-center">Nama UMKM</th>
          <th class="text-center">Longitude, Latitude</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody class="align-middle">
        @foreach ($umkms as $key => $value)
        <tr>
          <td class="text-center">{{ $key + 1 }}</td>
          <td class="text-center" style="max-width: 90px"><iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d3966.8114728448813!2d{{ $value->longitude }}!3d{{ $value->latitude }}!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMDknMjEuNiJTIDEwNsKwNDknNTUuMCJF!5e0!3m2!1sid!2sid!4v1700117863892!5m2!1sid!2sid" width="200" height="80" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td>
          <td>{{ $value->nama_umkm }}</td>
          <td>{{ $value->longitude }}, {{ $value->latitude }}</td>
          <td class="text-center align-middle 
          @if($value->status == 'pending')
            text-warning
          @elseif($value->status == 'accepted')
            text-success
          @endif
          ">{{ $value->status }}</td>
          <td class="text-center">
            <div class="d-flex gap-1 justify-content-center">
              @if($value->status == 'pending')
                <a href="{{ route('umkm-delete', ['umkm' => $value]) }}" class="btn btn-danger px-2 py-0" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-xmark"></i></a>
                <a href="{{ route('umkm-accepted', ['umkm' => $value]) }}" class="btn btn-success px-2 py-0"><i class="fa-solid fa-check"></i></a>
              @elseif($value->status == 'accepted')
                <a href="{{ route('umkm-pending', ['umkm' => $value]) }}" class="btn btn-warning px-2 py-0"><i class="text-white fa-regular fa-clock"></i></a>
              @endif
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.7/datatables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <script src="https://kit.fontawesome.com/4419d23bf4.js" crossorigin="anonymous"></script>
  <script>
    new DataTable('#example');
  </script>
</body>
</html>