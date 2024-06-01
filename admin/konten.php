<?php 
include('../koneksi/koneksi.php');

if((isset($_GET['aksi'])) && (isset($_GET['data']))){
  if($_GET['aksi'] == 'hapus'){
    $id_konten = $_GET['data'];
    $sql_f = "SELECT `judul` FROM `konten` WHERE `id_konten`='$id_konten'";
    $query_f = mysqli_query($koneksi, $sql_f);
    $jumlah_f = mysqli_num_rows($query_f);
    if($jumlah_f > 0){
      while($data_f = mysqli_fetch_row($query_f)){
        $cover = $data_f[0];
        if(file_exists("cover/$cover")){
          unlink("cover/$cover");
        }
      }
    }
    $sql_dh = "DELETE FROM `tag_konten` WHERE `id_konten` = '$id_konten'";
    mysqli_query($koneksi, $sql_dh);

    $sql_dm = "DELETE FROM `konten` WHERE `id_konten` = '$id_konten'";
    mysqli_query($koneksi, $sql_dm);
    header("Location:konten.php?notif=hapusberhasil");
    exit();
  }
}
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
            <h3><i class="fas fa-file-alt"></i> Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Konten</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Konten</h3>
          <div class="card-tools">
            <a href="tambahkonten.php" class="btn btn-sm btn-info float-right">
              <i class="fas fa-plus"></i> Tambah Konten
            </a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="col-md-12">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-4 bottom-10">
                  <input type="text" class="form-control" id="kata_kunci" name="katakunci" value="<?php echo isset($_GET['katakunci']) ? $_GET['katakunci'] : ''; ?>">
                </div>
                <div class="col-md-5 bottom-10">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                </div>
              </div>
            </form>
          </div><br>
          <div class="col-sm-12">
          <?php if(!empty($_GET['notif'])): ?>
            <?php if($_GET['notif'] == "tambahberhasil"): ?>
              <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
            <?php elseif($_GET['notif'] == "editberhasil"): ?>
              <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
            <?php elseif($_GET['notif'] == "hapusberhasil"): ?>
              <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
            <?php endif; ?>
          <?php endif; ?>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="50%">Judul</th>
                <th width="30%">Tanggal</th>
                <th width="15%"><center>Aksi</center></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $batas = 2;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $posisi = ($halaman - 1) * $batas;

                $sql_b = "SELECT `id_konten`, `judul`, DATE_FORMAT(`tanggal`, '%d-%m-%Y') AS `tanggal` FROM `konten`";
                if (isset($_GET['katakunci'])) {
                  $katakunci_kategori = $_GET['katakunci'];
                  $sql_b .= " WHERE `judul` LIKE '%$katakunci_kategori%'";
                }
                $sql_b .= " ORDER BY `judul` LIMIT $posisi, $batas";
                $query_b = mysqli_query($koneksi, $sql_b);

                if(!$query_b){
                  die("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                }

                $no = $posisi + 1;
                while($data_b = mysqli_fetch_row($query_b)){
                  $id_konten = $data_b[0];
                  $judul = $data_b[1];
                  $tanggal = $data_b[2];
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $judul; ?></td>
                  <td><?php echo $tanggal; ?></td>
                  <td align="center">
                    <a href="editkonten.php?data=<?php echo $id_konten; ?>" class="btn btn-xs btn-info" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="detailkonten.php?data=<?php echo $id_konten; ?>" class="btn btn-xs btn-info" title="Detail">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $judul; ?>?')) window.location.href = 'konten.php?aksi=hapus&data=<?php echo $id_konten; ?>&notif=hapusberhasil'" class="btn btn-xs btn-warning" title="Hapus">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <?php
          $sql_jum = "SELECT `id_konten`, `judul`, DATE_FORMAT(`tanggal`, '%d-%m-%Y') AS `tanggal` FROM `konten`";
          if (isset($_GET['katakunci'])){
            $katakunci_kategori = $_GET['katakunci'];
            $sql_jum .= " WHERE `judul` LIKE '%$katakunci_kategori%'";
          }
          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_num_rows($query_jum);
          $jum_halaman = ceil($jum_data / $batas);
        ?>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <?php 
              if($jum_halaman > 1){
                $sebelum = $halaman - 1;
                $setelah = $halaman + 1;
                if($halaman > 1){
                  echo "<li class='page-item'><a class='page-link' href='konten.php?halaman=1'>First</a></li>";
                  echo "<li class='page-item'><a class='page-link' href='konten.php?halaman=$sebelum'>«</a></li>";
                }
                for($i = 1; $i <= $jum_halaman; $i++){
                  if($i != $halaman){
                    echo "<li class='page-item'><a class='page-link' href='konten.php?halaman=$i'>$i</a></li>";
                  } else {
                    echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                  }
                }
                if($halaman < $jum_halaman){
                  echo "<li class='page-item'><a class='page-link' href='konten.php?halaman=$setelah'>»</a></li>";
                  echo "<li class='page-item'><a class='page-link' href='konten.php?halaman=$jum_halaman'>Last</a></li>";
                }
              }
            ?>
          </ul>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php"); ?>
</div>
<!-- ./wrapper -->

<?php include("includes/script.php"); ?>
</body>
</html>
