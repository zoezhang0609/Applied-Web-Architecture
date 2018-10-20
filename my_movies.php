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

			<main>
			<!--list of movies-->
				<h3 class="category">My Movies</h3>
				<section class="sharebooks">
					<?php include("php/config.php");
						#open the database
						@$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

						if(isset($_GET['return'])) {
							$query = "UPDATE movie SET available=0 WHERE id=".$_GET['return'];
							$stmt = $database->prepare($query);
							$stmt->execute();
							echo('<small><b>Movie return sucessfully!</b></small>');
						}

						$query = "SELECT movie.id, movie_name, movie.director, movie.type, movie.year, movie.barcode, movie.available FROM movie
						JOIN director_movie ON movie.id = director_movie.id
						JOIN director ON director.id = director_movie.id";

						$stmt = $database->prepare($query);
						$stmt->bind_result($id, $movie_name, $director, $type, $year, $barcode, $available);
						$stmt->execute();

						echo '<table class="table table-striped">';
							echo '<thead>';
								echo '<th scope="col">#</th>
											<th class="col" scope="col">Name</th>
											<th scope="col">Director</th>
											<th scope="col">Type</th>
											<th scope="col">Year</th>
											<th scope="col">Barcode</th>
											<th scope="col">Status</th>';
							echo '</thead>';
							while($stmt->fetch()) {
								if($available == 1) {
								echo "<tr>";
								echo "<td>$id</td>
											<td>$movie_name</td>
										  <td>$director</td>
											<td>$type</td>
											<td>$year</td>
											<td>$barcode</td>
											<td>
												<form action='' method='get'>
													<button type='submit' name='return' id='$id' class='btnreserve' value='$id'>Return</button>
												</form>
											</td>";
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
