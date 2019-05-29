<script src="<?= base_url('template/adminlte/bower_components/');?>jquery/dist/jquery.min.js"></script>

<link href="<?= base_url('template/adminlte//datatables/datatables.min.css') ?>" rel="stylesheet" />

<script src="<?= base_url('template/adminlte//datatables/datatables.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#MyTable').DataTable();
    } );

</script>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;">Data Master Menu</h3>
          <div class="pull-right">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="MyTable" class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #3C8DBC">
              <th width="5%">No</th>
              <th>Deskripsi</th>
              <th class="text-center" width="100px">Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
                if ($mastermenu->num_rows() > 0) 
                {
                  $no = 1;
                  foreach ($mastermenu->result() as $mm) 
                  { ?>
                    <tr>
                      <td><?php cetak($no++) ;?></td>
                      <td><?php cetak($mm->master_menu) ;?></td>
                      <td class="text-center">
                        <a class="green" href="<?= base_url('backend/menu/edit-mastermenu/'.encrypt_url($mm->id_master_menu)) ?>">
                          <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                        </a>&nbsp; 
                        <a class="red tombolhapus" href="<?= base_url('backend/menu/hapus-mastermenu/'.encrypt_url($mm->id_master_menu)) ?>">
                          <button class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-130"></i> Hapus</button>
                        </a>
                      </td>
                    </tr>
                  <?php }
                }
                else
                {
                    echo '<tr><td>Data Tidak Ada</td></tr>';
                }
              ;?>   
            
            
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Tambah Master Menu/Controller</h4>
      </div>

      <?= form_open('backend/menu/tambah-mastermenu',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <div class="form-groub">
            <label for="">Judul <small class="text-danger">*</small></label>
            <input type="text" name="master_menu" placeholder="Judul" class="form-control" value="<?php echo set_value('master_menu') ;?>" required autofocus>
            <?php echo form_error('master_menu', '<small class="text-danger">', '</small>'); ?>
        </div>
      </div>
      <br>
      <div class="modal-footer" style="background-color: #3C8DBC">
        <?= form_submit('', ' Save ', array('class' => 'btn btn-sm btn-success', 'name' => 'button')); ?>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>Close</button>
      </div>

      <?= form_close(); ?>
    </div>
  </div>
</div>