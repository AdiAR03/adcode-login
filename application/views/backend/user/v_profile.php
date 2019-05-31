<?php
  $link   = base_url().'files/';
  $p      = $profile->row_array();
?>
<!-- Main content -->
<section class="content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div>

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?= base_url('files/img_profile/'.$p['image']);?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?= cetak($p['fullname']);?></h3>

          <p class="text-muted text-center"><?= cetak($p['role']);?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Terdaftar</b> <a class="pull-right"><?= tanggal_indo(date("Y-m-d",$p['date_created']));?></a>
            </li>
          </ul>

          <a href="#" class="btn btn-primary btn-block"><b>Profile</b></a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title text-center" style="font-weight: bold">Selamat Datang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i> Selamat Datang</strong>

          <p class="text-muted">
            Di Kabupaten Lima Puluh Kota
          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>

          <p class="text-muted" style="font-size: 13px;">Bukik Limau, Sarilamak Jalan Raya Negara KM.10 Kecamatan Harau Lima Puluh Kota Telp : (0752)7750494 - 7750495 Email : kominfo@limapuluhkotakab.go.id</p>
          <hr>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active" style="width: 100%"><a href="#timeline" data-toggle="tab">Profile</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="timeline">
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                    <span class="bg-red">
                      <?= tanggal_indo(date("Y-m-d",$p['date_created']));?>
                    </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> <?= tanggal_indo(date("Y-m-d", time()));?>, &nbsp;<?= (date("H:i:s", time()));?></span>

                  <h3 class="timeline-header" style="font-weight: bold">Silahkan Perbarui Profile</h3>

                  <div class="timeline-body">
                    <?= form_open('backend/user/profile',array('method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?= $p['fullname'];?>" name="fullname">
                          <?= form_error('fullname', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?= $p['username'];?>" disabled>
                          <input type="hidden" class="form-control" value="<?= $p['username'];?>" name="username">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Hak Akses</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="<?= $p['role'];?>" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                          <?php if ($p['image']==NULL): ?>
                            <img src="" alt="">
                          <?php else: ?>
                            <img class="profile-user img-responsive" width="100px" src="<?= base_url('files/img_profile/'.$p['image']);?>" alt="User profile picture">
                          <?php endif ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Foto Profile</label>

                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="foto">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <?= form_submit('', ' Save ', array('class' => 'btn btn-sm btn-danger', 'name' => 'button')); ?>
                        </div>
                      </div>
                    <?= form_close(); ?>
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
             
              <!-- timeline time label -->
              <li class="time-label">
                    <span class="bg-green">
                      <?= tanggal_indo(date("Y-m-d", time()));?>
                    </span>
              </li>
              <!-- /.timeline-label -->
              
            </ul>
          </div>
        
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->