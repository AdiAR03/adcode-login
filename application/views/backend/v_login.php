<!DOCTYPE html>
<html>
<head>
  <?php date_default_timezone_set('Asia/Jakarta');?>
  <?php $link = base_url('files/');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title;?></title>
  <link rel="shortcut icon" href="<?= $link?>images/logokominfo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('template/adminlte');?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('template/adminlte');?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('template/adminlte');?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template/adminlte');?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('template/adminlte');?>/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('message');?>"></div>

  <div class="login-logo">
    <a href="<?= base_url('template/adminlte');?>/index2.html"><b>LOGIN SI</b>HELPDESK</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat datang di aplikasi HELPDESK</p>

    <?= form_open('authentication',array('method' => 'POST', 'onsubmit' => 'return cekform();')); ?>
      <div class="form-group has-feedback">
        <input type="name" id="username" class="form-control" placeholder="Username" name="username" value="<?= set_value('username') ;?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
      </div>
      <div class="form-group has-feedback">
        <center><label style="text-align: center">Kode Keamanan</label>
          <br>
        <img src="<?= base_url('captcha'); ?>" id="captcha" width="147px" height="34px"> 
        <input type=button  onClick=reload(); value='Reload Gambar' class="btn btn-primary">
        </center>
        <input type="text" id="keamanan" name="security_code"  class="form-control" placeholder="Masukkan Kode Keamanan" />
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <?= form_submit('', 'Sign In', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
        </div>
        <!-- /.col -->
      </div>
    <?= form_close(); ?>

    <div class="social-auth-links text-center">
      <a href="https://kominfo.limapuluhkotakab.go.id" class="btn btn-block btn-social btn-facebook btn-flat"><img src="<?= $link?>images/logokominfo.png" alt=""> Diskominfo Kabupaten Lima Puluh Kota</a>
    </div>
    <!-- /.social-auth-links -->
    
    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url('template/adminlte');?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('template/adminlte');?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url('template/adminlte');?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script src="<?= base_url('template/sweetalert');?>/sweetalert2.all.min.js"></script>
<script src="<?= base_url('template/sweetalert');?>/myscript.js"></script>

<script type="text/javascript">
    function cekform()
    {
        if(!$("#username").val())
        {
            alert('Maaf Username Tidak Boleh Kosong');
            $("#username").focus();
            return false;
        }

        if(!$("#password").val())
        {
            alert('Maaf Password Tidak Boleh Kosong');
            $("#password").focus();
            return false;
        }
        if(!$("#keamanan").val())
        {
            alert('Maaf Kode Keamanan Tidak Boleh Kosong');
            $("#keamanan").focus();
            return false;
        }
    }           
</script>

<script type="text/javascript">
  function reload()
  {
  img = document.getElementById("captcha");
  img.src="<?= base_url('captcha'); ?>" + Math.random();
  }
</script>

</body>
</html>
