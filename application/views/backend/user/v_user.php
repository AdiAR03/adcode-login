
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
          <h3 class="box-title" style="font-weight: bold;">Data User</h3>
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
              <th>Fullname</th>
              <th>Username</th>
              <th class="text-center" width="70px">Aktif</th>
              <th class="text-center" width="138px">Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php if ($user->num_rows() > 0): ?>
                <?php $no=1; foreach ($user->result() as $u): ?>
                  <tr>
                    <td><?php cetak($no++) ;?></td>
                    <td><?php cetak($u->fullname) ;?></td>
                    <td><?php cetak($u->username) ;?></td>
                    <td class="text-center">
                        <?php if ($u->is_active==1): ?>
                          <button class="btn btn-xs btn-success" style="width: 60px"><i class="fa fa-check"></i> Aktif</button>
                          <?php else: ?>
                          <button class="btn btn-xs btn-danger" style="width: 60px"><i class="fa fa-close"></i> Tidak</button>
                        <?php endif ?>                          
                      </td>
                    <td class="text-center">
                      <a class="green" data-toggle="modal" data-target="#modal-edit<?=$u->username;?>">
                        <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                      </a>&nbsp; 
                      <a class="red tombolhapus" href="<?= base_url('backend/user/delete-user/'.encrypt_url($u->username)) ?>">
                        <button class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-130"></i> Hapus</button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="6">Data tidak ada</td></tr>
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="5" class="text-center" style="text-transform: uppercase;">Data User</th></tr></thead>
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
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Tambah User</h4>
      </div>

      <?= form_open('backend/user/view-role',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <div class="form-groub">
          <label for="">Username <small class="text-danger">*</small></label>
          <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo set_value('username') ;?>">
          <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
          <label for="">Fullname <small class="text-danger">*</small></label>
          <input type="text" name="fullname" placeholder="Fullname" class="form-control" value="<?php echo set_value('fullname') ;?>">
          <?php echo form_error('fullname', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
          <label for="">Password <small class="text-danger">*</small></label>
          <input type="text" name="password" placeholder="Password" class="form-control">
          <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-groub">
          <label for="">Aktif <small class="text-danger">*</small></label>
          <select  class="form-control" name="is_active"> 
            <option value="1"> AKTIF</option>
            <option value="0"> TIDAK</option>
          </select>
          <?php echo form_error('is_active', '<small class="text-danger">', '</small>'); ?>   
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
