<?php include_once("koneksi/koneksi.php");?>

<!doctype html>
<html lang="en">
  <head>
    <?php include("include/head.php"); ?>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <?php include_once("include/nav.php");?>
 </nav>
    <section id="carousel-item">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="img/slide-1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="img/slide-2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="img/slide-3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <?php 
    $sql_k = "SELECT `judul`,`isi` FROM `konten` WHERE 
    `id_konten`='2'";
    $query_k = mysqli_query($koneksi,$sql_k);
    while($data_k = mysqli_fetch_row($query_k)){
        $judul_konten = $data_k[0];
        $isi_konten = $data_k[1];
    }
    ?>
    <section id="notes-item">
        <div class="container">
            <div class="row featurette">
                <div class="col-md-7">
                  <h2 class="featurette-heading">
                  <?php echo $judul_konten;?></h2>
                  <p class="lead"><?php echo $isi_konten;?></p>
                </div>
                <div class="col-md-5">
                    <img src="img/undraw_book_lover_mkck.png" 
                     class="img-fluid mx-auto featurette-image">
                </div>
            </div>
            <hr class="featurette-divider"> 
        </div>
    </section>
    <section id="blog-item" class="mb-4">
        <div class="container">
            <h2>Blog Terbaru</h2><br>
            <div class="row mb-2"> 
            <?php 
              $sql_l = "SELECT `b`.`id_blog`, `b`.`judul`, 
               DATE_FORMAT(`b`.`tanggal`, '%d-%m-%Y'), 
              `k`.`kategori_blog`,`b`.`cover` FROM `blog` `b` INNER JOIN 
              `kategori_blog` `k`
               ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`
               ORDER BY `b`.`id_blog` DESC";
              $query_l = mysqli_query($koneksi,$sql_l);
              while($data_l = mysqli_fetch_row($query_l)){
                $id_blog = $data_l[0];
                $judul_blog = $data_l[1];
                $tanggal = $data_l[2];
                $kategori_blog = $data_l[3];
                $cover = $data_l[4];
              ?>
                <div class="col-md-6">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static bg-light">
                        <strong class="d-inline-block mb-2 text-success">
                        <?php echo $kategori_blog;?></strong>
                        <h3 class="mb-0">
                        <a href="detailblog.php?data=<?php echo $id_blog;?>">
                        <?php echo $judul_blog;?></a></h3>
                        <div class="mb-1 text-muted">
                        <?php echo $tanggal;?></div>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img style="max-width: 200px;  height: 200px; object-fill: cover;" src=admin/cover/<?php echo $cover;?>
                            class="img-fluid" title="book title here">
                        </div>
                    </div>
                </div>
              <?php }?>


            </div>
        </div>
    </section>
    <footer>
    <?php include("include/footer.php"); ?>
    </footer>
  </body>
  </html>