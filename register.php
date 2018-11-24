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
    $passwordAgain = $_POST['passwordAgain'];

    #to avoid thoes "bad codes"------SQL Injection
    $username = htmlentities($database->real_escape_string($username));
    $password = $database->real_escape_string($password);
    $passwordAgain = $database->real_escape_string($passwordAgain);

      if(!($username=="" || $password=="")){
      #see whether the input username has been taken
      $sql = "SELECT password FROM user WHERE username='$username'";
      $result = $database->query($sql);

        if($result->num_rows > 0) { #if num_row>0, means there's at least one username equals to the user input
          $tips = "<small class='xstips'><b>Sorry, the name has been taken.</b></small>";
        } 
        if($password != $passwordAgain) {
          $tips = "<small class='xstips'><b>Sorry, passwords are not the same.</b></small>";
        } else {
          #hash password
          $salt = '$1$rasmusle$rISCgZzpwk3UhDidwXvin0';   #MD5
          $password = crypt($password, $salt);

          #the default value of the new user is user
          $sql = "INSERT INTO user(username, password, type)VALUE('$username', '$password', 'user')";
          $result= $database->query($sql);

          if($result == true) {
            $tips = "<small class='xstips'><b>Successfully!</b></small>";
          } else {
            $tips = "<small class='xstips'><b>Sorry, please register again.</b></small>";;
          }
        }
      } else {
        $tips = "<small class='xstips'><b>Please fill the form!</b></small>";
      }
    }

 ?>

<!doctype html>
  <html class="wallpaper2">
    <head>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <title>Register Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--原始比例缩放，网页初始大小占屏幕面积的100%-->
      <link href="css/main.css" type="text/css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto:500,700,900" rel="stylesheet">
    </head>

    <body class="transparent">
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
            <div class="form-group">
              <label class="label" style="width:fit-content" for="password">Repeat password</label>
              <input class="inputbox" name="passwordAgain" type="password" class="form">
            </div>
            <button type="submit" style="margin-top:20px; width:300px;" class="btn btn-primary">Register</button>
            <?php if(isset($tips)) {echo $tips;} ?>
          </form>
        </header>
      </div>
    </body>

  </html>
