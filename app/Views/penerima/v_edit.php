<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
    </div>
    <div class="card-body">
      <?php
      session();
      $validation = \Config\Services::validation();
      ?>

      <?= form_open_multipart('Penerima/UpdateData/' . $penerima['id_penerima']) ?>
      <input type="hidden" name="fotoLama" value="<?= $penerima['foto'] ?>">

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Nama Penerima</label>
          <input name="nama_penerima" value="<?= old('nama_penerima', $penerima['nama_penerima']) ?>" class="form-control">
          <p class="text-danger"><?= $validation->getError('nama_penerima') ?></p>
        </div>
        <div class="col-md-6 mb-3">
          <label>Nomor KTP</label>
          <input name="nomor_ktp" value="<?= old('nomor_ktp', $penerima['nomor_ktp']) ?>" class="form-control">
          <p class="text-danger"><?= $validation->getError('nomor_ktp') ?></p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label>Jenis Atap</label>
          <select name="jenis_atap" class="form-control">
            <option value="">--Pilih Jenis Atap--</option>
            <?php
            $jenis_atap_options = ['Genteng', 'Seng', 'Asbes', 'Polycarbonate', 'Metal Roof'];
            foreach ($jenis_atap_options as $option) {
              $selected = old('jenis_atap', $penerima['jenis_atap']) == $option ? 'selected' : '';
              echo "<option value=\"$option\" $selected>$option</option>";
            }
            ?>
          </select>
          <p class="text-danger"><?= $validation->getError('jenis_atap') ?></p>
        </div>
        <div class="col-md-4 mb-3">
          <label>Jenis Dinding</label>
          <select name="jenis_dinding" class="form-control">
            <option value="">--Pilih Jenis Dinding--</option>
            <?php
            $jenis_dinding_options = ['Tembok', 'Kayu', 'GRC', 'Triplek', 'Bata Ringan'];
            foreach ($jenis_dinding_options as $option) {
              $selected = old('jenis_dinding', $penerima['jenis_dinding']) == $option ? 'selected' : '';
              echo "<option value=\"$option\" $selected>$option</option>";
            }
            ?>
          </select>
          <p class="text-danger"><?= $validation->getError('jenis_dinding') ?></p>
        </div>
        <div class="col-md-4 mb-3">
          <label>Jenis Lantai</label>
          <select name="jenis_lantai" class="form-control">
            <option value="">--Pilih Jenis Lantai--</option>
            <?php
            $jenis_lantai_options = ['Keramik', 'Tanah', 'Semen', 'Granit', 'Marmer', 'Parquet', 'Vinyl'];
            foreach ($jenis_lantai_options as $option) {
              $selected = old('jenis_lantai', $penerima['jenis_lantai']) == $option ? 'selected' : '';
              echo "<option value=\"$option\" $selected>$option</option>";
            }
            ?>
          </select>
          <p class="text-danger"><?= $validation->getError('jenis_lantai') ?></p>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label>Keterangan</label>
          <select name="id_keterangan" class="form-control">
            <option value="">--Pilih Keterangan--</option>
            <?php foreach ($keterangan as $k) { ?>
              <option value="<?= $k['id_keterangan'] ?>" <?= old('id_keterangan', $penerima['id_keterangan']) == $k['id_keterangan'] ? 'selected' : '' ?>>
                <?= $k['keterangan'] ?>
              </option>
            <?php } ?>
          </select>
          <p class="text-danger"><?= $validation->getError('id_keterangan') ?></p>
        </div>
        <div class="col-md-6 mb-3">
            <label>Jenis Bantuan</label>
            <input name="jenis_bantuan" value="<?= old('jenis_bantuan', $penerima['jenis_bantuan']) ?>" class="form-control">
            <p class="text-danger"><?= $validation->getError('jenis_bantuan') ?></p>
          </div>
      </div>

      <div class="form-group mb-3">
        <label>Koordinat Rumah</label>
        <div id="map" style="width: 100%; height: 400px;"></div>
        <input name="coordinat" id="Coordinat" value="<?= old('coordinat', $penerima['coordinat']) ?>" class="form-control" readonly>
        <p class="text-danger"><?= $validation->getError('coordinat') ?></p>
      </div>

      <div class="row">
        <div class="col-sm-4 mb-3">
          <label>Provinsi</label>
          <select name="id_provinsi" id="id_provinsi" class="form-control select2">
            <option value="">--Pilih Provinsi--</option>
            <?php foreach ($provinsi as $prov) { ?>
              <option value="<?= $prov['id_provinsi'] ?>" <?= $prov['id_provinsi'] == $penerima['id_provinsi'] ? 'selected' : '' ?>>
                <?= $prov['nama_provinsi'] ?>
              </option>
            <?php } ?>
          </select>
          <p class="text-danger"><?= $validation->getError('id_provinsi') ?></p>
        </div>
        <div class="col-sm-4 mb-3">
          <label>Kabupaten</label>
          <select name="id_kabupaten" id="id_kabupaten" class="form-control select2">
            <option value="<?= $penerima['id_kabupaten'] ?>"><?= $penerima['nama_kabupaten'] ?></option>
          </select>
          <p class="text-danger"><?= $validation->getError('id_kabupaten') ?></p>
        </div>
        <div class="col-sm-4 mb-3">
          <label>Kecamatan</label>
          <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
            <option value="<?= $penerima['id_kecamatan'] ?>"><?= $penerima['nama_kecamatan'] ?></option>
          </select>
          <p class="text-danger"><?= $validation->getError('id_kecamatan') ?></p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 mb-3">
          <label>Alamat</label>
          <input name="alamat" value="<?= old('alamat', $penerima['alamat']) ?>" class="form-control">
          <p class="text-danger"><?= $validation->getError('alamat') ?></p>
        </div>
        <div class="col-md-4 mb-3">
          <label>Wilayah Administrasi</label>
          <select name="id_wilayah" class="form-control">
            <option value="">--Pilih Wilayah Administrasi--</option>
            <?php foreach ($wilayah as $w) { ?>
              <option value="<?= $w['id_wilayah'] ?>" <?= $w['id_wilayah'] == $penerima['id_wilayah'] ? 'selected' : '' ?>>
                <?= $w['nama_wilayah'] ?>
              </option>
            <?php } ?>
          </select>
          <p class="text-danger"><?= $validation->getError('id_wilayah') ?></p>
        </div>
      </div>

      <div class="mb-3">
        <label>Foto Rumah (kosongkan jika tidak ingin diganti)</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <p class="text-danger"><?= $validation->getError('foto') ?></p>
        <img src="<?= base_url('foto/' . $penerima['foto']) ?>" alt="foto rumah" width="100" class="mt-2">
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="<?= base_url('Penerima') ?>" class="btn btn-success">Kembali</a>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script>
  $('.select2').select2();
  $('#id_provinsi').change(function () {
    $.post("<?= base_url('Penerima/Kabupaten') ?>", { id_provinsi: $(this).val() }, function (data) {
      $('#id_kabupaten').html(data);
    });
  });
  $('#id_kabupaten').change(function () {
    $.post("<?= base_url('Penerima/Kecamatan') ?>", { id_kabupaten: $(this).val() }, function (data) {
      $('#id_kecamatan').html(data);
    });
  });

  // Leaflet map init
  var map = L.map('map').setView([<?= $web['coordinat_wilayah'] ?>], <?= $web['zoom_view'] ?>);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
  }).addTo(map);

  var koordinat = "<?= old('coordinat', $penerima['coordinat']) ?>".split(',');
  var marker = L.marker(koordinat, { draggable: true }).addTo(map);
  marker.on('dragend', function (e) {
    var pos = marker.getLatLng();
    $('#Coordinat').val(pos.lat + "," + pos.lng);
  });
  map.on('click', function (e) {
    marker.setLatLng(e.latlng);
    $('#Coordinat').val(e.latlng.lat + "," + e.latlng.lng);
  });
</script>
