<!doctype html>
<html>
<head>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Welcome to bookpal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
	<link href="css/main.css" type="text/css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
</head>

<!--logotype and navegation-->
	<body>
		<div class="container">
			<header class="space">
				<?php include("php/header.php"); ?>
			</header>

<!--slices-->
			<main class="adjustment">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  </ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block w-100" src="images/toppic3.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="images/toppic2.jpg" alt="Second slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="images/toppic1.jpg" alt="Third slide">
						</div>
					</div>
				  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>

			<section class="intro">
				<h3>About Us</h3>
				<p>Bookpal is an online service that provides users with a way to access and share new books.
				Members can connect with fellow book-lovers from around the world to share their favorite books,
				discuss their latest reads, and discover new content. With our website, not only will you be able to
				access limitless amounts of books, but you will be able to meet potentially thousands of people who
				share your interests. Our mission is to encourage reading, open minds, and foster international
				friendships.</p>
				<ul class="features">
					<li>Want to search a specific book? <a href="movie_box.php">&nbspTry me</a>.</li>
					<li>Want to leave us a message? <a href="contact.php">&nbspContact Us</a>.</li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
					Aenean massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
					Aenean massa.</p>
				<p>Nulla consequat massa quis enim.
					Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet
					a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
					Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat
					vitae, eleifend ac, enim.Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec
					pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a,
					venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
					Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae,
					eleifend ac, enim.</p>
			</section>

			<ul class="data">
				<li>
					<img src="images/f1.png">
					<h4>85,120 Members</h4>
					<p>We have thousands of members have common interests, movies!</p>
				</li>
				<li>
					<img src="images/f2.png">
					<h4>127,420 movies</h4>
					<p>Tons of movies are in stock. You will definitely get what you want.</p>
				</li>
				<li>
					<img src="images/f3.png">
					<h4>Sustainable Development</h4>
					<p>Reserve movies online, enjoy watching when and where you want.</p>
				</li>

			</ul>
			</main>
<!--footer-->
			<?php include("php/footer.php"); ?>
		</div>
		<!-- Optional JavaScript -->
 	  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
