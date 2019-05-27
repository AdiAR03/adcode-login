
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
          <h3 class="box-title" style="font-weight: bold;">Data Role</h3>
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
                if ($role->num_rows() > 0) 
                {
                  $no = 1;
                  foreach ($role->result() as $rl) 
                  { ?>
                    <tr>
                      <td><?php cetak($no++) ;?></td>
                      <td><?php cetak($rl->role) ;?></td>
                      <td class="text-center">
                        <a class="green" href="<?= base_url('backend-editrole/'.encrypt_url($rl->id)) ?>">
                          <button class="btn btn-success btn-xs"><i class="ace-icon fa fa-pencil bigger-130"></i> Edit</button>
                        </a>&nbsp; 
                        <a class="red tombolhapus" href="<?= base_url('backend-hapusrole/'.$rl->id) ?>">
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