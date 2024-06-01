<?php 
include('../koneksi/koneksi.php');
?>

<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php"); ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php"); ?>

  <?php include("includes/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-plus"></i> Tambah Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="blog.php">Data Konten</a></li>
              <li class="breadcrumb-item active">Tambah Konten</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Konten</h3>
          <div class="card-tools">
            <a href="konten.php" class="btn btn-sm btn-warning float-right">
            <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
          </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <br><br>
        <div class="col-sm-10">
          <?php if(!empty($_GET['notif']) && !empty($_GET['jenis'])): ?>
            <?php if($_GET['notif'] == "tambahkosong"): ?>
              <div class="alert alert-danger" role="alert">
                Maaf data <?php echo $_GET['jenis']; ?> wajib diisi
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <form class="form-horizontal" action="konfirmasitambahkonten.php" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group row">
              <label for="judul" class="col-sm-3 col-form-label">Judul</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="judul" id="judul" value="">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
              <div class="col-sm-7">
                <div class="input-group date">
                  <input type="text" class="form-control" name="tanggal" id="datepicker" autocomplete="off" value="">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="isi" class="col-sm-3 col-form-label">Isi</label>
              <div class="col-sm-7">
                <textarea class="form-control" name="isi" id="editor1" rows="12"></textarea>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
            </div>  
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php"); ?>
</div>
<!-- ./wrapper -->
<?php include("includes/script.php"); ?>
</body>
</html>
