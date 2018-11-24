<?php include("config.php"); ?>
<div class="log_out">
  <span><a href="php/log_out.php">Log out</a></span>
</div>
<div class="box">
  <div class="white">
    <a href="index.php" id="logo"><img src="images/logotype.png"></a>
  </div>
  <nav id="showtime">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about_us.php"<?php if($highlight=="about_us.php") echo "class='active'"; ?>>About Us</a></li>
      <li><a href="movie_box.php"<?php if($highlight=="movie_box.php") echo "class='active'"; ?>>Movies Box</a></li>
      <li><a href="my_movies.php"<?php if($highlight=="my_movies.php") echo "class='active'"; ?>>My Movies</a></li>
      <li><a href="contact.php"<?php if($highlight=="contact.php") echo "class='active'"; ?>>Contact</a></li>
      <li><a href="gallery.php"<?php if($highlight=="gallery.php") echo "class='active'"; ?>>Gallery</a></li>
    </ul>
  </nav>
</div>
