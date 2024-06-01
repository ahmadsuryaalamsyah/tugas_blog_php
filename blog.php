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
              <h2 class="blog-post-title"><a href="detailblog.php">Cras mattis consectetur purus sit amet fermentum</a></h2>
              <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>
      
              <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur 
                ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.
                Posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
                <a href="detailblog.php" class="btn btn-primary stretched-link">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
      
            <div class="blog-post">
              <h2 class="blog-post-title"><a href="detailblog.php">Cras mattis consectetur purus sit amet fermentum</a></h2>
              <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>
      
              <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis 
                euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut 
                fermentum massa justo sit amet risus.</p>
              <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit
                 amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
              <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, 
                a pharetra augue.</p>
              <a href="detailblog.php" class="btn btn-primary stretched-link">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
      
            <div class="blog-post">
              <h2 class="blog-post-title"><a href="detailblog.php">Etiam porta sem malesuada magna mollis euismod</a></h2>
              <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>
      
              <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis 
                euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut 
                fermentum massa justo sit amet risus.</p>
              <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit
                 amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
              <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, 
                a pharetra augue.</p>
              <a href="detailblog.php" class="btn btn-primary stretched-link">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
      
            <nav class="blog-pagination">
              <a class="btn btn-outline-primary" href="#">Older</a>
              <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
            </nav>
      
          </div><!-- /.blog-main -->
      
          <aside class="col-md-3 blog-sidebar">
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
            <div class="p-4">
              <h4 class="font-italic">Categories</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#">Umum</a></li>
                <li><a href="#">PHP</a></li>
                <li><a href="#">Java</a></li>
                <li><a href="#">Database</a></li>
                <li><a href="#">Techno</a></li>
            </div>
      
            <div class="p-4">
              <h4 class="font-italic">Archives</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#">March 2014</a></li>
                <li><a href="#">February 2014</a></li>
                <li><a href="#">January 2014</a></li>
                <li><a href="#">December 2013</a></li>
                <li><a href="#">November 2013</a></li>
                <li><a href="#">October 2013</a></li>
                <li><a href="#">September 2013</a></li>
                <li><a href="#">August 2013</a></li>
                <li><a href="#">July 2013</a></li>
                <li><a href="#">June 2013</a></li>
                <li><a href="#">May 2013</a></li>
                <li><a href="#">April 2013</a></li>
              </ol>
            </div>

            <div class="p-4">
              <h4 class="font-italic">Tag</h4>
              <ol class="list-unstyled">
                <li><a href="#">PHP</a></li>
                <li><a href="#">MySQL</a></li>
                <li><a href="#">Javascript</a></li>
              </ol>
            </div>
            <?php }?>
      
            
          </aside><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
      
      </main><!-- /.container -->
    </section><br><br>
    <footer>
    <?php include("include/footer.php"); ?>
    </footer>
  </body>
</html>