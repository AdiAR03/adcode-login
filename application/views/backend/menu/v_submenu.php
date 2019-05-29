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
          <h3 class="box-title" style="font-weight: bold;">Data Sub Menu</h3>
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
              <th>Judul</th>
              <th class="text-center">Menu Utama</th>
              <th>URL</th>
              <th class="text-center">Aktif</th>
              <th class="text-center">Hak Akses</th>
              <th class="text-center" width="100px">Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
                if ($submenu->num_rows() > 0) 
                {
                  $no = 1;
                  foreach ($submenu->result() as $subm) 
                  { ?>
                    <tr>
                      <td class="text-center"><?php cetak($no++) ;?></td>
                      <td><?php cetak($subm->judul_submenu) ;?></td>
                      <td class="text-center"><button class="btn btn-xs btn-primary" style="width: 130px"><?php cetak($subm->judul_menu) ;?></button></td>
                      <td><?php cetak($subm->url_submenu) ;?></td>
                      <td class="text-center">
                        <?php if ($subm->is_active=1): ?>
                          <button class="btn btn-xs btn-success" style="width: 60px"><i class="fa fa-check"></i> Aktif</button>
                          <?php else: ?>
                          <button class="btn btn-xs btn-success" style="width: 60px"><i class="fa fa-cancel">>Tidak</button>
                        <?php endif ?>                          
                      </td>
                      <td class="text-center"><a href=""><i class="fa fa-key"></i></a></td>
                      <td class="text-center">
                        <a class="green" href="<?= base_url('backend/menu/edit-submenu/'.encrypt_url($subm->id_submenu)) ?>">
                          <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                        </a>&nbsp; 
                        <a class="red tombolhapus" href="<?= base_url('backend/menu/hapus-submenu/'.encrypt_url($subm->id_submenu)) ?>">
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
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Tambah Sub Menu</h4>
      </div>

      <?= form_open('backend/menu/tambah-submenu',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <div class="form-groub">
            <label for="">Judul <small class="text-danger">*</small></label>
            <input type="text" name="judul_submenu" placeholder="Judul" class="form-control" value="<?php echo set_value('judul_submenu') ;?>" required autofocus>
            <?php echo form_error('judul_submenu', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
            <label for="">URL <small class="text-danger">*</small></label>
            <input type="text" name="url_submenu" placeholder="URL" class="form-control" value="<?php echo set_value('url_submenu') ;?>">
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Menu Utama <small class="text-danger">*</small></label>
                <select  class="form-control" name="menu_id"> 
                  <?php
                    foreach ($menu->result() as $m) {
                    ?>
                    <option value="<?php echo $m->id_menu; ?>"> <?php cetak($m->judul_menu) ; ?></option>
                  <?php }?>
                </select>
                
            </div>
            <?php echo form_error('id_menu', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Aktif <small class="text-danger">*</small></label>
                <select  class="form-control" name="is_active"> 
                  <option value="1"> AKTIF</option>
                  <option value="0"> TIDAK</option>
                </select>
                <?php echo form_error('is_active', '<small class="text-danger">', '</small>'); ?>
                   
            </div>
          </div>
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