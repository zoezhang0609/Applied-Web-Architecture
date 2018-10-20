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
			      <div class="input-group mb-3">
			        <input type="text" class="form-control" placeholder="Mission Impossible 6" aria-label="Recipient's username" aria-describedby="button-addon2">
			        <div class="input-group-append">
			          <a href="movie_box.php"><button class="btn btn-outline-secondary" type="button" id="button-addon2">Go!</button></a>
			        </div>
			      </div>
			    </figcaption>
			  </figure>
				<?php include("php/header.php"); ?>
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

<!--Also Hot-->
				<div class="requestlist">
					<h3>What's New</h3>
					<div class="card-columns">
					  <div class="card">
					    <img class="card-img-top" src="images/index1.jpg" alt="Card image cap">
					    <div class="card-body">
					      <h5 class="card-title">Casino Jack and The United State of Money</h5>
					      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
								<a href="my_movies.php"><button class="reserve">Reserve</button></a>
							</div>
					  </div>

					  <div class="card">
					    <img class="card-img-top" src="images/index4.jpg" alt="Card image cap">
					    <div class="card-body">
					      <h5 class="card-title">The Girl Next Door</h5>
					      <p class="card-text">Directed by Christopher Nolan<br>Starring	Leonardo DiCaprio
									Ken Watanabe Joseph Gordon-Levitt</p>
								<a href="my_movies.php"><button class="reserve">Reserve</button></a>
					    </div>
					  </div>

					  <div class="card">
					    <img class="card-img" src="images/index6.jpg" alt="Card image">
							<div class="card-body">
					      <h5 class="card-title">Red Square Battle</h5>
								<p class="card-text">RED is a 2010 American action comedy film inspired
									by the limited comic-book series of the same name created by Warren
									Ellis and Cully Hamner. </p>
								<a href="my_movies.php"><button class="reserve">Reserve</button></a>
					    </div>
					  </div>

						<div class="card">
					    <img class="card-img-top" src="images/index3.jpg" alt="Card image cap">
					    <div class="card-body">
					      <h5 class="card-title">Inception</h5>
					      <p class="card-text">Inception is a fictional movies. This is a longer card with supporting text below as a natural lead-in to additional content.
									This content is a little bit longer.</p>
								<a href="my_movies.php"><button class="reserve">Reserve</button></a>
							</div>
					  </div>

					  <div class="card">
					    <img class="card-img-top" src="images/index5.jpg" alt="Card image cap">
					    <div class="card-body">
					      <h5 class="card-title">The Girl Next Door</h5>
					      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
								<a href="my_movies.php"><button class="reserve">Reserve</button></a>
					    </div>
					  </div>

					  <div class="card">
					    <img class="card-img" src="images/index2.jpg" alt="Card image">
							<div class="card-body">
					      <h5 class="card-title">Red Square Battle</h5>
					      <p class="card-text">RED is a 2010 American action comedy film inspired
									by the limited comic-book series of the same name created by Warren
									Ellis and Cully Hamner. </p>
								<a href="my movies.php"><button class="reserve">Reserve</button></a>
					    </div>
					  </div>
					</div>
				</div>

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
