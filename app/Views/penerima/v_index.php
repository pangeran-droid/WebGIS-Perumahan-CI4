<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
      <div class="card-tools">
        <a href="Penerima/Input" class="btn btn-flat btn-primary btn-sm">
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

      <table id="example2" class="table table-sm table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th>Nama Penerima</th>
            <th>Nomor KTP</th>
            <th>Alamat</th>
            <th>Jenis Atap</th>
            <th>Jenis Dinding</th>
            <th>Jenis Lantai</th>
            <th>Keterangan</th>
            <th>Jenis Bantuan</th>
            <th>Foto Rumah</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($penerima as $value): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value['nama_penerima'] ?></td>
              <td class="text-center"><?= $value['nomor_ktp'] ?></td>
              <td><?= $value['alamat'] ?></td>
              <td class="text-center"><?= $value['jenis_atap'] ?></td>
              <td class="text-center"><?= $value['jenis_dinding'] ?></td>
              <td class="text-center"><?= $value['jenis_lantai'] ?></td>
              <td class="text-center"><?= $value['keterangan'] ?></td>
              <td class="text-center"><?= $value['jenis_bantuan'] ?></td>
              <td class="text-center">
                <img src="<?= base_url('foto/' . $value['foto']) ?>" width="150" height="100" alt="Foto Rumah">
              </td>
              <td class="text-center">
                <a href="<?= base_url('Penerima/Detail/' . $value['id_penerima']) ?>" class="btn btn-xs btn-success btn-flat">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="<?= base_url('Penerima/Edit/' . $value['id_penerima']) ?>" class="btn btn-xs btn-warning btn-flat">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="<?= base_url('Penerima/Delete/' . $value['id_penerima']) ?>" onclick="return confirm('Yakin Hapus Data...?')" class="btn btn-xs btn-danger btn-flat">
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

<script>
  $(function () {
    $("#example2").DataTable({
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
