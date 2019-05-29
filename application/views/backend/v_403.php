<!-- Main content -->
<section class="content">
  <div class="error-page">
    <h2 class="headline text-yellow"> 403</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Halaman Tidak Tersedia.</h3>

      <p>
        Anda tidak memiliki hak untuk mengakses halaman Ini! <br>
        Silahkan <a href="<?= base_url('backend/dashboard');?>">Kembali ke halaman Dashboard</a> 
      </p>

      <form class="search-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search">

          <div class="input-group-btn">
            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <!-- /.input-group -->
      </form>
    </div>
    <!-- /.error-content -->
  </div>
  <!-- /.error-page -->
</section>
<!-- /.content -->