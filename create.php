<!--start session, only admin and moderator is allowed to visit, otherwise go to index page-->
<?php
  session_start();

  if(isset($_SESSION['type'])) {
    if($_SESSION['type'] == 'user') {
      header("Location: index.php");
      exit();
    }    
  } else {
    header("Location: index.php");
    exit();
  }
?>

<!doctype html>
<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Welcome, <?php echo $_SESSION['type']; ?>.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
        <link href="css/main.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
    </head>
    
    <body>
<!--show different interface depends on admin or moderator-->
    <?php 
        if($_SESSION['type']=='admin') {
            echo '<div class="mainbox">';
        } else {
            echo '<div class="mainbox mainbox_2">';
        }
    ?>

<!--use session to show different message, admin or moderator-->
            <aside>
                <h1>Welcome, <?php echo $_SESSION['type']; ?></h1>
                <div class="person">
                <?php 
                    if($_SESSION['type']=='admin') {
                        echo '<img src="images/profile.png">';
                    } else {
                        echo '<img src="images/profile2.png">';
                    }
                ?>
                <h2><?php echo $_SESSION['username']; ?></h2>
                <span><?php echo $_SESSION['type']; ?></span>
                </div>

                <ul>
<!--use session back to previous page, admin page or moderator page-->
                <li><a href="<?php echo $_SESSION['type']; ?>.php">Go back</a></li>
                <li><a href="gallery.php">Go to Gallery</a></li>
                </ul>
                <div class="logout">
                <img src="images/out.svg">
                <span><a href="php/log_out.php">Log out</a></span>
                </div>
            </aside>

            <main class="admin_main">
                <figure class="desk">
                <?php 
                    if($_SESSION['type']=='admin') {
                        echo '<img src="images/desk.jpeg">';
                    } else {
                        echo '<img src="images/desk2.jpeg">';
                    }
                ?>
                
<!--will introduce js code for reading time and date-->
                <figcaption class="date">22:57
                    <span class="cal">Sun 11th Nov, 2018</span>
                </figcaption>
                </figure>

                <?php
                    include("php/config.php");
                    #open the database
                    @$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
        
                    #check if the database connected
                    if($database->connect_error) {
                    echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
                    exit();
                    }

#========go to 216 first-----php for create new user========#
                    $username = "";
                    $password = "";
                    $role="";

                    if(isset($_POST['username'])){
                        $username = trim($_POST['username']);
                        $password = $_POST['password'];
                        $role=$_POST['role'];

                        #---to avoid thoes "bad codes"------SQL Injection
                        $username = htmlentities($database->real_escape_string($username));
                        $password = $database->real_escape_string($password);

                        #---check whether the username has been taken
                        if(($username == "") || ($password == "")) {
                            echo $_SESSION['empty'];                                           
                        } else {
                            #see whether the input username has been taken
                            $query = "SELECT username FROM user WHERE username='$username'";
                            $stmt = $database->query($query);

                            if($stmt->num_rows > 0) {
                                echo $_SESSION['taken'];
                            } else {
                            #hash password
                            $salt = '$1$rasmusle$rISCgZzpwk3UhDidwXvin0'; #MD5
                            $password = crypt($password, $salt);

                            $query = "INSERT INTO user(username, password, type) VALUE ('$username', '$password', '$role')";
                            $stmt = $database->prepare($query);
                            $stmt->execute();

                            if($stmt == true) {
                                echo $_SESSION['ok'];    
                                } else {
                                echo $_SESSION['commonproblem'];
                                }
                            }      
                        }  
                    } 
                ?>

<!--The div is for showing tips-->
        <div>
          <?php 
            if(isset($tips)) {echo $tips;}

            $_SESSION['commonproblem'] = "<span class='tips'>Sorry, please do it again.</span>";
            
            #for create user
            $_SESSION['taken'] = "<span class='tips'>Sorry, the name has been taken.</span>";
            $_SESSION['ok'] = "<span class='tips'>Create user successfully.</span>";
            $_SESSION['empty'] = "<span class='tips'>Please fill all the blanks.</span>";
            
            #for create movie
            $_SESSION['fill'] = "<span class='tips'>Please fill the movie and director names.</span>";
            $_SESSION['mok'] = "<span class='tips'>Create movie successfully.</span>";
            $_SESSION['exits'] = "<span class='tips'>The movie already exits.</span>";           
          ?>
        </div>

