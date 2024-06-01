<?php include_once("koneksi/koneksi.php"); ?>
<?php 
if(isset($_GET['data'])){
  $id_blog = $_GET['data'];
  $sql = "SELECT `b`.`judul`, DATE_FORMAT(`b`.`tanggal`, '%d-%m-%Y'), 
              `k`.`kategori_blog`, `b`.`isi`, `u`.`nama` FROM `blog` `b` 
              INNER JOIN `kategori_blog` `k` 
              ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`
              INNER JOIN `user` `u` ON `b`.`id_user` = `u`.`id_user`
              WHERE `b`.`id_blog` = $id_blog
              ORDER BY `b`.`id_blog` DESC";
  $query = mysqli_query($koneksi,$sql);
  while($data = mysqli_fetch_row($query)){
    $judul_blog = $data[0];
    $tanggal = $data[1];
    $kategori_blog = $data[2];
    $isi = $data[3];
    $nama = $data[4];
  }
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
        <h1 class="text-white">BLOG</h1>
    </div>
</section><br><br>
<section id="blog-list">
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-9 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title"><?php echo $judul_blog;?></h2>
                    <p class="blog-post-meta"><?php echo $tanggal; ?> by 
                        <a href="#"><?php echo $nama;?></a></p>
                    <p><?php echo $isi;?></p>
                </div><br><br><!-- /.blog-post -->
            </div><!-- /.blog-main -->

            <aside class="col-md-3 blog-sidebar">
                <div class="p-4">
                    <h4 class="font-italic">Categories</h4>
                    <ol class="list-unstyled mb-0">
                    <?php 
                    $sql_k = "SELECT `id_kategori_blog`,`kategori_blog` 
                              FROM `kategori_blog`
                              ORDER BY `kategori_blog`";
                    $query_k = mysqli_query($koneksi,$sql_k);
                    while($data_k = mysqli_fetch_row($query_k)){
                        $id_kat = $data_k[0];
                        $nama_kat = $data_k[1];
                    ?>
                    <li><a href="daftar_blog.php?data=<?php echo $id_kat;?>">
                        <?php echo $nama_kat;?></a></li>
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
                        // Correct the column name in the SQL query
                        $sql_t = "SELECT `id_tag`, `tag` FROM `tag` ORDER BY `tag`";
                        $query_t = mysqli_query($koneksi, $sql_t);
                        
                        // Check if the query was successful
                        if ($query_t) {
                            // Check if there are any rows returned
                            if (mysqli_num_rows($query_t) > 0) {
                                while ($data_t = mysqli_fetch_row($query_t)) {
                                    $id_tag = $data_t[0];
                                    $tag_name = $data_t[1];
                        ?>
                                    <li><a href="tag_blog.php?tag=<?php echo $id_tag; ?>"><?php echo $tag_name; ?></a></li>
                        <?php 
                                }
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
