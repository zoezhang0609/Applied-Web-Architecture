<?php
  include("php/config.php");

  #open the database
  @$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

  #check if the database connected
  if($database->connect_error) {
    echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
    exit();
  }

  if(!isset($_SESSION)) {
    session_start();
  }

  if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    #to avoid thoes "bad codes"------SQL Injection
    $username = $database->real_escape_string($username);
    $password = $database->real_escape_string($password);

    $salt = '$1$rasmusle$rISCgZzpwk3UhDidwXvin0';
    $password = crypt($password, $salt);

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $database->query($sql);

    #go to admin page once password and username matched
    if($result->num_rows > 0) {
      $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $_SESSION['type'] = $result[0]['type'];
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $result[0]['id'];   #get the id for reseve book

      if($_SESSION['type'] == 'admin') {
        header("Location: admin.php");
        exit();
      } else if($_SESSION['type'] == 'moderator') {
        header("Location: moderator.php");
        exit();
      } else {
        header("Location: index.php");
      }
      
    } 
    
    else {
      $tips = "<small class='xstips'>Sorry, not match!</small>";
    }

    if($username == "" || $password == "") {
      $tips = "<small class='xstips'>Please provide your username and password.</small>";
    }
  }
?>

<!doctype html>
<html class="wallpaper">
  <head>
  	<!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  	<title>Login Page</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
  	<link href="css/main.css" type="text/css" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
  </head>

  <body class="transparent">
    <?php if(isset($tips)) {echo $tips;} ?>
    <div class="container">
      <div style="margin-top:30px">
        <a href="index.php" id="logo"><img src="images/logotype.png"></a>
      </div>
      
      <header class="space">
        <form action="" method="post" style="margin-bottom:20px; margin-top:10px;">
          <div class="form-group">
            <label class="label" for="username">Username</label>
            <input class="inputbox" name="username" type="text" class="form" id="username">
          </div>
          <div class="form-group">
            <label class="label" for="password">Password</label>
            <input class="inputbox" name="password" type="password" class="form" id="password">
          </div>
          <button type="submit" style="margin-top:20px; width:300px;" class="btn btn-primary">Login</button>
        </form>
      </header>
    </div>
  </body>

  </html>
