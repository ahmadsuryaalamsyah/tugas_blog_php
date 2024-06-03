<?php
include_once("koneksi/koneksi.php");

// Mendapatkan parameter tag dari URL
if (isset($_GET['tag'])) {
    $id_tag = mysqli_real_escape_string($koneksi, $_GET['tag']); // Mencegah SQL Injection

    // Query untuk mendapatkan blog berdasarkan tag yang dipilih
    $sql = "SELECT b.id_blog, b.judul, DATE_FORMAT(b.tanggal, '%d-%m-%Y') AS tanggal, b.isi
            FROM blog b
            JOIN tag_blog bt ON b.id_blog = bt.id_blog
            WHERE bt.id_tag = '$id_tag'
            ORDER BY b.tanggal DESC";
    $query = mysqli_query($koneksi, $sql);

    // Menambahkan penanganan kesalahan
    if (!$query) {
        echo "Error: " . mysqli_error($koneksi);
        exit;
    }
} else {
    echo "Tag tidak ditemukan.";
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <?php include("include/head.php"); ?>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <?php include_once("include/nav.php");?>
    </nav>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">Blog Tag: <?php echo htmlspecialchars($id_tag); ?></h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
            <?php 
            if (mysqli_num_rows($query) > 0) {
              while($data = mysqli_fetch_assoc($query)){
                  $id_blog = $data['id_blog'];
                  $judul_blog = $data['judul'];
                  $tanggal = $data['tanggal'];
                  $isi = $data['isi'];
            ?>
            <div class="blog-post">
              <h2 class="blog-post-title"><a href="detailblog.php?data=<?php echo htmlspecialchars($id_blog); ?>" ><?php echo htmlspecialchars($judul_blog); ?></a></h2>
              <p class="blog-post-meta"><?php echo htmlspecialchars($tanggal); ?> <a href="#">Ahmad Surya Alam Syah</a></p>
              <p><?php echo htmlspecialchars($isi); ?></p>
              <a href="detailblog.php?data=<?php echo htmlspecialchars($id_blog); ?>" class="btn btn-primary stretched-link">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
            <?php 
              }
            } else {
              echo "<p>No blog posts found for this tag.</p>";
            }
            ?>

            <nav class="blog-pagination">
              <a class="btn btn-outline-primary" href="#">Older</a>
              <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
            </nav>

          </div><!-- /.blog-main -->

          <aside class="col-md-3 blog-sidebar">
                <div class="p-4">
                    <h4 class="font-italic">Categories</h4>
                    <ol class="list-unstyled mb-0">
                    <?php 
                    $sql_k = "SELECT `id_kategori_blog`, `kategori_blog` 
                              FROM `kategori_blog`
                              ORDER BY `kategori_blog`";
                    $query_k = mysqli_query($koneksi, $sql_k);
                    while($data_k = mysqli_fetch_row($query_k)){
                        $id_kat = $data_k[0];
                        $nama_kat = $data_k[1];
                    ?>
                    <li><a href="daftar_blog.php?data=<?php echo $id_kat; ?>">
                        <?php echo $nama_kat; ?></a></li>
                    <?php }?>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="font-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                    <?php 
                    $sql_a = "SELECT DISTINCT DATE_FORMAT(`tanggal`, '%M %Y') AS `bulan`
                              FROM `blog`
                              ORDER BY `tanggal` DESC";
                    $query_a = mysqli_query($koneksi, $sql_a);
                    while($data_a = mysqli_fetch_assoc($query_a)){
                        $bulan = $data_a['bulan'];
                    ?>
                    <li><a href="arsip_blog.php?bulan=<?php echo urlencode($bulan); ?>">
                        <?php echo $bulan; ?></a></li>
                    <?php } ?>
                    </ol>
                </div>

            <div class="p-4">
              <h4 class="font-italic">Tag</h4>
              <ol class="list-unstyled">
              <?php 
              $sql_t = "SELECT `id_tag`, `tag` FROM `tag` ORDER BY `tag`";
              $query_t = mysqli_query($koneksi, $sql_t);
              if ($query_t && mysqli_num_rows($query_t) > 0) {
                  while ($data_t = mysqli_fetch_row($query_t)) {
                      $id_tag = $data_t[0];
                      $tag_name = $data_t[1];
              ?>
              <li><a href="tag_blog.php?tag=<?php echo $id_tag; ?>"><?php echo $tag_name; ?></a></li>
              <?php 
                  }
              }
              ?>
              </ol>
            </div>
      
          </aside><!-- /.blog-sidebar -->
        </div><!-- /.row -->

      </main><!-- /.container -->
    </section><br><br>
    <footer>
      <?php include("include/footer.php"); ?>
    </footer>
  </body>
</html>
