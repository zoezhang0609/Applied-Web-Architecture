<?php include("config.php"); ?>
<div class="box">
  <div class="white">
    <a href="index.php" id="logo"><img src="images/logotype.png"></a>
  </div>
  <nav id="showtime">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a class="<?php echo($current_page == 'about_us.php') ?'active':NULL ?>" href="about_us.php">About Us</a></li>
      <li><a class="<?php echo($current_page == 'movie_box.php') ?'active':NULL ?>" href="movie_box.php">Movies Box</a></li>
      <li><a class="<?php echo($current_page == 'my_movies.php') ?'active':NULL ?>" href="my_movies.php">My Movies</a></li>
      <li><a class="<?php echo($current_page == 'contact.php') ?'active':NULL ?>" href="contact.php">Contact</a></li>
      <li><a class="<?php echo($current_page == 'gallery.php') ?'active':NULL ?>" href="gallery.php">Gallery</a></li>
    </ul>
  </nav>
</div>
