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

  <body>
    <div class="container">
			<header class="space">
				<?php include("php/header.php"); ?>
			</header>

      <?php
        $dir = "upload/"; //要获取的目录

        if (is_dir($dir)){    //先判断指定的路径是不是一个文件夹
          if ($dh = opendir($dir)){
            echo "<div class='category'>
                    <h3>Gallery</h3>
                    <div class='card-columns'>";
            while (($file = readdir($dh))!= false){
              if(!($file == '.' || $file == '..')) {
                echo "<div class='card'>
                        <img class='card-img-top' src='".$dir.$file."'/>
                        </div>";
            }
          }
            echo "  </div>
                  </div>";
            closedir($dh);
          }
        }
      ?>
      
    <!--footer-->
    			<?php include("php/footer.php"); ?>
      </div>
    </body>
</html>
