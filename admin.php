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

  <body>
    <div class="container">
			<header class="space">
				<?php include("php/header.php"); ?>
			</header>

      <h3 class="category">Hello, admin!</h3>
      <form action="" method="post" enctype="multipart/form-data" class="form_gallery">
        <div class="form-row align-items-center">
          <span class="key_words">Choose a picture:</span>
          <div class="col-auto">
            <input type="file" name="file" class="form-control form-control2 mb-2">
          </div>
          <div class="col-auto">
          <input type="submit" name="submit" value="Upload" class="btn btn-primary mb-2">
          </div>
        </div>
      </form>

      <?php
      if($_SERVER['REQUEST_METHOD']=='POST') {
        $name=$_FILES['file']['name'];
        $size=$_FILES['file']['size'];


        $ext=pathinfo($name,PATHINFO_EXTENSION);
        $ext=strtolower($ext);
        if($ext!='png' && $ext!='jpg' && $ext!='gif') {
          echo "<small><b>" .'Format must be PNG, JPG or GIF' ."</b></small>";
          exit();
        }
        if($size>1500000) {
          echo "<small><b>" .'File size must smaller than 1MB'. "</b></small>";
          exit();
        }
        if (file_exists("upload/" . $name)) {
          echo "<small><b>" .'File: '.$name.' already uploaded.' ."</b></small>";
          exit();
        }

        try {
          move_uploaded_file($_FILES['file']['tmp_name'],'upload/' .$_FILES['file']['name']);
          echo "<small><b>" .'Uploaded successfully.' ."</b></small>";
        }
        catch(Exception $e) {
          echo "<small><b>" .'File upload failed' ."</b></small>";
        }
      }
      ?>

    </div>
  </body>
</html>
