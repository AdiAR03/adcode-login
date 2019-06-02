<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error');?>"></div>
<?php $rl = $role->row_array(); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;"><?=$rl['role']?> : Setting Menu </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="font-size: 13px">
          <table id="" class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #3C8DBC">
              <th>Judul Menu</th>
              <th class="text-center">Hak Akses</th>
            </tr>
            </thead>
            <tbody>
              <?php if ($menu->num_rows() > 0): ?>
                <?php foreach ($menu->result() as $mn): ?>
                  <tr>
                    <td><?php cetak($mn->judul_menu) ;?></td>

                    <td class="text-center"><input class="readtombol" href="<?= base_url('backend/user/changeaccess/'.encrypt_url($rl['id_role']).'/'.encrypt_url($mn->id_menu)) ?>" type="checkbox" <?= check_access($rl['id_role'], $mn->id_menu)?> ></td>

                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="2">Data tidak ada</td></tr>
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="2" class="text-center" style="text-transform: uppercase;">Data Menu</th></tr></thead>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">

  $('.tombolsetting').on('click', function(e) {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: "<?= base_url('backend/user/changeaccess'); ?>",
        type: 'post',
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function() {
            document.location.href = "<?= base_url('backend/user/setting-access/'); ?>" + <?= decrypt_url(roleId) ?>;
        }
    });

});
</script>