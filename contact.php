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

			<main class="adjustment contactpig">
				<div class="contact_container">
					<div class="social_media">
						<h3>Contact Us</h3>
						<p>Send your document to our email address if you're willing to do
						something for the community.</br></br>Thanks for contribution.</p>
						<span class="mail"><a href="mailto: movie@gmail.com">movie@gmail.com >></a></span>
						<div class="icons_group">
							<a href="http://www.facebook.com"><img src="images/sf.png">&nbsp</a>
							<a href="https://cn.linkedin.com"><img src="images/sl.png">&nbsp</a>
						</div>
					</div>
					<div class="contact_form">
						<form>
						  <div class="form-row form_contact">
						    <div class="col-md-4 mb-3">
						      <label for="validationDefault01">Full Name</label>
						      <input type="text" class="form-control form-control2" id="validationDefault01" required>
						    </div>
						    <div class="col-md-4 mb-3">
						      <label for="validationDefault02">E-mail</label>
						      <input type="text" class="form-control form-control2" id="validationDefault02" required>
						    </div>
								<div class="form-group">
							    <label for="exampleFormControlTextarea1">Message</label>
							    <textarea class="form-control form-control2" id="exampleFormControlTextarea1" rows="3"></textarea>
							  </div>
							</div>
						  <button class="btn btn-primary2" type="submit">Send</button>
						</form>
					</div>
				</div>
			</main>
<!--footer-->
			<?php include("php/footer.php"); ?>
		</div>
	</body>
</html>
