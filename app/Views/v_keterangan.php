<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            //notif insert data
            if (session()->getFlashdata('insert')) {
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('insert');
                echo '</h5></div>';
            }

            //notif update data
            if (session()->getFlashdata('update')) {
                echo '<div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('update');
                echo '</h5></div>';
            }
            ?>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Keterangan</th>
                        <th>Marker</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($keterangan as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-center"><?= $value['keterangan'] ?></td>
                            <td class="text-center"><img src="<?= base_url('marker/' . $value['marker']) ?>" width="75px"></td>
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#edit<?= $value['id_keterangan'] ?>" class="btn-btn-sm btn-warning btn-flat">
                                    <i class="fas fa-map-marker-alt"></i> Ganti Marker
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<?php foreach ($keterangan as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_keterangan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Mengganti Marker <?= $value['keterangan'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart('Keterangan/UpdateData/' . $value['id_keterangan']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload Marker</label>
                        <input type="file" name="marker" class="form-control" accept="image/png" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
