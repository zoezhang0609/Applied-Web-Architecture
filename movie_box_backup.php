<?php 
	if(!isset($_SESSION)) session_start(); 
?>

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

<!--logotype and navegation-->
	<body>
		<div class="container">
			<header class="space">
			<?php 
				$highlight = "movie_box.php";
				include("php/header.php");
			?>
			</header>

			<main>
<!--search function with category-->
				<div class="category">
					<h3>Index</h3>
					<form action="movie_box.php" method="post">
						<div class="form-row align-items-center">
							<span class="key_words">Key words:</span>
							<div class="col-auto">
								<input type="text" class="form-control mb-2" name="movie" placeholder="name of the movie">
								<input type="text" class="form-control mb-2 shorter" name="director" placeholder="director">
							</div>
							<div class="col-auto">
							<button id="search" name="search" type="submit" class="btn btn-primary mb-2">Search</button>
							</div>
						</div>
					</form>
					<ul>
						<li><a href="">2015-2018</a></li>
						<li><a href="">2010-2015</a></li>
						<li><a href="">Comedy</a></li>
						<li><a href="">Crime</a></li>
						<li><a href="">Romance</a></li>
						<li><a href="">Horro</a></li>
						<li><a href="">War</a></li>
						<li><a href="">Sci-fictional</a></li>
					</ul>
				</div>

		<?php
			include("php/config.php");
			#---open the database
			@$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

			#---check if the database connected
			if($database->connect_error) {
				echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
				exit();
			}

			#---php for reserve movies
			if(isset($_GET['reserve'])) {

				$userid = $_SESSION['id'];
				
				#---check whether a user has already login before reseving movies
				if(!isset($userid)) {
					header("Location:login.php");
				} else {
					$query = "UPDATE movie SET available=1 WHERE id=".$_GET['reserve'];
					$stmt = $database->prepare($query);
					$stmt->execute();
					
					$movieid = $_GET['reserve'];

					#---take the reserved movie id and logined user id and save the information in reservemovie table
					$query = "INSERT INTO reservemovie(user_id, movie_id) VALUES('$userid', '$movieid')";
					$stmt = $database->prepare($query);
					$stmt->execute();

					echo('<small><b>Movie booked! Check it in My Movie page.</b></small>');
				}	
			}

			#---php for searching function
			$searchmovie = "";
			$searchdirector = "";

			if(isset($_POST) && !empty($_POST)) {//isset是指点击search按钮，empty post是指form是否为空
				$searchmovie = trim($_POST['movie']);//获得form里用户填写的数据
				$searchdirector = trim($_POST['director']);
			}

			$query = "SELECT movie.id, movie_name, movie.type, movie.year, movie.available, first_name, last_name FROM movie
			JOIN director_movie ON movie.id = director_movie.movie_id
			JOIN director ON director.id = director_movie.author_id";

			if($searchmovie && !$searchdirector) {
				$query = $query . " WHERE movie.movie_name LIKE '%" . $searchmovie . "%'";
			}

			if(!$searchmovie && $searchdirector) {
				$query = $query . " WHERE director.first_name LIKE '%" . $searchdirector . "%' OR director.last_name LIKE '%". $searchdirector . "%'";
			}

			if($searchmovie && $searchdirector) {
				$query = $query . " WHERE movie.movie_name LIKE '%" . $searchmovie . "%' 
				AND  director.first_name LIKE '%" . $searchdirector . "%' OR director.last_name LIKE '%" . $searchdirector . "%'";
			}

			$stmt = $database->prepare($query);
			$stmt->bind_result($id, $movie_name, $type, $year, $available, $first_name, $last_name);
			$stmt->execute();
			
			echo '<table class="table table-striped">';
				echo '<thead>';
					echo '<th scope="col">#</th>
								<th class="col" scope="col">Name</th>
								<th scope="col">Director</th>
								<th scope="col">Type</th>
								<th scope="col">Year</th>
								<th scope="col">Status</th>';
				echo '</thead>';
				while($stmt->fetch()) {
					if($available==0) {
						echo "<tr>";
						echo "<td>$id</td>
								<td>$movie_name</td>
								<td>$first_name&nbsp&nbsp$last_name</td>
								<td>$type</td>
								<td>$year</td>
								<td>
								<form action='movie_box.php' method='get'>
									<button type='submit' name='reserve' id='$id' class='btnreserve' value='$id'>Reserve</button>
								</form>
								</td>";
						echo "</tr>";
					} else {
						echo "<tr>";
						echo "<td>$id</td>
								<td>$movie_name</td>
								<td>$first_name&nbsp&nbsp$last_name</td>
								<td>$type</td>
								<td>$year</td>
								<td><button type='button' class='btn_borrowed'>Reserve</button></td>";
						echo "</tr>";
					}
				}
				echo '</table>';
			?>

			</main>
<!--footer-->
			<?php include("php/footer.php"); ?>
		</div>
	</body>
</html>