<!----------php for create new movie---------->
                <?php
                    if(isset($_POST['moviename'])) {
                        $moviename = htmlentities($database->real_escape_string(trim($_POST['moviename'])));
                        $dfn = $_POST['dfn'];
                        $dln = $_POST['dln'];
                        $director = trim(($_POST['dfn'])." ".($_POST['dln']));
                        $year = trim($_POST['year']);
                        $genre = $_POST['genre'];

                        #---1.movie and director's name must be filled
                        if(($moviename == "") || ($dfn == "") || ($dln == "")) {
                            echo $_SESSION['fill'];
                        } else {
                        #---2.check whether the director info exits or not, if not, insert data into table directly
                            $query = "SELECT first_name, last_name, id FROM director WHERE first_name = '$dfn' AND last_name = '$dln'";
                            $stmt = $database->query($query);
                            
                            #if the director's data is not exits, insert it
                            if($stmt->num_rows == 0) {                                
                                $query = "INSERT INTO director(first_name, last_name) VALUE ('$dfn', '$dln')";
                                $stmt = $database->prepare($query);
                                $stmt->execute();                      
                                
                                #store the director's id for later use
                                $last_did = mysqli_insert_id($database);    

                            
                            #if exits, store the director's id for later use
                            } else {
                                #---get the same names' director's id
                                $stmt = mysqli_fetch_all($stmt, MYSQLI_ASSOC); 
                                $last_did = $stmt[0]['id'];
                            }

                            #---3.check whether the movie data exits
                            $query = "SELECT movie.id, movie_name FROM movie WHERE movie_name = '$moviename'";
                            $stmt = $database->query($query);

                            #if not exits, get the lastest movie id, take it to middle table
                            if($stmt->num_rows == 0) {    
                                $query = "INSERT INTO movie(movie_name, type, year) VALUE ('$moviename', '$genre', '$year')";
                                $stmt = $database->prepare($query);
                                $stmt->execute(); 
                                $last_mid = mysqli_insert_id($database); 

                                #get the director's info, take id to middle table
                                $query = "SELECT director.id, first_name, last_name FROM director WHERE first_name = '$dfn' AND last_name='$dln'";
                                $stmt = $database->query($query);
                                $stmt = mysqli_fetch_all($stmt, MYSQLI_ASSOC); 
                                $cd_id = $stmt[0]['id'];

                                #update middle table
                                $query = "INSERT INTO director_movie(movie_id, author_id) VALUE ('$last_mid', '$cd_id')";
                                $stmt = $database->prepare($query);
                                $stmt->execute();

                                echo $_SESSION['mok'];    

                            #if movie exits, get the movie id for later use(for comparing)
                            } else {
                                $stmt = mysqli_fetch_all($stmt, MYSQLI_ASSOC); 
                                $oldmovie_id = $stmt[0]['id'];

                                #get the director id for later use(for comparing)
                                $query = "SELECT director.id, first_name, last_name FROM director WHERE first_name = '$dfn' AND last_name='$dln'";
                                $stmt = $database->query($query);
                                $stmt = mysqli_fetch_all($stmt, MYSQLI_ASSOC); 
                                $cd_id = $stmt[0]['id'];

                                #check whether a movie with specific director exits, compare with the current data in middle table
                                $query = "SELECT * FROM director_movie WHERE movie_id='$oldmovie_id' AND author_id = '$cd_id'";
                                $stmt = $database->query($query);

                                #if there's the same data, echo.
                                if($stmt->num_rows>0) {
                                    echo $_SESSION['exits'];

                                #otherwise, update info in middle table
                                } else {
                                    $query = "INSERT INTO director_movie(movie_id, author_id) VALUE ('$oldmovie_id', '$cd_id')";
                                    $stmt = $database->prepare($query);
                                    $stmt->execute();

                                    echo $_SESSION['mok'];
                                }

                                /*#check whether a movie with a specific director exits
                                $query = "SELECT movie.id, movie_name, director.id, first_name, last_name FROM movie
                                JOIN director_movie ON movie.id = director_movie.movie_id
                                JOIN director ON director.id = director_movie.author_id
                                WHERE movie_name = '$moviename' AND first_name = '$dfn' AND last_name = '$dln'";

                                $stmt = $database->query($query);

                                if($stmt->num_rows == 0) {
                                    $stmt = mysqli_fetch_all($stmt, MYSQLI_ASSOC); 
                                    $cd_id = $stmt[0]['id'];
        
                                    $query = "INSERT INTO director_movie(movie_id, author_id) VALUE ('$oldmovie_id', '$director')";
                                    $stmt = $database->prepare($query);
                                    $stmt->execute();

                                echo $_SESSION['mok'];
                                } else {
                                    echo $_SESSION['exits'];
                                }*/
                            }  
                        }                            
                    }
                ?>

<!----------php for detecting the type of user, only admin, the user create function will be shown---------->
    <?php 
        if($_SESSION['type']=='admin') {
            echo '<div class="cu">
                    <h2>Create User</h2>
                    <form method="POST" action="create.php">
                        <div class="nameform">
                            <label>Username:</label>
                            <input type="text" name="username">
                        </div>
                        <div class="passform">
                            <label>Password:</label>
                            <input type="password" name="password">
                        </div>
                        <div class="form-row form-row2 align-items-center">
                            <div class="col-auto">
                                <label>Type:</label>
                                <select name="role" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="user">User</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    <button type="submit" class="btnsave">Create</button>
                </form>
            </div>';
        }
    ?>

                <div class="cm">
                    <h2>Create Movie</h2>
                    <form method="POST" action="create.php">
                        <div class="nameform mname">
                            <label>Movie's Name:</label>
                            <input type="text" name="moviename">
                        </div>
                        <div class="passform dname">
                            <label>Director First Name:</label>
                            <input type="text" name="dfn">
                            <label style="padding-left: 20px">Last Name:</label>
                            <input type="text" name="dln">
                        </div>
                        <div class="passform year">
                            <label>Year:</label>
                            <input type="text" name="year">
                        </div>
                        <div class="form-row form-row2 align-items-center passform">
                            <div class="col-auto">
                                <label>Genre:</label>
                                <select name="genre" class="custom-select mr-sm-2">
                                    <option value="Crime">Crime</option>
                                    <option value="Comedy">Comedy</option>
                                    <option value="Horro">Horro</option>
                                    <option value="Romance">Romance</option>
                                    <option value="War">War</option>
                                    <option value="Sci-fictional">Sci-fictional</option>
                                </select>
                            </div>
                        </div>
                        <div class="passform brief">
                            <label>Introduction:</label>
                            <textarea type="text" name="year" row="5"></textarea>
                        </div>
                        <button type="submit" class="btnsave">Create</button>
                    </form>
                </div>

            </main>
        </div>
    </body>
</html>