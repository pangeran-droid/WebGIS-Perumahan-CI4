<!-- Small boxes (Stat box) -->
<div class="col-lg-3 col-3">
  <div class="small-box" style="background-color: indigo; color: #FFFFFF;">
    <div class="inner">
      <h3><?= $jumlahpenerima ?></h3>
      <p>Penerima Bantuan</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="<?= base_url('Penerima') ?>" class="small-box-footer" style="color: #f8f9fa;">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-3">
  <div class="small-box" style="background-color: teal; color: #FFFFFF;">
    <div class="inner">
      <h3><?= $jumlahwilayah ?></h3>
      <p>Wilayah</p>
    </div>
    <div class="icon">
      <i class="fas fa-map-marked-alt"></i>
    </div>
    <a href="<?= base_url('Wilayah') ?>" class="small-box-footer" style="color: #f8f9fa;">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<?php
$db = \Config\Database::connect();
foreach ($keterangan as $key => $value) {
  $jumlah = $db->table('tbl_penerima')
               ->where('id_keterangan', $value['id_keterangan'])
               ->countAllResults();
?>
  <div class="col-lg-3 col-3">
    <div class="small-box 
      <?php 
        if ($value['id_keterangan'] == 1) {
          echo 'bg-success';
        } elseif ($value['id_keterangan'] == 2) {
          echo 'bg-danger';
        } 
      ?>">
      <div class="inner">
        <h3><?= $jumlah ?></h3>
        <p><?= $value['keterangan'] ?></p>
      </div>
      <div class="icon">
        <?php if ($value['id_keterangan'] == 1) { ?>
          <i class="fas fa-check"></i>
        <?php } elseif ($value['id_keterangan'] == 2) { ?>
          <i class="fas fa-times"></i>
        <?php } ?>
      </div>
      <a href="#" class="small-box-footer" style="color: #FFFFFF;">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
<?php } ?>
