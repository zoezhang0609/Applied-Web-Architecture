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
				<?php include("php/header.php"); ?>
			</header>

			<main>
<!--category-->
					<div class="category">
						<h3>Index</h3>
						<form action="movie_box.php" method="post">
							<div class="form-row align-items-center">
								<span class="key_words">Key words:</span>
								<div class="col-auto">
									<input type="text" class="form-control mb-2" name="movie" placeholder="name of the movie">
									<input type="text" class="form-control mb-2 shorter" name="director" placeholder="director">
								</div>
								<!--<div class="col-auto">
								  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
								    <option selected>Name</option>
								    <option value="1">Director</option>
								    <option value="2">IMDb</option>
								  </select>
								</div>-->
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
<!--Share of Books-->
<section class="sharebooks">
	<?php

		include("php/config.php");
		#open the database
		@$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

		#check if the database connected
		if($database->connect_error) {
			echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
			exit();
		}

		if(isset($_GET['reserve'])) {
			$query = "UPDATE movie SET available=1 WHERE id=".$_GET['reserve'];
			$stmt = $database->prepare($query);
			$stmt->execute();
			echo('<small><b>Movie booked! Check it in My Movie page.</b></small>');




		}

		$searchmovie = "";
		$searchdirector = "";

		if(isset($_POST) && !empty($_POST)) {//isset是指点击search按钮，empty post是指form是否为空
			$searchmovie = trim($_POST['movie']);//获得form里用户填写的数据
			$searchdirector = trim($_POST['director']);
		}

		/*
		SELECT * FROM `movie` 搜索电影里的所有元素

		director_movie是一个包含共同元素的表格：影片id和导演id
		where那一行，不管用户输入什么（‘%’)，在movie这个表格里搜索（特定）电影名称，
		假设某部电影由两个导演合拍，则会出现两搜索结果，同一个电影名称，不同导演

		director_movie相当于bridge,多个表格之间想要有交集，必须在director_movie里面
		存放一个自己的元素，比如movie.id和director.id
		JOIN director_movie ON movie.id = director_movie.id
		JOIN director ON director.id = director_movie.id
		WHERE movie.movie_name LIKE '%'

		SELECT * FROM `movie`
		JOIN director_movie ON movie.id = director_movie.id
		JOIN director ON director.id = director_movie.id
		WHERE movie.director LIKE '%martin%' 模糊搜索，导演里包含martin字眼的电影
		*/

		$query = "SELECT movie.id, movie_name, movie.director, movie.type, movie.year, movie.barcode, movie.available FROM movie
		JOIN director_movie ON movie.id = director_movie.id
		JOIN director ON director.id = director_movie.id";

		if($searchmovie && !$searchdirector) {
			$query = $query . " WHERE movie.movie_name LIKE '%" . $searchmovie . "%'";
		}

		if(!$searchmovie && $searchdirector) {
			$query = $query . " WHERE movie.director LIKE '%" . $searchdirector . "%'";
		}

		if($searchmovie && $searchdirector) {
			$query = $query . " WHERE movie.movie_name LIKE '%" . $searchmovie . "%' AND movie.director LIKE '%".$searchdirector."%'";
		}

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
				if($available==0) {
				echo "<tr>";
				echo "<td>$id</td>
							<td>$movie_name</td>
						  <td>$director</td>
							<td>$type</td>
							<td>$year</td>
							<td>$barcode</td>
							<td>
								<form action='' method='get'>
									<button type='submit' name='reserve' id='$id' class='btnreserve' value='$id'>Reserve</button>
								</form>
							</td>";
				echo "</tr>";
			} else {
				echo "<tr>";
				echo "<td>$id</td>
							<td>$movie_name</td>
						  <td>$director</td>
							<td>$type</td>
							<td>$year</td>
							<td>$barcode</td>
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
		<!--<script src="js/project.js"></script>-->
	</body>
</html>
