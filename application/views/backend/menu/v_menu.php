<script src="<?= base_url('template/adminlte/bower_components/');?>jquery/dist/jquery.min.js"></script>

<link href="<?= base_url('template/adminlte//datatables/datatables.min.css') ?>" rel="stylesheet" />

<script src="<?= base_url('template/adminlte//datatables/datatables.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#MyTable').DataTable();
    } );

</script>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error');?>"></div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;">Data Menu</h3>
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
              <th>Judul Menu</th>
              <th>URL</th>
              <th class="text-center" width="10%">Icon</th>
              <th class="text-center">Aktif</th>
              <th class="text-center">Hak Akses</th>
              <th class="text-center" width="100px">Aksi</th>
            </tr>
            </thead>
            <tbody>
              
              <?php if ($menu->num_rows() > 0): ?>
                <?php $no=1; foreach ($menu->result() as $mn): ?>
                  <tr>
                    <td class="text-center"><?php cetak($no++) ;?></td>
                    <td><?php cetak($mn->judul_menu) ;?></td>
                    <td><?php cetak($mn->url_menu) ;?></td>
                    <td class="text-center"><i class="<?php cetak($mn->icon_menu) ;?>"></i></td>
                    <td class="text-center">
                      <?php if ($mn->is_active==1): ?>
                        <button class="btn btn-xs btn-success" style="width: 60px"><i class="fa fa-check"></i> Aktif</button>
                        <?php else: ?>
                        <button class="btn btn-xs btn-danger" style="width: 60px"><i class="fa fa-close"></i> Tidak</button>
                      <?php endif ?>                          
                    </td>
                    <td class="text-center"><a href="" data-toggle="modal" data-target="#modal-hakakses<?=$mn->id_menu;?>"><i class="fa fa-key"></i></a></td>
                    <td class="text-center">
                      <a class="green" data-toggle="modal" data-target="#modal-edit<?=$mn->id_menu;?>">
                        <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                      </a>&nbsp; 
                      <a class="red tombolhapus" href="<?= base_url('backend/menu/delete-menu/'.encrypt_url($mn->id_menu)) ?>">
                        <button class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-130"></i> Hapus</button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="7">Data tidak ada</td></tr>
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="7" class="text-center" style="text-transform: uppercase;">Data Menu</th></tr></thead>
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
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Tambah Menu</h4>
      </div>

      <?= form_open('backend/menu/view-menu',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <div class="form-groub">
            <label for="">Judul <small class="text-danger">*</small></label>
            <input type="text" name="judul_menu" placeholder="Judul" class="form-control" value="<?= set_value('judul_menu') ;?>" required autofocus>
            <?php echo form_error('judul_menu', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
            <label for="">URL</label>
            <input type="text" name="url_menu" placeholder="URL" class="form-control" value="<?= set_value('url_menu') ;?>">
            <small class="text-danger">Kosongkan url jika menu memiliki sub menu dibawahnya</small>
        </div>
        <div class="form-groub">
            <label for="">Icon</label>
            <input type="text" name="icon_menu" placeholder="fa fa-folder" class="form-control" value="<?= set_value('icon_menu') ;?>">
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Master Menu/Controller <small class="text-danger">*</small></label>
                <select  class="form-control" name="master_menu_id"> 
                  <?php foreach ($mastermenu->result() as $master): ?>
                    <option value="<?php echo $master->id_master_menu; ?>"> <?php cetak($master->master_menu) ; ?></option>
                  <?php endforeach ?>
                </select>
                
            </div>
            <?php echo form_error('master_menu_id', '<small class="text-danger">', '</small>'); ?>
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

<?php $no = 1; foreach ($menu->result() as $mn): $no++ ?>
<div class="modal fade" id="modal-edit<?=$mn->id_menu;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Edit Menu</h4>
      </div>

      <?= form_open('backend/menu/edit-menu',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <input type="hidden" readonly value="<?php cetak($mn->id_menu);?>" name="id_menu" class="form-control" >
        <div class="form-groub">
            <label for="">Judul <small class="text-danger">*</small></label>
            <input type="text" name="judul_menu" placeholder="Judul" class="form-control" value="<?php cetak($mn->judul_menu) ;?>">
            <?php echo form_error('judul_menu', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
            <label for="">URL</label>
            <input type="text" name="url_menu" placeholder="URL" class="form-control" value="<?php cetak($mn->url_menu) ;?>">
            <small class="text-danger">Kosongkan url jika menu memiliki sub menu dibawahnya</small>
        </div>
        <div class="form-groub">
            <label for="">Icon</label>
            <input type="text" name="icon_menu" placeholder="fa fa-folder" class="form-control" value="<?php cetak($mn->icon_menu) ;?>">
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Master Menu/Controller <small class="text-danger">*</small></label>
                <select  class="form-control" name="master_menu_id"> 
                  <?php foreach ($mastermenu->result() as $master): ?>
                    <?php $selected = ''; if ($master->id_master_menu==$mn->master_menu_id): $selected = 'selected' ?>
                    <?php endif ?>

                    <option value="<?php echo $master->id_master_menu; ?>" <?= $selected;?>> <?php cetak($master->master_menu) ; ?></option>
                  <?php endforeach ?>
                  
                </select>
                
            </div>
            <?php echo form_error('id_master_menu', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Aktif <small class="text-danger">*</small></label>
                <select  class="form-control" name="is_active"> 
                  <option value="1" <?php if ($mn->is_active == 1) { echo 'selected';} ?>> AKTIF</option>
                  <option value="0" <?php if ($mn->is_active == 0) { echo 'selected';} ?>> TIDAK</option>
                  }
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
<?php endforeach ;?>

<?php $no = 1; foreach ($menu->result() as $mn): $no++ ?>
<div class="modal fade" id="modal-hakakses<?=$mn->id_menu;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Pengaturan Hak Akses Menu</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <table id="MyTable" class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #3C8DBC">
              <th>Role User</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
              <?php if ($role->num_rows() > 0): ?>
                <?php $no=1; foreach ($role->result() as $rl): ?>
                  <tr>
                    <td><?php cetak($rl->role) ;?></td>
                    <?php foreach ($aksesmenu->result() as $am): ?>
                      <?php if ($am->role_id==$rl->id_role AND $am->menu_id==$mn->id_menu): ?>
                        <td>
                          <label>
                            <input type="checkbox" checked=""> Ya
                          </label>
                        </td>
                      
                      <?php endif ?>
                    <?php endforeach ?>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="3">Data tidak ada</td></tr>
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="2" class="text-center" style="text-transform: uppercase;">Hak Akses Menu</th></tr></thead>
          </table>
        </div>

      </div>
      <div class="modal-footer" style="background-color: #3C8DBC">
        <?= form_submit('', ' Save ', array('class' => 'btn btn-sm btn-success', 'name' => 'button')); ?>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>Close</button>
      </div>

      <?= form_close(); ?>
    </div>
  </div>
</div>
<?php endforeach ;?>