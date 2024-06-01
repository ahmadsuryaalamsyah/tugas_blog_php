<?php include_once("koneksi/koneksi.php"); ?>
<?php 
if(isset($_GET['data'])){
  $id_kategori = $_GET['data'];
  $sql = "SELECT `b`.`id_blog`, `b`.`judul`, DATE_FORMAT(`b`.`tanggal`, '%d-%m-%Y') AS `tanggal`, 
              `b`.`isi`, `u`.`nama` FROM `blog` `b`
              INNER JOIN `user` `u` ON `b`.`id_user` = `u`.`id_user`
              WHERE `b`.`id_kategori_blog` = $id_kategori
              ORDER BY `b`.`tanggal` DESC";
  $query = mysqli_query($koneksi, $sql);
  $blog_posts = [];
  while($data = mysqli_fetch_assoc($query)){
    $blog_posts[] = $data;
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
        <h1 class="text-white">Blog Category</h1>
    </div>
</section><br><br>
<section id="blog-list">
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-9 blog-main">
                <?php if (!empty($blog_posts)): ?>
                    <?php foreach ($blog_posts as $post): ?>
                        <div class="blog-post">
                            <h2 class="blog-post-title"><?php echo $post['judul']; ?></h2>
                            <p class="blog-post-meta"><?php echo $post['tanggal']; ?> by 
                                <a href="#"><?php echo $post['nama']; ?></a></p>
                            <p><?php echo substr($post['isi'], 0, 200) . '...'; ?></p>
                            <a href="blog_detail.php?data=<?php echo $post['id_blog']; ?>">Read more</a>
                        </div><br><br>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No posts found in this category.</p>
                <?php endif; ?>
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
                    $sql_t = "SELECT `id_tag`, `nama_tag`
                              FROM `tag`
                              ORDER BY `nama_tag`";
                    $query_t = mysqli_query($koneksi, $sql_t);
                    while($data_t = mysqli_fetch_row($query_t)){
                        $id_tag = $data_t[0];
                        $nama_tag = $data_t[1];
                    ?>
                    <li><a href="tag_blog.php?tag=<?php echo $id_tag; ?>">
                        <?php echo $nama_tag; ?></a></li>
                    <?php } ?>
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
