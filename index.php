<!doctype html>
<html>
	<head>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<title>Welcome to Movie!</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
		<link href="css/main.css" type="text/css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
	</head>

<!--toppic, logotype and navegation-->
	<body>
		<div class="container">
			<header>
			  <figure>
			    <img src="images/toppic.jpeg">
			    <figcaption>
			      <h1>Search Movies</h1>
			      <p>Care about your watching needs.<br></p>
							<div>
								<a href="movie_box.php">
									<button class="btn btn-outline-secondary btn_go" type="button" id="button-addon2">Go!</button>
								</a>
							</div>
			    </figcaption>
				</figure>
				
<!--check which page is the current page-->
				<?php 
					$highlight = "index.php";
					include("php/header.php");
				?>
				
			</header>
			<main>
<!--introduction of the website-->
				<div class="intro">
					<h3>About Us</h3>
					<p>Bookpal is an online service that provides users with a way to access and share new books.
					Members can connect with fellow book-lovers from around the world to share their favorite books,
					discuss their latest reads, and discover new content. With our website, not only will you be able to
					access limitless amounts of books, but you will be able to meet potentially thousands of people who
					share your interests. Our mission is to encourage reading, open minds, and foster international
					friendships.</p>
					<ul class="features">
						<li>Want to search a specific movie? <a href="movie_box.php">&nbspTry me</a>.</li>
						<li>Want to leave us a message? <a href="contact.php">&nbspContact Us</a>.</li>
					</ul>
				</div>

<!--What's new-->
				<div class="movielist">
					<h3>What's New</h3>
					<div class="moviebox">
					  <div class="movie">
					    <img src="images/index1.jpg" alt="Casino Jack and The United State of Money">
					    <div class="movie_info">
					      <h4>Casino Jack and The United State of Money</h4>
					      <p class="">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
							</div>
					  </div>

						<div class="movie">
					    <img src="images/index4.jpg" alt="Casino Jack and The United State of Money">
					    <div class="movie_info">
					      <h4>Inception</h4>
					      <p class="">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
							</div>
						</div>
						
						<div class="movie">
					    <img src="images/index3.jpg" alt="Casino Jack and The United State of Money">
					    <div class="movie_info">
					      <h4>The Girl Next Door</h4>
					      <p>This is a longer card with supporting text below as a natural lead-in to additional content.</p>
							</div>
						</div>

						<div class="movie">
					    <img src="images/index5.jpg" alt="Casino Jack and The United State of Money">
					    <div class="movie_info">
					      <h4>Casino Jack and The United State of Money</h4>
					      <p class="">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
							</div>
					  </div>
						
						<div class="movie">
					    <img src="images/index2.jpg" alt="Casino Jack and The United State of Money">
					    <div class="movie_info">
					      <h4>The Girl Next Door</h4>
					      <p>This is a longer card with supporting text below as a natural lead-in to additional content.</p>
							</div>
						</div>

						<div class="movie">
					    <img src="images/index6.jpg" alt="Casino Jack and The United State of Money">
					    <div class="movie_info">
					      <h4>Casino Jack and The United State of Money</h4>
					      <p class="">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
							</div>
					  </div>
						
					</div>
				</div>

			</main>

<!--footer-->
			<?php include("php/footer.php"); ?>
		</div>
	</body>
</html>
