<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistem Informasi Geografis</title>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
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

    <div id='map'></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script>
        let map, markers = [];
        function initMap() {
            map = L.map('map', {
                center: {
                    lat: -6.2297465,
                    lng: 106.829518,
                },
                zoom: 18
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            map.on('click', mapClicked);
            initMarkers();
        }
        initMap();
        function initMarkers() {
            const initialMarkers = <?php echo json_encode($marker); ?>;

            for (let index = 0; index < initialMarkers.length; index++) {

                const data = initialMarkers[index];
                const marker = generateMarker(data, index);
                marker.addTo(map).bindPopup(
                    `<h6>${data.umkm.nama}</h6>
                    <img src="{{ asset('img/umkm/${data.umkm.gambar}') }}" width=100>
                    <br>
                    <b>${data.umkm.pemilik}</b>
                    <small>${data.umkm.telp}</small>`
                    );
                map.panTo(data.position);
                markers.push(marker)
            }
        }
        function generateMarker(data, index) {
            return L.marker(data.position, {
                    draggable: data.draggable
                })
                .on('click', (event) => markerClicked(event, index))
                .on('dragend', (event) => markerDragEnd(event, index));
        }
        function mapClicked($event) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }
        function markerClicked($event, index) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }
        function markerDragEnd($event, index) {
            console.log(map);
            console.log($event.target.getLatLng());
        }
    </script>
</body>
</html>