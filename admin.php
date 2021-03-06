<!--not allow users to visit admin page just by typing address
<?php
  if(!isset($_SESSION)) {
    session_start();
  }
  
  if(isset($_SESSION['type'])) {
    if($_SESSION['type'] != 'admin') {  #check uer type before logging
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
  	<title>Welcome, admin!</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
  	<link href="css/main.css" type="text/css" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
  </head>

  <body style="background-color:#eee">
    <div class="mainbox">
      <aside>
        <h1>Welcome, admin!</h1>
        <div class="person">
          <img src="images/profile.png">
          <h2><?php echo $_SESSION['username']; ?></h2>
          <span>admin</span>
        </div>
        <ul>
          <li><a href="create.php">+ Add User</a></li>
          <li><a href="create.php">+ Add Movie</a></li>
          <li><a href="gallery.php">Go to Gallery</a></li>
        </ul>
        <div class="logout">
          <img src="images/out.svg">
          <span><a href="php/log_out.php">Log out</a></span>
        </div>
      </aside>

      <main class="admin_main">
        <figure class="desk">
          <img src="images/desk.jpeg">
          <figcaption class="date">
            22:57
            <span class="cal">Sun 11th Nov, 2018</span>
          </figcaption>
        </figure>

<!--PHP for upload files-----go down:162-->
        <?php
          if(isset($_FILES['upload'])) {

            if(($_FILES['upload']['size']) > 256000) {
              $tips="<span class='tips'>File must no larger than 200Kb.</span>";    
            }

            if(file_exists("upload/".$_FILES['upload']['name'])) {
              $tips="<span class='tips'>The file already exists.</span>";   
            }

            else if(($_FILES['upload']['type'] == "image/jpeg") || ($_FILES['upload']['type'] == "image/jpg") || ($_FILES['upload']['type'] == "image/png")
            || ($_FILES['upload']['type'] == "image/gif")) {
              move_uploaded_file($_FILES['upload']['tmp_name'], "upload/". $_FILES['upload']['name']);
              $tips="<span class='tips'>File upload successfully.</span>";
            } else {
              $tips="<span class='tips'>Sorry, only support images with jpeg, jpg, png and gif formats.</span>";
            }
          }
        ?>

<!--PHP for saving a edited movie-----go down:223-->
        <?php
          include("php/config.php");
          #open the database
          @$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

          #check if the database connected
          if($database->connect_error) {
            echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
            exit();
          }
          
          if(isset($_GET['savemovie'])) {
            $id = $_GET['savemovie'];
            $moviename = $_GET['movie_name'];
            $type = $_GET['type'];
            $year = $_GET['movie_year'];
            #$_GET['movie_year'] != "" ? $year = $_GET['movie_year'] : $year=" ";

            #---get an arry of directors' id with a specific movie
            $query = "SELECT author_id FROM movie JOIN director_movie ON movie.id = director_movie.movie_id WHERE movie.id=$id";
            $result = $database->query($query);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

            #since we have more than one directors, need to differ them by different option names, like director0, director1
            $counter=0;
            $count_d="director".$counter; 
            while(isset($_GET[$count_d])) {

              #get the new director id to change the original one
              $director = $_GET[$count_d];
              $old_director = $result[$counter]['author_id'];

              $query = "UPDATE director_movie SET author_id=$director WHERE movie_id=$id AND author_id=$old_director";
              $stmt = $database->prepare($query);
              $stmt->execute();

              #once finish a director, continue to next one until the last one
              $counter++;
              $count_d="director".$counter;
            }

            #update the rest information
            $query = "UPDATE movie SET movie_name='$moviename', year='$year', type='$type' WHERE id=$id";
            $stmt = $database->prepare($query);
            $stmt->execute();                   
            
            echo $_SESSION['tip3'];
          }
        ?>

<!--PHP for save edited ♀♂ user-----go down:180-->
        <?php
          if(isset($_GET['saveuser'])) {
            
            $query = "UPDATE user SET type='". $_GET['role']. "' WHERE id=". $_GET['saveuser'];
            $stmt = $database->prepare($query);
            $stmt->execute();

            echo $_SESSION['tip3'];
          }
        ?>

<!--PHP for delete ♙♟ user-----go down:208-->
        <?php

          if(isset($_GET['deleteuser'])) {
            $query = "DELETE FROM user WHERE id=".$_GET['deleteuser'];
            $stmt = $database->prepare($query);
            $stmt->execute();
            
            echo $_SESSION['tip1'];
          }

#---PHP for delete ✪✪ movie-----go down:304#         
          if(isset($_GET['deletemovie'])) {
            $query = "DELETE FROM movie WHERE id=".$_GET['deletemovie'];
            $stmt = $database->prepare($query);
            $stmt->execute();

            $query = "DELETE FROM director_movie WHERE movie_id=".$_GET['deletemovie'];
            $stmt = $database->prepare($query);
            $stmt->execute();
            
            echo $_SESSION['tip2'];         
          }
          ?>

<!--The div is for showing tips-->
        <div>
          <?php 
            if(isset($tips)) {echo $tips;}

            $_SESSION['tip1'] = "<span class='tips'>Delete user successfully.</span>";
            $_SESSION['tip2'] = "<span class='tips'>Delete movie successfully.</span>";
            $_SESSION['tip3'] = "<span class='tips'>Save successfully.</span>";
                
          ?>
        </div>

        <div class="upload">
          <h2>Upload Photo</h2>
          <form action="admin.php" method="post" enctype="multipart/form-data">
            <div class="form-row align-items-center">
              <label class="pick">Choose a picture:</label>
              <div class="col-auto">
                <input type="file" name="upload" class="form-control form-control2 mb-2">
              </div>
              <div class="col-auto">
              <input type="submit" name="submit" value="Upload" class="btn btnup mb-2">
              </div>
            </div>
          </form> 
        </div>

        <div class="um">
          <h2>User Management</h2>    

<!--php for editing user role-----go back:113-->
          <?php
            #take all the user info in database
            $query = "SELECT id, username, type FROM user";          
            $stmt = $database->prepare($query);
            $stmt->bind_result($id, $username, $type);
            $stmt->execute();

            echo '<div class="persons">';

            while($stmt->fetch()) {

              #---once press the edit button
              if(isset($_GET['edituser'])) {
                if($_GET['edituser'] == $id) {  
                  echo "<div class='personcard'>                       
                          <h3 class='card-title'>$username</h3>
                          <select form='userform' name='role' class='custom-select mr-sm-2 role' id='inlineFormCustomSelect'>
                                <option value='user'>user</option>
                                <option value='moderator'>moderator</option>
                                <option value='admin'>admin</option>
                          </select>
                          <form id='userform' method='get'>
                            <button type='submit' name='saveuser' id='$id' class='btnedit btn' value='$id'>Save</button>
                          </form>
                        </div>";              
                }

              #print out all the user info with edit and delete buttons-----go back:125
              } else {
                echo "<div class='personcard'>                       
                        <h3 class='card-title'>$username</h3>
                        <span class='card-text' class='usertype'>$type</span>
                        <form id='userform' action='' method='get'>
                          <button type='submit' class='btn btnedit' name='edituser' id='$id' value='$id'>Edit</button>
                          <button type='submit' class='btn btnedit' name='deleteuser' id='$id' value='$id'>Delete</button>
                        </form>
                      </div>";
              }
            }
            echo '</div>';
          ?>

<!--edit movies-----go back:81-->
        <div class="bm">
          <h2>Movie Management</h2>
          <?php
            $query = "SELECT movie.id, movie_name, movie.type, movie.year, first_name, last_name FROM movie
						JOIN director_movie ON movie.id = director_movie.movie_id
						JOIN director ON director.id = director_movie.author_id";

            $stmt = $database->prepare($query);
            $stmt->bind_result($id, $movie_name, $type, $year, $first_name, $last_name);
            $stmt->execute();

            echo '<table class="table table-striped edit_movie">';
              echo '<thead>';
                echo '<th scope="col">#</th>
                      <th class="col" scope="col">Name</th>
                      <th scope="col">Director</th>
                      <th scope="col">Type</th>
                      <th scope="col">Year</th>
                      <th scope="col">Operate</th>';
              echo '</thead>';

              #---♞(there's $stmt1 on line 288)since database will keep running until it meets null
              while($stmt->fetch()) {
                
                #once press the edit button
                if(isset($_GET['editmovie'])) {
                  if($_GET['editmovie'] == $id) {

                    #need a loop to go through all the rows with the same movie
                    if(!isset($wholecounter)) {
                      $wholecounter=0;
                    } else {
                      $wholecounter++;
                    }
    
                    #---$dcounter is for go through all the directors with the same movie
                    if(!isset($dcounter)) $dcounter=0;
                    echo "<tr>";
                    
                    #only print out the first td with id and not allow to change the movie id
                    if($wholecounter == 0) {
                      echo "<td>$id</td>
                          <td>";
                    } else {
                      echo "<td></td>
                            <td>";
                    }
                  
                    #only print out the first td with movie name
                    if($wholecounter==0) {
                      echo "<input form='editform' name='movie_name' class='movie_name' value='$movie_name'>";
                    }
                    echo "</td>";
                    
                    #---♘for the previous database keeps running, need another database for help
                    @$database1 = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

                    #---♘when edit movie, the director drop box will show the movie with current director
                    $query = "SELECT author_id FROM movie JOIN director_movie ON movie.id = director_movie.movie_id WHERE movie.id=$id";
                    $result = $database1->query($query);

                    #---get an arry with current director's id
                    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $cd = $result;

                    #---get all the information from director table, user for options for director's drop box
                    $query = "SELECT * FROM director";
                    $result = $database1->query($query);
                    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    
                    echo "<td>
                          <select form='editform' name='director$wholecounter' class='custom-select mr-sm-2 jsdom' id='inlineFormCustomSelect'>";
                                    
                          #---use for loop to print all the directors' name(combined with first and last name) in the drop box
                          for($count=0; $count<sizeof($result); $count++) {
                            
                            #make sure when edit the movie, the director's name of the movie will be showed in the drop box by selected value
                            if($cd[$dcounter]['author_id'] == $result[$count]['id']) {
                              echo "<option selected='selected' value='". $result[$count]['id'] . "'>" . 
                                  $result[$count]['first_name']. " " .$result[$count]['last_name'] . "</option>";
                                  
                            #otherwise just print out all the directors name
                            } else {
                              echo "<option value='". $result[$count]['id'] . "'>" . 
                                  $result[$count]['first_name']. " " .$result[$count]['last_name'] . "</option>";
                            }
                          }
                          $dcounter++;

                      echo "</select>";
                    echo"</td>";

                    if($wholecounter==0) {
                      echo "<td><select form='editform' name='type' class='custom-select mr-sm-2' id='inlineFormCustomSelect'>
                            <option value='$type'>Type</option>
                            <option value='Comedy'>Comedy</option>
                            <option value='Crime'>Crime</option>
                            <option value='Romance'>Romance</option>
                            <option value='Horror'>Horror</option>
                            <option value='War'>War</option>
                            <option value='Sci-fictional'>Sci-fictional</option>
                          </select>
                        </td>
                        <td><input form='editform' name='movie_year' class='year_input' value='$year'></td></td>
                        <td>
                        <form id='editform' method='get'>
                          <button type='submit' name='savemovie' id='$id' class='btnedit btn jssave' value='$id'>Save</button>
                        </form>
                        </td>";

                    #leave the rest row empty
                    } else {
                      echo "<td></td>
                            <td></td>
                            <td></td>";
                    }      
                    echo "</tr>";

#-----print out movies info with edit and delete buttons-----go back:136
                  }
                } else {
                    echo "<tr>";
                    echo "<td>$id</td>
                          <td>$movie_name</td>
                          <td>$first_name&nbsp&nbsp$last_name</td>
                          <td>$type</td>
                          <td>$year</td>
                          <td>
                          <form action='' method='get'>
                            <button type='submit' name='editmovie' id='$id' class='btnedit btn' value='$id'>Edit</button>
                            <button type='submit' name='deletemovie' id='$id' class='btnedit btn' value='$id'>Delete</button>
                          </form>
                          </td>";
                    echo "</tr>";
                }
              }
              echo '</table>';
            ?>
        </div>
      </main>
    </div>
    <script src="js/project.js"></script>
  </body>
</html>
