<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
      <div class="card-tools">
        <a href="<?= base_url('Wilayah/Input') ?>" class="btn btn-flat btn-primary btn-sm">
          <i class="fas fa-plus"></i> Tambah
        </a>
      </div>
    </div>
    <div class="card-body">

      <?php if (session()->getFlashdata('insert')): ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('insert') ?></h5>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('update')): ?>
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('update') ?></h5>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('delete')): ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('delete') ?></h5>
        </div>
      <?php endif; ?>

      <table id="example2" class="table table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th>Nama Wilayah</th>
            <th>Warna</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($wilayah as $value): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($value['nama_wilayah']) ?></td>
              <td style="background-color: <?= htmlspecialchars($value['warna']) ?>;"></td>
              <td class="text-center">
                <a href="<?= base_url('Wilayah/Edit/' . $value['id_wilayah']) ?>" class="btn btn-sm btn-warning btn-flat" title="Edit">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="<?= base_url('Wilayah/Delete/' . $value['id_wilayah']) ?>" onclick="return confirm('Yakin Hapus Data...?')" class="btn btn-sm btn-danger btn-flat" title="Hapus">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<div class="col-md-12">
  <div id="map" style="width: 100%; height: 600px;"></div>
</div>

<script>
  var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  });

  var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
  });

  var peta3 = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; OpenStreetMap contributors, SRTM | Map style &copy; OpenTopoMap (CC-BY-SA)'
  });

  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CartoDB',
    subdomains: 'abcd',
    maxZoom: 19
  });

  var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri — Source: Esri, Earthstar Geographics',
    maxZoom: 19
  });

  var peta6 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CartoDB',
    subdomains: 'abcd',
    maxZoom: 19
  });

  var map = L.map('map', {
    center: [<?= $web['coordinat_wilayah'] ?>],
    zoom: <?= $web['zoom_view'] ?>,
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

  <?php foreach ($wilayah as $value): ?>
    var geojsonData = <?= json_encode($value['geojson']) ?>;
    try {
      L.geoJSON(JSON.parse(geojsonData), {
        style: function (feature) {
          return {
            fillColor: '<?= $value['warna'] ?>',
            color: '<?= $value['warna'] ?>',
            weight: 1,
            opacity: 1,
            fillOpacity: 0.5
          };
        }
      })
      .bindPopup("<b><?= htmlspecialchars($value['nama_wilayah']) ?></b>")
      .addTo(map);
    } catch (error) {
      console.error("Error parsing GeoJSON for <?= htmlspecialchars($value['nama_wilayah']) ?>:", error);
    }
  <?php endforeach; ?>
</script>

<script>
  $(function () {
    $('#example2').DataTable({
      paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
    });
  });
</script>
