<?php
  include("php/config.php");

  #open the database
  @$database = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

  #check if the database connected
  if($database->connect_error) {
    echo "Sorry, fail in connection. Reason(s):" . $database->connect_error;
    exit();
  }

  if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    #to avoid thoes "bad codes"------SQL Injection
    $username = $database->real_escape_string($username);
    $password = $database->real_escape_string($password);

      if(!($username=="" || $password=="")){
      #see whether the input username has been taken
      $sql = "SELECT username FROM user WHERE username='$username' AND password='$password'";
      $result = $database->query($sql);

        if($result->num_rows > 0) { #if num_row>0, means there's at least one username equals to the user input
          $tips = "<small><b>Sorry, the name has been taken.</b></small>";
        } else {
          #hash password
          $salt = '$1$rasmusle$rISCgZzpwk3UhDidwXvin0';
          $password = crypt($password, $salt);

          $sql = "INSERT INTO user(username,password)VALUE('$username','$password')";
          $result= $database->query($sql);

          if($result == true) {
            $tips = "<small><b>Successfully!</b></small>";
          } else {
            $tips = "<small><b>Damn.</b></small>";;
          }
        }
      } else {
        $tips = "<small><b>Hey pal, your password!</b></small>";
      }
    }

 ?>

<!doctype html>
<html>
  <head>
  	<!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  	<title>Register Page</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
  	<link href="css/main.css" type="text/css" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <?php if(isset($tips)) {echo $tips;} ?>
      <div style="margin-top:30px; padding-bottom:20px;">
        <a href="index.php" id="logo"><img src="images/logotype.png"></a>
      </div>
      <header class="space">
        <form action="" method="post" style="margin-top:50px;">
          <div class="form-group">
            <label class="label" for="username">Username</label>
            <input name="username" type="text" style="border-top:0; border-left:0; border-right:0; border-bottom:1px solid #aaa; width:300px;"
            class="form" id="username">
          </div>
          <div class="form-group">
            <label class="label" for="password">Password</label>
            <input name="password" type="password" style="border-top:0; border-left:0; border-right:0; border-bottom:1px solid #aaa; width:300px;"
            class="form" id="password">
          </div>
          <button type="submit" style="margin-top:20px; width:300px;" class="btn btn-primary">Register</button>
        </form>
      </header>
    </div>
  </body>

  </html>
