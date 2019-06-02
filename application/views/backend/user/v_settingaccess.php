<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error');?>"></div>
<?php $rl = $role->row_array(); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;"><?=$rl['role']?> : Setting Menu/Submenu </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
          <table id="" class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #3C8DBC">
              <th>Judul Menu</th>
              <th>Sub Menu</th>
              <th class="text-center">Hak Akses</th>
              <th class="text-center">Hak Akses Sub Menu</th>
            </tr>
            </thead>
            <tbody>
              <?php if ($menu->num_rows() > 0): ?>
                <?php foreach ($menu->result() as $mn): ?>
                  <?php if ($mn->url_menu!=''): ?>
                    <tr>
                      <td><?php cetak($mn->judul_menu) ;?></td>
                      <td></td>
                      <td class="text-center"><input class="settingmenu" href="<?= base_url('backend/user/changeaccess/'.encrypt_url($rl['id_role']).'/'.encrypt_url($mn->id_menu)) ?>" type="checkbox" <?= check_access($rl['id_role'], $mn->id_menu)?> ></td>
                      <td></td>
                    </tr>
                  <?php else: ?>
                    <tr>
                      <td><?php cetak($mn->judul_menu) ;?></td>
                      <td></td>
                      <td class="text-center"><input class="settingmenu" href="<?= base_url('backend/user/changeaccess/'.encrypt_url($rl['id_role']).'/'.encrypt_url($mn->id_menu)) ?>" type="checkbox" <?= check_access($rl['id_role'], $mn->id_menu)?> ></td>
                      <td></td>
                    </tr>
                    <?php foreach ($submenu->result() as $subm): ?>
                      <?php if ($subm->menu_id==$mn->id_menu): ?>
                        <tr>
                          <td></td>
                          <td><?php cetak($subm->judul_submenu) ;?></td>
                          <td></td>
                          <td  class="text-center"><input class="settingsubmenu" href="<?= base_url('backend/user/changesubaccess/'.encrypt_url($rl['id_role']).'/'.encrypt_url($subm->id_submenu)) ?>" type="checkbox" <?= check_subaccess($rl['id_role'], $subm->id_submenu)?> >
                          </td>
                        </tr>
                      <?php endif ?>
                      
                    <?php endforeach ?>
                  <?php endif ?>
                  
                <?php endforeach ?>
              <?php else: ?>
                <tr><td colspan="4">Data tidak ada</td></tr>
              <?php endif ?>
            </tfoot>
            <thead><tr style="background-color: #3C8DBC"><th colspan="4" class="text-center" style="text-transform: uppercase;"><?=$rl['role']?> : Setting Menu/Submenu</th></tr></thead>
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
  
</script>