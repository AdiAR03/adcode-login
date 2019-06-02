<script src="<?= base_url('template/adminlte/bower_components/');?>jquery/dist/jquery.min.js"></script>

<link href="<?= base_url('template/adminlte/datatables/datatables.min.css') ?>" rel="stylesheet" />

<script src="<?= base_url('template/adminlte/datatables/datatables.min.js') ?>"></script>

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
              <?php if ($submenu->num_rows() > 0): ?>
                <?php $no=1; foreach ($submenu->result() as $subm): ?>
                  <tr>
                      <td class="text-center"><?php cetak($no++) ;?></td>
                      <td><?php cetak($subm->judul_submenu) ;?></td>
                      <td class="text-center"><button class="btn btn-xs btn-primary" style="width: 130px"><?php cetak($subm->judul_menu) ;?></button></td>
                      <td><?php cetak($subm->url_submenu) ;?></td>
                      <td class="text-center">
                        <?php if ($subm->is_active_submenu==1): ?>
                          <button class="btn btn-xs btn-success" style="width: 60px"><i class="fa fa-check"></i> Aktif</button>
                          <?php else: ?>
                          <button class="btn btn-xs btn-danger" style="width: 60px"><i class="fa fa-close"></i> Tidak</button>
                        <?php endif ?>                          
                      </td>
                      <td class="text-center"><a href="" data-toggle="modal" data-target="#modal-hakakses<?=$subm->id_submenu;?>"><i class="fa fa-key"></i></a></td>
                      <td class="text-center">
                        <a class="green" data-toggle="modal" data-target="#modal-edit<?=$subm->id_submenu;?>">
                        <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                      </a>&nbsp; 
                        <a class="red tombolhapus" href="<?= base_url('backend/menu/delete-submenu/'.encrypt_url($subm->id_submenu)) ?>">
                          <button class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-130"></i> Hapus</button>
                        </a>
                      </td>
                    </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="7">Data tidak ada</td></tr>                
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="7" class="text-center" style="text-transform: uppercase;">Data Sub Menu</th></tr></thead>
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

      <?= form_open('backend/menu/view-submenu',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

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
                  <?php foreach ($menu->result() as $m): ?>
                    <option value="<?php echo $m->id_menu; ?>"> <?php cetak($m->judul_menu) ; ?></option>
                  <?php endforeach ?>
                </select>
                
            </div>
            <?php echo form_error('menu_id', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Aktif <small class="text-danger">*</small></label>
                <select  class="form-control" name="is_active_submenu"> 
                  <option value="1"> AKTIF</option>
                  <option value="0"> TIDAK</option>
                </select>
                <?php echo form_error('is_active_submenu', '<small class="text-danger">', '</small>'); ?>
                   
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

<?php $no = 1; foreach ($submenu->result() as $subm): $no++ ?>
<div class="modal fade" id="modal-edit<?=$subm->id_submenu;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Edit Menu</h4>
      </div>

      <?= form_open('backend/menu/edit-submenu',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <input type="hidden" readonly value="<?php cetak($subm->id_submenu);?>" name="id_submenu" class="form-control" >
        <div class="form-groub">
            <label for="">Judul <small class="text-danger">*</small></label>
            <input type="text" name="judul_submenu" placeholder="Judul" class="form-control" value="<?php cetak($subm->judul_submenu) ;?>" required autofocus>
            <?php echo form_error('judul_submenu', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
            <label for="">URL <small class="text-danger">*</small></label>
            <input type="text" name="url_submenu" placeholder="URL" class="form-control" value="<?php cetak($subm->url_submenu) ;?>">
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Menu Utama <small class="text-danger">*</small></label>
                <select  class="form-control" name="menu_id"> 
                  <?php foreach ($menu->result() as $m): ?>
                    <?php $selected=''; if ($m->id_menu==$subm->menu_id): $selected='selected' ?>
                      
                    <?php endif ?>
                    <option value="<?php echo $m->id_menu; ?>" <?= $selected;?>> <?php cetak($m->judul_menu) ; ?></option>
                  <?php endforeach ?>
                </select>
                
            </div>
            <?php echo form_error('menu_id', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <div class="form-groub">
                <label for="">Aktif <small class="text-danger">*</small></label>
                <select  class="form-control" name="is_active_submenu"> 
                  <option value="1" <?php if ($subm->is_active_submenu == 1) { echo 'selected';} ?>> AKTIF</option>
                  <option value="0" <?php if ($subm->is_active_submenu == 0) { echo 'selected';} ?>> TIDAK</option>
                </select>
                <?php echo form_error('is_active_submenu', '<small class="text-danger">', '</small>'); ?>
                   
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

<?php $no = 1; foreach ($submenu->result() as $subm): $no++ ?>
<div class="modal fade" id="modal-hakakses<?=$subm->id_submenu;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Pengaturan Hak Akses Sub Menu</h4>
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
                    <?php foreach ($aksessubmenu->result() as $asm): ?>
                      <?php if ($asm->role_id==$rl->id_role AND $asm->submenu_id==$subm->id_submenu): ?>
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
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>

      <?= form_close(); ?>
    </div>
  </div>
</div>
<?php endforeach ;?>