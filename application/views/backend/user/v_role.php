
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
          <h3 class="box-title" style="font-weight: bold;">Data Role</h3>
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
              <th width="170px">Akses Menu/Submenu</th>
              <th class="text-center" width="138px">Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php if ($role->num_rows() > 0): ?>
                <?php $no=1; foreach ($role->result() as $rl): ?>
                  <tr>
                    <td><?php cetak($no++) ;?></td>
                    <td><?php cetak($rl->role) ;?></td>
                    <td class="text-center"><a href="<?= base_url('backend/user/setting-access/'.encrypt_url($rl->id_role))?>" class="btn btn-xs btn-primary"><i class="fa fa-key"></i> Akses</a></td>
                    <td class="text-center">
                      <a class="green" data-toggle="modal" data-target="#modal-edit<?=$rl->id_role;?>">
                        <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                      </a>&nbsp; 
                      <a class="red tombolhapus" href="<?= base_url('backend/user/delete-role/'.encrypt_url($rl->id_role)) ?>">
                        <button class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-130"></i> Hapus</button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="4">Data tidak ada</td></tr>
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="4" class="text-center" style="text-transform: uppercase;">Data Role User</th></tr></thead>
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
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Tambah Role User</h4>
      </div>

      <?= form_open('backend/user/view-role',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
        <div class="form-groub">
            <label for="">Role <small class="text-danger">*</small></label>
            <input type="text" name="role" placeholder="Role" class="form-control" value="<?php echo set_value('role') ;?>">
            <?php echo form_error('role', '<small class="text-danger">', '</small>'); ?>
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

<?php $no=0; foreach($role->result() as $rl): $no++; ?>
<div class="modal fade" id="modal-edit<?=$rl->id_role;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" style="font-weight: bold; text-transform: uppercase">Edit Role User</h4>
      </div>

      <?= form_open('backend/user/edit-role',array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>

      <div class="modal-body">
         <input type="hidden" readonly value="<?php cetak($rl->id_role);?>" name="id_role" class="form-control" >
        <div class="form-groub">
            <label for="">Role <small class="text-danger">*</small></label>
            <input type="text" name="role" placeholder="Role" class="form-control" value="<?php cetak($rl->role);?>" required autofocus>
            <?php echo form_error('role', '<small class="text-danger">', '</small>'); ?>
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
<?php endforeach; ?>
