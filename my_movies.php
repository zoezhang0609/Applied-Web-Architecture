
<?php 
	if(!isset($_SESSION)) session_start();

	if(!isset($_SESSION['type'])) {
		header("Location:login.php");
		exit();
	}
?>

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

	<body>
		<div class="container">
			<header class="space">

			<?php 
				$highlight = "my_movies.php";
				include("php/header.php");
			?>
			</header>

			<main>
			<!--list of movies reserved by specific user-->
				<h3 class="category">My Movies</h3>
					
			<?php include("php/config.php");
			#open the database
			@$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

			#check if the database connected
			if($database->connect_error) {
				echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
				exit();
			}

			#---php for returning movies
			if(isset($_GET['return'])) {
				$query = "UPDATE movie SET available=0 WHERE id=".$_GET['return'];
				$stmt = $database->prepare($query);
				$stmt->execute();

				$movieid = $_GET['return'];

				#---once user return a movie, delete the movie from the table
				$query = "DELETE FROM reservemovie WHERE movie_id = '$movieid'";
				$stmt = $database->prepare($query);
				$stmt->execute();

				echo('<small><b>Movie return sucessfully!</b></small>');
			}

			#---php for printing out all the movies can be returned by the current user
			$userid = $_SESSION['id'];

			$query = "SELECT movie.id, movie_name, movie.type, movie.year, movie.available, first_name, last_name FROM movie
			JOIN director_movie ON movie.id = director_movie.movie_id
			JOIN director ON director.id = director_movie.author_id
			JOIN reservemovie ON reservemovie.movie_id = movie.id
			WHERE user_id = $userid";

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

				$movielist=[];

				while($stmt->fetch()) {
					array_push($movielist, ["id"=>$id, "movie_name"=>$movie_name, "director"=>$first_name." ".$last_name,
					"type"=>$type, "year"=>$year, "available"=>$available]);
				}

				$mid = -1;
				for($count=0; $count<sizeof($movielist); $count++) {
					if($mid == $movielist[$count]['id']) {
						$director = $movielist[$count-1]['director'];
						$movielist[$count]['director'] .= "<br> ". $director;
						array_splice($movielist, ($count-1), 1);
						$count--;
					}
					$mid = $movielist[$count]['id'];
				}

				for($count=0; $count<sizeof($movielist); $count++) {
					$id = $movielist[$count]['id'];
					$movie_name = $movielist[$count]['movie_name'];
					$directors = $movielist[$count]['director'];
					$type = $movielist[$count]['type'];
					$year = $movielist[$count]['year'];
					
					if($available==1) {
						echo "<tr>";
						echo "<td>$id</td>
								<td>$movie_name</td>
								<td>$directors</td>
								<td>$type</td>
								<td>$year</td>
								<td>
								<form action='' method='get'>
									<button type='submit' name='return' id='$id' class='btnremove' value='$id'>Return</button>
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
