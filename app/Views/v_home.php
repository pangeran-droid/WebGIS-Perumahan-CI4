<div class="container">
  <!-- Hero Section -->
  <div class="hero-section text-center py-5">
    <h1 class="display-4"><strong><?= esc($web['nama_web']) ?></strong></h1>
    <p class="lead mt-3">
      Sistem Informasi Geografis untuk Pendataan Rumah Penerima Bantuan Pemerintah
    </p>
    <a href="<?= base_url('Auth/Login') ?>" class="btn btn-light btn-lg mt-4">
      <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Sistem
    </a>
  </div>

  <!-- Feature Cards -->
  <div class="row features text-center">
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fas fa-map-marked-alt fa-2x mb-2 text-indigo"></i>
          <h5 class="card-title">Pemetaan</h5>
          <p class="card-text">Lihat sebaran lokasi penerima bantuan secara geografis.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fas fa-search-location fa-2x mb-2 text-indigo"></i>
          <h5 class="card-title">Pencarian</h5>
          <p class="card-text">Cari lokasi bantuan berdasarkan nama atau wilayah.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fas fa-info-circle fa-2x mb-2 text-indigo"></i>
          <h5 class="card-title">Informasi Detail</h5>
          <p class="card-text">Dapatkan informasi lengkap tentang penerima bantuan.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fas fa-chart-pie fa-2x mb-2 text-indigo"></i>
          <h5 class="card-title">Analisis Data</h5>
          <p class="card-text">Bantu analisis dan pengambilan keputusan berbasis peta.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Peta -->
  <div class="mt-5">
    <h4 class="mb-3">Persebaran Lokasi Penerima Bantuan</h4>
    <div id="map"></div>
  </div>
</div>

<!-- Leaflet Map Script -->
<script>
  var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  });

  var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team'
  });

  var peta3 = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data: &copy; OpenStreetMap contributors, SRTM | Map style: &copy; OpenTopoMap (CC-BY-SA)'
  });

  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; CartoDB',
      subdomains: 'abcd',
      maxZoom: 19
  });

  var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
      attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Earthstar Geographics',
      maxZoom: 19
  });

  var peta6 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; CartoDB',
      subdomains: 'abcd',
      maxZoom: 19
  });

  var map = L.map('map', {
      center: [-2.5489, 118.0149],
      zoom: 5,
      layers: [peta1]
  });

  var baseMaps = {
      'Streets': peta1,
      'OpenStreetMap.HOT': peta2,
      'OpenTopoMap': peta3,
      'Carto Light': peta4,
      'Esri Satellite': peta5,
      'Carto Dark': peta6
  };

  L.control.layers(baseMaps).addTo(map);

  <?php foreach ($penerima as $row): 
      $coords = explode(',', $row['coordinat']);
      $lat = trim($coords[0]);
      $lng = trim($coords[1]);
  ?>
      L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map)
          .bindPopup(`<b><?= esc($row['nama_penerima']) ?></b><br><?= esc($row['alamat']) ?><br><?= esc($row['keterangan']) ?>`);
  <?php endforeach; ?>
</script>
