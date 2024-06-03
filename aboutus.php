<?php include_once("koneksi/koneksi.php"); ?>

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
        <h1 class="text-white">ABOUT US</h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
            <?php 
            $sql_a = "SELECT ``"
            ?>
            <div class="blog-post">
              <h2 class="blog-post-title">About Us</h2>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release 
                of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop 
                publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div><br><br><!-- /.blog-post -->
            
          </div><!-- /.blog-main -->
          
      
          <aside class="col-md-3 blog-sidebar">
      
            <div class="p-4">
              <h4 class="font-italic">Social Media</h4>
              <ol class="list-unstyled">
                <li><a href="#">GitHub</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
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